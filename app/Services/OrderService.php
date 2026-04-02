<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderService
{
    public function __construct(private readonly OrderRepository $orders)
    {
    }

    public function latestQuery(): Builder
    {
        return $this->orders->latestQuery();
    }

    public function createOrder(array $data, string $locale, string $sessionId): ?Order
    {
        $cart = $this->orders->findCartBySessionId($sessionId);

        if (!$cart || $cart->products->isEmpty()) {
            return null;
        }

        return DB::transaction(function () use ($data, $locale, $sessionId, $cart) {
            $order = $this->orders->create([
                'user_id' => auth()->id(),
                'f_name' => $data['fname'],
                'l_name' => $data['lname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'country' => $data['country'] ?? null,
                'governorate' => $data['governorate'] ?? null,
                'city' => $data['city'],
                'street' => $data['street'],
                'notice' => $data['notice'] ?? null,
                'shipping_price' => $data['shipping_price'] ?? 0,
                'total_price' => $data['total_price'],
                'status' => 'pending',
                'order_number' => strtoupper('ORD-' . Str::random(10)),
                'locale' => $locale,
                'session_id' => $sessionId,
                'countary_id' => $data['countryId'] ?? null,
                'governorate_id' => $data['governorateId'] ?? null,
            ]);

            foreach ($cart->products as $product) {
                $this->orders->createOrderItem([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_variant_id' => $product->pivot->product_variant_id,
                    'price' => $product->pivot->price,
                    'quantity' => $product->pivot->quantity,
                    'attributes' => $product->pivot->attributes,
                ]);
            }

            session(['current_order_number' => $order->order_number]);

            return $order;
        });
    }

    public function getFrontOrder(string $orderNumber): ?Order
    {
        $order = $this->orders->findByOrderNumberWithItems($orderNumber);

        if ($order) {
            $order->email_hidden = $this->hideEmail($order->email);
        }

        return $order;
    }

    public function findForTracking(string $orderNumber, string $email): ?Order
    {
        return $this->orders->findByOrderNumberAndEmail($orderNumber, $email);
    }

    public function paginateUserOrders(int $userId, int $perPage = 3): LengthAwarePaginator
    {
        return $this->orders->paginateUserOrders($userId, $perPage);
    }

    public function getAdminOrder(string $id): ?Order
    {
        $order = $this->orders->findByIdWithItems($id);

        if ($order) {
            $order->email_hidden = $this->hideEmail($order->email);
        }

        return $order;
    }

    public function deletePendingOrFailed(string|int $id): ?int
    {
        $order = $this->orders->findByIdOrFail($id);

        if (!in_array($order->status, ['pending', 'failed'], true)) {
            return null;
        }

        $this->orders->delete($order);

        return $this->orders->count();
    }

    public function markDelivered(string|int $id): bool
    {
        $order = $this->orders->findByIdOrFail($id);

        if (!in_array($order->status, ['processing', 'shipped', 'paid'], true)) {
            return false;
        }

        return $this->orders->update($order, ['status' => 'delivered']);
    }

    public function updateStatus(string|int $id, string $status): array
    {
        $allowedTransitions = [
            'pending' => ['canceled'],
            'paid' => ['processing', 'canceled', 'delivered'],
            'processing' => ['shipped', 'canceled'],
            'shipped' => ['delivered'],
            'delivered' => [],
            'canceled' => [],
            'refunded' => [],
            'failed' => ['pending'],
        ];

        $order = $this->orders->findByIdOrFail($id);
        $oldStatus = $order->status;

        if ($oldStatus === $status) {
            return ['type' => 'info', 'message' => 'Order is already in this status.'];
        }

        if (!in_array($status, $allowedTransitions[$oldStatus] ?? [], true)) {
            return ['type' => 'error', 'message' => "Transition from '$oldStatus' to '$status' is not allowed."];
        }

        $this->orders->update($order, ['status' => $status]);

        return ['type' => 'success', 'message' => "Order status updated to '$status' successfully."];
    }

    private function hideEmail(string $email): string
    {
        [$user, $domain] = explode('@', $email);

        return substr($user, 0, 2) . '****@' . $domain;
    }
}
