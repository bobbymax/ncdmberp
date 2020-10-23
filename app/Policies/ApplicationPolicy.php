<?php

namespace App\Policies;

use App\Application;
use App\User;
use App\Classes\Base;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the application.
     *
     * @param  \App\User  $user
     * @param  \App\Application  $application
     * @return mixed
     */
    public function accessible(User $user, Application $application)
    {
        return $user->isAdministrator() || $user->belongsToDepartment($application->departments);
    }

    /**
     * Determine whether the user can create applications.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function manipulate(User $user)
    {
        return $user->isAdministrator();
    }

}
