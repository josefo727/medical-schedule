<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Auth\Access\HandlesAuthorization;

class DoctorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the doctor can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list doctors');
    }

    /**
     * Determine whether the doctor can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Doctor  $model
     * @return mixed
     */
    public function view(User $user, Doctor $model)
    {
        return $user->hasPermissionTo('view doctors');
    }

    /**
     * Determine whether the doctor can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create doctors');
    }

    /**
     * Determine whether the doctor can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Doctor  $model
     * @return mixed
     */
    public function update(User $user, Doctor $model)
    {
        return $user->hasPermissionTo('update doctors');
    }

    /**
     * Determine whether the doctor can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Doctor  $model
     * @return mixed
     */
    public function delete(User $user, Doctor $model)
    {
        return $user->hasPermissionTo('delete doctors');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Doctor  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete doctors');
    }

    /**
     * Determine whether the doctor can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Doctor  $model
     * @return mixed
     */
    public function restore(User $user, Doctor $model)
    {
        return false;
    }

    /**
     * Determine whether the doctor can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Doctor  $model
     * @return mixed
     */
    public function forceDelete(User $user, Doctor $model)
    {
        return false;
    }
}
