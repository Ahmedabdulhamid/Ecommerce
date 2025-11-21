<?php

namespace App\Livewire\Front;

use App\Models\SavedCard;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class PaymentMethod extends Component
{
    use WithPagination,WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';
    public $default = false;
    protected $listeners = ['refresh' => '$refresh'];

    public function makeDefault($cardId)
    {
        $card = SavedCard::findOrFail($cardId);
        $this->authorize('manage', $card);

        Auth::user()->savedCards()->update(['is_default' => false]);
        $card->update(['is_default' => true]);

        $this->dispatch('success');
    }

    public function delete($cardId)
    {
        $card = SavedCard::findOrFail($cardId);
        $this->authorize('manage', $card);

        $card->delete();

        $this->dispatch('success_delete');
    }

    public function render()
    {
        $cards = collect(); // افتراضيًا فارغ
        $default = false;

        if (auth()->check()) {
            $cards = SavedCard::where('user_id', auth()->id())
                ->latest()
                ->paginate(5);
        }

        return view('livewire.front.payment-method', [
            'cards' => $cards,
            'default' => $default,
        ]);
    }
}
