<?php

namespace App\Livewire\Front;

use App\Services\OrderService;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UserOrders extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';

    public function render(OrderService $orderService)
    {
        $userId = auth()->id();
        $orders = $userId ? $orderService->paginateUserOrders($userId, 3) : collect();

        return view('livewire.front.user-orders', [
            'orders' => $orders,
        ]);
    }
}
