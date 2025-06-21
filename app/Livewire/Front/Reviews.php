<?php

namespace App\Livewire\Front;

use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;
class Reviews extends Component
{
    public $selectedReviewId;
    protected $listeners = ['getReviews' => 'getReviews'];
    public $reviewText;
    public $reviews = [];

    public function mount()
    {
        $this->getReviews();
    }
    public function getReviews()
    {
        $user_id = Auth::guard('web')->user()->id;
        $this->reviews = Review::where('user_id', $user_id)->with('product.images')->get();
    }
    public function editReview($id)
    {

        $this->selectedReviewId = $id;
        $review = Review::findOrFail($id);
        $this->reviewText = $review->comment; // أو أي عمود فيه النص
    }
    public function submit()
    {
        $review = Review::findOrFail($this->selectedReviewId);
        $review->update([
            'comment' => $this->reviewText
        ]);
        $this->getReviews();
        $this->dispatch('updateReview');
    }
    public function confirmDelete($id)
    {

        $this->selectedReviewId = $id;

        // Dispatch event to JS
        $this->dispatch('show-delete-confirmation');
    }
    #[On('deleteItem')]
public function deleteItem()
{
    Review::findOrFail($this->selectedReviewId)->delete();
    $this->getReviews();
    $this->dispatch('itemDeleted'); // بنستخدمه لعرض SweetAlert بعد الحذف
}
    public function render()
    {
        return view('livewire.front.reviews');
    }
}
