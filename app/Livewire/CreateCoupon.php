<?php

namespace App\Livewire;

use App\Http\Requests\CouponRequest;
use Livewire\Component;

class CreateCoupon extends Component
{
    public $code;
    public $discount_precentage;
    public $start_at;
    public $end_at;
    public $limit;
    public $status;
    public $count=1;
    public function increment(){
        $this->count++;
    }

    public function rules(){
        return [
           'code' => ['required', 'min:4', 'max:10', 'unique:coupones,code'],
        'discount_precentage' => ['required', 'numeric', 'between:1,100'],
        'start_at' => ['required', 'date', 'after_or_equal:today'],
        'end_at' => ['required', 'date', 'after:start_at'],
        'limit' => ['required', 'numeric', 'min:1'],
        'status' => ['required']
         ];
    }



        public function submit()
        {
            $validated = $this->validate();

            session()->flash('message', 'Coupon created successfully!');
        }

    public function render()
    {
        return view('livewire.create-coupon');
    }
}
