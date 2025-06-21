<?php

namespace App\Livewire\Front;

use Livewire\Component;

class Dashboard extends Component
{
    public $orders,$country,$governorate;
    public function mount($orders,$country,$governorate)
    {
        $this->orders=$orders;
        $this->country=$country;
        $this->governorate=$governorate;

    }
    public function render()
    {
        return view('livewire.front.dashboard');
    }
}
