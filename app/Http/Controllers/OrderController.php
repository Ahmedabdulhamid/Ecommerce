<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function showForm()
    {
        return view('front.orders.form');
    }
    public function getOrder(Request $request, $order_number)
    {
        if (session('order_number') !== $order_number) {
            abort(403, 'Unauthorized access');
        }

        $order = Order::where('order_number', $order_number)
            ->with('items.product.images')
            ->first();
        if ($order) {
            // أضف خاصية جديدة للايميل المخفي
            $order->email_hidden = $this->hideEmail($order->email);
        }

        if (!$order) {
            abort(404);
        }

        return view('front.orders.index', ['order' => $order]);
    }
    private function hideEmail($email)
    {
        list($user, $domain) = explode('@', $email);
        $start = substr($user, 0, 2);
        return $start . '****@' . $domain;
    }
    public function trackOrder(Request $request)
    {
        $data = $request->validate([
            'order_number' => 'required|string',
            'email' => 'required|email',
        ]);
        $order = Order::where('order_number', $request->order_number)
            ->where('email', $request->email)
            ->first();

        if (!$order) {
            session()->flash('error', 'Order Not Found');
            return redirect()->back();
        }

        // حفظ رقم الطلب في الجلسة
        session(['order_number' => $order->order_number]);

        return to_route('front.order', $order->order_number);
    }
}
