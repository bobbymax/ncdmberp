<?php

namespace App\Policies;

use App\TrainingDetail;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrainingDetailPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\TraningDetail  $traningDetail
     * @return mixed
     */
    public function view(User $user, TrainingDetail $traningDetail)
    {
        //
    }

    public function manage(User $user, TrainingDetail $trainingDetail)
    {
        return $user->isAdministrator() || $user->hasRole('hr-officer');
    }

    /**
     * Determine whether the user can view the training.
     *
     * @param  \App\User  $user
     * @param  \App\Training  $training
     * @return mixed
     */
    public function nominations(User $user, TrainingDetail $traningDetail)
    {
        return $user->isAdministrator() || $user->hasRole('manager');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\TraningDetail  $traningDetail
     * @return mixed
     */
    public function update(User $user, TrainingDetail $traningDetail)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\TraningDetail  $traningDetail
     * @return mixed
     */
    public function delete(User $user, TrainingDetail $traningDetail)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\TraningDetail  $traningDetail
     * @return mixed
     */
    public function restore(User $user, TrainingDetail $traningDetail)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\TraningDetail  $traningDetail
     * @return mixed
     */
    public function forceDelete(User $user, TrainingDetail $traningDetail)
    {
        //
    }
}
