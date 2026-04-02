<?php

namespace App\Repositories;

use App\Models\SavedCard;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SavedCardRepository
{
    public function findByIdOrFail(int|string $id): SavedCard
    {
        return SavedCard::findOrFail($id);
    }

    public function clearDefaultForUser(int $userId): int
    {
        return SavedCard::where('user_id', $userId)->update(['is_default' => false]);
    }

    public function update(SavedCard $card, array $data): bool
    {
        return $card->update($data);
    }

    public function delete(SavedCard $card): ?bool
    {
        return $card->delete();
    }

    public function paginateUserCards(int $userId, int $perPage = 5): LengthAwarePaginator
    {
        return SavedCard::where('user_id', $userId)
            ->latest()
            ->paginate($perPage);
    }
}
