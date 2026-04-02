<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository
{
    public function queryWithLocation(): Builder
    {
        return User::query()->with(['country', 'governorate']);
    }

    public function findByIdOrFail(int|string $id): User
    {
        return User::findOrFail($id);
    }

    public function count(): int
    {
        return User::count();
    }

    public function update(User $user, array $data): bool
    {
        return $user->update($data);
    }

    public function delete(User $user): ?bool
    {
        return $user->delete();
    }
}
