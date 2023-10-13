<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use App\Models\task_user;
use Hamcrest\Core\IsNot;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

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
    public function store($project_id)
    {
        $task = new task();
        $task->title = request('title');
        $task->description = request('description');
        $task->project_id = $project_id;
        $task->save();
        return redirect()->route('projects.task', ['id' => $project_id])->with('success', 'taak succesvol toegevoegt');
    }
    public function edit($project_id, $task_id)
    {

        $projectId = DB::table('project_user')->pluck('user_id');
        $users = User::whereIn('id', $projectId)->get();
        $tasks = Task::where('id', $task_id)->first();
        return view('projects.editTask', compact('project_id', 'task_id', 'users', 'tasks'));
    }
    public function update(Request $request, $project_id, $task_id)
    {
        if ($request->users != null) {
            foreach ($request->users as $input) {
                $taskUser = task_user::where('task_id', $task_id)->first();
                dd($taskUser);
                
                $taskUser->user_id = $input;
                $taskUser->updated_at = date('y-m-d', time());
                $taskUser->save();
            }
        }
        $task = task::where('id', $project_id)->first();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->updated_at = date('y-m-d', time());
        $task->save();
        return redirect()->route('projects.task', ['id' => $project_id])->with('success', 'taak succesvol geupdate');
    }
}
