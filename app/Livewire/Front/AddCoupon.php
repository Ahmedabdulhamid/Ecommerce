<?php

namespace App\Livewire\Front;

use App\Models\Coupon;
use Livewire\Component;

class AddCoupon extends Component
{
    public $code="123456789dfrgtyhjk";

    public function render()
    {
        return view('livewire.front.add-coupon');
    }
}
