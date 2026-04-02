<?php

namespace App\Repositories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Collection;

class ReviewRepository
{
    public function getUserReviews(int $userId): Collection
    {
        return Review::where('user_id', $userId)
            ->with('product.images')
            ->get();
    }

    public function findByIdOrFail(int|string $id): Review
    {
        return Review::findOrFail($id);
    }

    public function update(Review $review, array $data): bool
    {
        return $review->update($data);
    }

    public function delete(Review $review): ?bool
    {
        return $review->delete();
    }
}
