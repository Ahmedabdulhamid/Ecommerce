<?php

namespace App\Services;

use App\Events\CreateOrderEvent;
use App\Models\{Admin, Order, OrderItem, Cart, Countary, Governorate};
use App\Notifications\CreateOrderNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Notifications\OrderNotification;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class OrderService
{
    public function createOrder(array $data, string $locale, string $sessionId): ?Order
    {
        $country = Countary::find($data['countryId']);
        $countryName = $country?->getTranslation('name', $locale);
        $governorate = Governorate::where('countary_id', $data['countryId'])->first();
        $governorateName = $governorate?->getTranslation('name', $locale);

        $userId = Auth::guard('web')->user()?->id;

        $order = Order::create([
            'user_id' => $userId,
            'email' => $data['email'],
            'phone' => $data['phone'],
            'country' => $countryName,
            'governorate' => $governorateName,
            'shipping_price' => $data['shipping_price'],
            'f_name' => $data['fname'],
            'l_name' => $data['lname'],
            'city' => $data['city'],
            'street' => $data['street'],
            'notice' => $data['notice'],
            'total_price' => $data['total_price'],
            'status' => 'pending',
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
        ]);

        if (!$order) return null;

        $cart = Cart::where('session_id', $sessionId)->with('products')->first();
        if ($cart) {
            foreach ($cart->products as $product) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_variant_id' => $product->pivot->product_variant_id,
                    'quantity' => $product->pivot->quantity,
                    'attributes' => $product->pivot->attributes,
                    'price' => $product->pivot->price,
                ]);
            }

            $cart->products()->detach();
        }

       /* if (!$userId && $order) {
            $order->notify(new OrderNotification($order));
        } */
        if ($order) {
            $admins=Admin::all();
            Notification::send($admins,new CreateOrderNotification($order));
            foreach ($admins as $admin) {
                $latestNotification = $admin->notifications()->latest()->first();
                Broadcast(new CreateOrderEvent($admin,$order,$latestNotification))->toOthers();

            }

        }


        return $order;
    }
}
