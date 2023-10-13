<?php

namespace App\Policies;

use App\Models\attribute_product;
use App\Models\Project;
use App\Models\project_user;
use App\Models\task_user;
use App\Models\Task;
use App\Models\User;

class projectPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function hasProject(User $user, Project $project)
    {
        return ($user->Projects->contains($project));
    }

    public function canFinish(user $user, Project $project, Task $task)
    {
        return ($task->users->contains($user));
    }
}
