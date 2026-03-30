<?php

namespace App\Policies;

use App\Models\User;

class EditUserInfoPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $authUser, User $user): bool
    {
        return $authUser->id === $user->id || $authUser->role === 'admin';
    }

    public function promote(User $authUser, User $user): bool
    {
        return $authUser->role === 'admin';
    }

    public function destroy(User $authUser, User $user): bool
    {
        return $authUser->role === 'admin';
    }
}
