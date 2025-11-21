<?php

namespace App\Livewire\Front;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UserOrders extends Component
{
    use WithPagination,WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $userId = auth()->id(); // هذا سيعيد null إذا لم يكن مسجل دخول
        if (!$userId) {
            $orders = collect(); // Collection فارغة
        } else {
            $orders = Order::where('user_id', $userId)
                ->with('items.product.images')
                ->latest()
                ->paginate(3);
        }


        return view('livewire.front.user-orders', [
            'orders' => $orders,
        ]);
    }
}
