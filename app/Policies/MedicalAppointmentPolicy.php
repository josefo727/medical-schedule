<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MedicalAppointment;
use Illuminate\Auth\Access\HandlesAuthorization;

class MedicalAppointmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the medicalAppointment can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list medicalappointments');
    }

    /**
     * Determine whether the medicalAppointment can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MedicalAppointment  $model
     * @return mixed
     */
    public function view(User $user, MedicalAppointment $model)
    {
        return $user->hasPermissionTo('view medicalappointments');
    }

    /**
     * Determine whether the medicalAppointment can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create medicalappointments');
    }

    /**
     * Determine whether the medicalAppointment can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MedicalAppointment  $model
     * @return mixed
     */
    public function update(User $user, MedicalAppointment $model)
    {
        return $user->hasPermissionTo('update medicalappointments');
    }

    /**
     * Determine whether the medicalAppointment can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MedicalAppointment  $model
     * @return mixed
     */
    public function delete(User $user, MedicalAppointment $model)
    {
        return $user->hasPermissionTo('delete medicalappointments');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MedicalAppointment  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete medicalappointments');
    }

    /**
     * Determine whether the medicalAppointment can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MedicalAppointment  $model
     * @return mixed
     */
    public function restore(User $user, MedicalAppointment $model)
    {
        return false;
    }

    /**
     * Determine whether the medicalAppointment can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\MedicalAppointment  $model
     * @return mixed
     */
    public function forceDelete(User $user, MedicalAppointment $model)
    {
        return false;
    }
}
