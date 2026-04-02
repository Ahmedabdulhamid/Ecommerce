<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    public function __construct(private readonly UserRepository $users)
    {
    }

    public function queryWithLocation(): Builder
    {
        return $this->users->queryWithLocation();
    }

    public function toggleStatus(int|string $id): void
    {
        $user = $this->users->findByIdOrFail($id);

        $this->users->update($user, [
            'status' => $user->status === 'active' ? 'inactive' : 'active',
        ]);
    }

    public function delete(int|string $id): int
    {
        $user = $this->users->findByIdOrFail($id);
        $this->users->delete($user);

        return $this->users->count();
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function register(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'country_id' => $data['country_id'],
            'governorate_id' => $data['governorate_id'],
            'password' => Hash::make($data['password']),
            'token' => Str::random(40),
        ]);
    }

    public function updateProfile(int|string $id, array $data): bool
    {
        $user = $this->users->findByIdOrFail($id);

        return $this->users->update($user, $data);
    }

    public function updatePassword(int|string $id, string $password): bool
    {
        $user = $this->users->findByIdOrFail($id);

        return $this->users->update($user, ['password' => Hash::make($password)]);
    }
}
