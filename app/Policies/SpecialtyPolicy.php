<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Specialty;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpecialtyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the specialty can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list specialties');
    }

    /**
     * Determine whether the specialty can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Specialty  $model
     * @return mixed
     */
    public function view(User $user, Specialty $model)
    {
        return $user->hasPermissionTo('view specialties');
    }

    /**
     * Determine whether the specialty can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create specialties');
    }

    /**
     * Determine whether the specialty can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Specialty  $model
     * @return mixed
     */
    public function update(User $user, Specialty $model)
    {
        return $user->hasPermissionTo('update specialties');
    }

    /**
     * Determine whether the specialty can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Specialty  $model
     * @return mixed
     */
    public function delete(User $user, Specialty $model)
    {
        return $user->hasPermissionTo('delete specialties');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Specialty  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete specialties');
    }

    /**
     * Determine whether the specialty can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Specialty  $model
     * @return mixed
     */
    public function restore(User $user, Specialty $model)
    {
        return false;
    }

    /**
     * Determine whether the specialty can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Specialty  $model
     * @return mixed
     */
    public function forceDelete(User $user, Specialty $model)
    {
        return false;
    }
}
