<?php

namespace App\Policies;

use App\Models\SavedCard;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
class SavedCardPolicy
{
    use HandlesAuthorization;
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
     public function manage(User $user, SavedCard $card)
    {
        return $user->id === $card->user_id;
    }
}
