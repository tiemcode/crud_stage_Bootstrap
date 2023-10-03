<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class taskController extends Controller
{
    public function index($id)
    {
        $project = Project::where('id', $id)->first();
        $userTasks = [];
        $task = Task::get('project_id');
        foreach ($task as $tasks) {

            foreach ($project->users as $user) {
                $taskUsernames = array();
                if (!in_array($user->name, $taskUsernames)) {
                    $taskUsernames = $user->name;
                }
            }
            $userTasks[$project->id] = $taskUsernames;
        }

        return view("projects.tasks", compact('id', 'project', 'taskUsernames', 'userTasks'));
    }
    public function create($id)
    {
        return view('projects.addTask', compact('id'));
    }
    public function store($id)
    {
        $task = new task();
        $task->title = request('title');
        $task->description = request('description');
        $task->project_id = $id;
        $task->save();
        return redirect()->route('projects.task', ['id' => $id])->with('success', 'taak succesvol toegevoegt');
    }
    public function edit($id, $task_id)
    {

        $tasks = Task::where('id', $task_id)->first();
        return view('projects.editTask', compact('id', 'task_id', 'tasks'));
    }
    public function editUser($id, $task_id, Project $project, Task $task)
    {
        // $users = $project->users();

        // $users = User::whereDoesntHave('tasks', fn ($q) => $q->where('id', $task->id))
        //     ->orderBy('name')
        //     ->get();
        $projectId = DB::table('project_user')->pluck('user_id');
        $users = User::whereIn('id', $projectId)->get();
        return view('projects.tasksUsers', compact('id',  'users', 'task_id'));
    }
    public function updateUser(Request $request, $task_id, $id)
    {
        DB::table('task_user')->where('task_id', $task_id)->update([
            'user_id' => $request->input('users'),
            'updated_at' => date('y-m-d'),
        ]);
        return redirect()->route('projects.task', ['id' => $id])->with('success', 'gebruiker succesvol toegevoegt');
    }
    // public function createTaskUser(Project $project, Task $task)
    // {
    //     $users = $project->users();

    //     $users = User::whereDoesntHave('tasks', fn ($q) => $q->where('id', $task->id))
    //         ->orderBy('name')
    //         ->get();
    // }
}
