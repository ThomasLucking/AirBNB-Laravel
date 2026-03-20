<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Apartment;

class ApartmentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Apartment $apartment): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Apartment $apartment): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Apartment $apartment): bool
    {
        return $user->id == $apartment->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Apartment $apartment): bool
    {
        return $user->id === $apartment->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Apartment $apartment): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Apartment $apartment): bool
    {
        return true;
    }
}
