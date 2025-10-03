<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Imigrasi;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImigrasiPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_imigrasi');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Imigrasi $imigrasi): bool
    {
        return $user->can('view_imigrasi');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_imigrasi');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Imigrasi $imigrasi): bool
    {
        return $user->can('update_imigrasi');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Imigrasi $imigrasi): bool
    {
        return $user->can('delete_imigrasi');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Imigrasi $imigrasi): bool
    {
        return $user->can('restore_imigrasi');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Imigrasi $imigrasi): bool
    {
        return $user->can('force_delete_imigrasi');
    }
}