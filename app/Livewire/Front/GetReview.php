<?php

namespace App\Livewire\Front;

use Livewire\Component;

class GetReview extends Component
{
    public $count;
    protected $listeners = ['getReviewCount' => 'getReviewCount'];
    public function getReviewCount($reviewCount){
      $this->count=$reviewCount;
    }
    public function mount($count){
        $this->getReviewCount($count);
    }

    public function render()
    {
        return view('livewire.front.get-review');

    }
}
