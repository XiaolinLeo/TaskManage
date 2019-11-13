<?php

namespace App\Policies;

use App\Project;
use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }




    public function update(User $currentuser, User $user)
    {

        return $currentuser->id === $user->id;
    }
}
