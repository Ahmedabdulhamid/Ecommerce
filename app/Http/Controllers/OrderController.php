<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrackOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private readonly OrderService $orderService)
    {
    }

    public function showForm()
    {
        return view('front.orders.form');
    }

    public function getOrder(Request $request, $order_number)
    {
        if (session('order_number') !== $order_number) {
            abort(403, 'Unauthorized access');
        }

        $order = $this->orderService->getFrontOrder($order_number);

        if (!$order) {
            abort(404);
        }

        return view('front.orders.index', ['order' => $order]);
    }

    public function trackOrder(TrackOrderRequest $request)
    {
        $order = $this->orderService->findForTracking(
            $request->validated('order_number'),
            $request->validated('email')
        );

        if (!$order) {
            session()->flash('error', 'Order Not Found');

            return redirect()->back();
        }

        session(['order_number' => $order->order_number]);

        return to_route('front.order', $order->order_number);
    }
}
