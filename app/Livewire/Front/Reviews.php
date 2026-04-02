<?php

namespace App\Livewire\Front;

use App\Services\ReviewService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Reviews extends Component
{
    public $selectedReviewId;
    protected $listeners = ['getReviews' => 'getReviews'];
    public $reviewText;
    public $reviews = [];

    public function mount(ReviewService $reviewService)
    {
        $this->getReviews($reviewService);
    }

    public function getReviews(ReviewService $reviewService)
    {
        $this->reviews = $reviewService->getUserReviews(Auth::guard('web')->user()->id);
    }

    public function editReview($id, ReviewService $reviewService)
    {
        $this->selectedReviewId = $id;
        $review = $reviewService->getById($id);
        $this->reviewText = $review->comment;
    }

    public function submit(ReviewService $reviewService)
    {
        $reviewService->updateComment($this->selectedReviewId, $this->reviewText);
        $this->getReviews($reviewService);
        $this->dispatch('updateReview');
    }

    public function confirmDelete($id)
    {
        $this->selectedReviewId = $id;
        $this->dispatch('show-delete-confirmation');
    }

    #[On('deleteItem')]
    public function deleteItem(ReviewService $reviewService)
    {
        $reviewService->delete($this->selectedReviewId);
        $this->getReviews($reviewService);
        $this->dispatch('itemDeleted');
    }

    public function render()
    {
        return view('livewire.front.reviews');
    }
}
