<?php

namespace App\Repositories;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class OrderRepository
{
    public function latestQuery(): Builder
    {
        return Order::latest();
    }

    public function findByIdOrFail(int|string $id): Order
    {
        return Order::findOrFail($id);
    }

    public function findByIdWithItems(int|string $id): ?Order
    {
        return Order::where('id', $id)->with('items.product')->first();
    }

    public function findByOrderNumberWithItems(string $orderNumber): ?Order
    {
        return Order::where('order_number', $orderNumber)
            ->with('items.product.images')
            ->first();
    }

    public function findByOrderNumberAndEmail(string $orderNumber, string $email): ?Order
    {
        return Order::where('order_number', $orderNumber)
            ->where('email', $email)
            ->first();
    }

    public function paginateUserOrders(int $userId, int $perPage = 3): LengthAwarePaginator
    {
        return Order::where('user_id', $userId)
            ->with('items.product.images')
            ->latest()
            ->paginate($perPage);
    }

    public function count(): int
    {
        return Order::count();
    }

    public function create(array $data): Order
    {
        return Order::create($data);
    }

    public function update(Order $order, array $data): bool
    {
        return $order->update($data);
    }

    public function delete(Order $order): ?bool
    {
        return $order->delete();
    }

    public function findCartBySessionId(string $sessionId): ?Cart
    {
        return Cart::where('session_id', $sessionId)->with('products')->first();
    }

    public function createOrderItem(array $data): OrderItem
    {
        return OrderItem::create($data);
    }
}
