<?php

namespace App\Services;

use App\Repositories\ReviewRepository;
use Illuminate\Database\Eloquent\Collection;

class ReviewService
{
    public function __construct(private readonly ReviewRepository $reviews)
    {
    }

    public function getUserReviews(int $userId): Collection
    {
        return $this->reviews->getUserReviews($userId);
    }

    public function getById(int|string $id)
    {
        return $this->reviews->findByIdOrFail($id);
    }

    public function updateComment(int|string $id, string $comment): void
    {
        $review = $this->reviews->findByIdOrFail($id);
        $this->reviews->update($review, ['comment' => $comment]);
    }

    public function delete(int|string $id): void
    {
        $review = $this->reviews->findByIdOrFail($id);
        $this->reviews->delete($review);
    }
}
