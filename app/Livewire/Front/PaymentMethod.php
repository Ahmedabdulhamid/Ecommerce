<?php

namespace App\Livewire\Front;

use App\Services\SavedCardService;
use Illuminate\Support\Facades\Auth;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Component;

class PaymentMethod extends Component
{
    use WithPagination;
    use WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';
    public $default = false;
    protected $listeners = ['refresh' => '$refresh'];

    public function makeDefault($cardId, SavedCardService $savedCardService)
    {
        $card = $savedCardService->findById($cardId);
        $this->authorize('manage', $card);

        $savedCardService->makeDefault(Auth::id(), $cardId);
        $this->dispatch('success');
    }

    public function delete($cardId, SavedCardService $savedCardService)
    {
        $card = $savedCardService->findById($cardId);
        $this->authorize('manage', $card);

        $savedCardService->delete($cardId);
        $this->dispatch('success_delete');
    }

    public function render(SavedCardService $savedCardService)
    {
        $cards = collect();
        $default = false;

        if (auth()->check()) {
            $cards = $savedCardService->paginateUserCards(auth()->id(), 5);
        }

        return view('livewire.front.payment-method', [
            'cards' => $cards,
            'default' => $default,
        ]);
    }
}
