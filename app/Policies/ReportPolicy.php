<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Report;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the report can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list reports');
    }

    /**
     * Determine whether the report can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Report  $model
     * @return mixed
     */
    public function view(User $user, Report $model)
    {
        return $user->hasPermissionTo('view reports');
    }

    /**
     * Determine whether the report can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create reports');
    }

    /**
     * Determine whether the report can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Report  $model
     * @return mixed
     */
    public function update(User $user, Report $model)
    {
        return $user->hasPermissionTo('update reports');
    }

    /**
     * Determine whether the report can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Report  $model
     * @return mixed
     */
    public function delete(User $user, Report $model)
    {
        return $user->hasPermissionTo('delete reports');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Report  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete reports');
    }

    /**
     * Determine whether the report can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Report  $model
     * @return mixed
     */
    public function restore(User $user, Report $model)
    {
        return false;
    }

    /**
     * Determine whether the report can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Report  $model
     * @return mixed
     */
    public function forceDelete(User $user, Report $model)
    {
        return false;
    }
}
