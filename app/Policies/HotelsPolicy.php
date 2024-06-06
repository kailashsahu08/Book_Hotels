<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Hotels;
use App\Models\User;

class HotelsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any Hotels');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Hotels $hotels): bool
    {
        return $user->checkPermissionTo('view Hotels');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create Hotels');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Hotels $hotels): bool
    {
        return $user->checkPermissionTo('update Hotels');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Hotels $hotels): bool
    {
        return $user->checkPermissionTo('delete Hotels');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Hotels $hotels): bool
    {
        return $user->checkPermissionTo('restore Hotels');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Hotels $hotels): bool
    {
        return $user->checkPermissionTo('force-delete Hotels');
    }
}
