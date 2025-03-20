<?php

namespace App\Policies;

use App\Models\Access;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AccessPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('access-request.view.any');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Access $access): bool
    {
        return $user->hasPermissionTo('access-request.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermissionTo('access-request.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Access $access): bool
    {
        return $user->hasPermissionTo('access-request.edit');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Access $access): bool
    {
        return $user->hasPermissionTo('access-request.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Access $access): bool
    {
        return $user->hasPermissionTo('access-request.restore');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Access $access): bool
    {
        return $user->hasPermissionTo('access-request.delete');
    }
    public function grant(User $user, Access $access): bool
    {
        return $user->hasPermissionTo('access-request.grant');
    }
    public function modify(User $user, Access $access): bool
    {
        return $user->hasPermissionTo('access-request.modify');
    }
    public function revoke(User $user, Access $access): bool
    {
        return $user->hasPermissionTo('access-request.revoke');
    }
    public function updateStatus(User $user, Access $access): bool
    {
        return $user->hasPermissionTo('access-request.update.status');
    }

}
