<?php

namespace App\Policies;

use App\Module;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ModulePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the application.
     *
     * @param  \App\User  $user
     * @param  \App\Application  $application
     * @return mixed
     */
    public function accessible(User $user, Module $module)
    {
        return $user->isAdministrator() || $user->belongsToDepartment($module->application->departments);
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
