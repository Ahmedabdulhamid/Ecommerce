<?php

namespace App\Services;

use App\Models\SavedCard;
use App\Repositories\SavedCardRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SavedCardService
{
    public function __construct(private readonly SavedCardRepository $cards)
    {
    }

    public function findById(int|string $id): SavedCard
    {
        return $this->cards->findByIdOrFail($id);
    }

    public function makeDefault(int $userId, int|string $cardId): void
    {
        $card = $this->cards->findByIdOrFail($cardId);
        $this->cards->clearDefaultForUser($userId);
        $this->cards->update($card, ['is_default' => true]);
    }

    public function delete(int|string $cardId): void
    {
        $card = $this->cards->findByIdOrFail($cardId);
        $this->cards->delete($card);
    }

    public function paginateUserCards(int $userId, int $perPage = 5): LengthAwarePaginator
    {
        return $this->cards->paginateUserCards($userId, $perPage);
    }
}
