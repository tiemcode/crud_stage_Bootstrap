<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectValidation;
use App\Models\Project;
use App\Models\role;
use App\Models\Task;
use App\Models\user;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class projectController extends Controller
{
    public function home()
    {
        $projects = project::orderbyDesc('created_at')->get();
        $projects = auth()->user()->projects;
        return view('home.projects', compact('projects'));
    }
    public function details(Project $project)
    {
        $this->authorize('hasProject', [Project::class, $project]);
        return view('projects.details', compact('project'));
    }
    public function taskFinish(Request $request, $project)
    {
        $task = Task::where('id', $request->task)->first();
        $task->finshed = $request->value;
        $task->save();
        return redirect()->route('project.details', ['project' => $project]);
    }
    public function index()
    {
        $project = Project::orderBy('created_at', 'desc')->paginate(6);
        return view('projects.dashboard', compact('project'));
    }

    public function edit($id)
    {
        if (Project::find($id) == false) {
            return Redirect::route('projects.add');
        }
        $data = Project::where('id', $id)->first();
        return view('projects.edit', compact('data',));
    }
    public function update(StoreProjectValidation $request, $id)
    {
        $project = Project::find($id);
        $project->name =  $request->name;
        $project->intro = $request->intro;
        $project->description = $request->description;
        $project->updated_at = date('y-m-d');
        $project->save();
        return redirect::route('projects.index')->with('success', 'project succesvol aangepast');
    }
    public function add()
    {
        return view('projects.add');
    }
    public function store(StoreProjectValidation $request)
    {
        $project = new Project();
        $project->name = $request->name;
        $project->intro = $request->intro;
        $project->description = $request->description;
        $project->save();
        return redirect::route('projects.index')->with('success', 'project succesvol aangepast');
    }
    public function delete($id)
    {
        Project::where('id', $id)->delete();
        return redirect::route('projects.index');
    }
    public function getUser($id)
    {
        $data = Project::where('id', $id)->first();
        $items = DB::table('project_user')->where('id', $id)->get();
        return view('projects.user', compact('data', 'items'));
    }
    public function deleteUser($id)
    {
        Project::where('id', $id)->delete();
        return redirect::route('projects.user', ['id' => $id]);
    }
    public function editUser($projectId, $userId)
    {
        $roles = role::get();
        $user = user::where('id', $userId)->first();
        return view("projects.edituser", compact('roles', 'user', 'userId', 'projectId'));
    }
    public function updateUser(Request $request, $projectId, $userId)
    {
        DB::table('project_user')->where('id', $userId)->update(['role_id' => $request->rollen]);
        return redirect()->route("projects.user", ['id' => $projectId])->with('success', 'rol succesvol aangepast');
    }
    public function adduser($id)
    {
        $user = user::all();
        $role = role::get();
        return view('projects.adduser', compact('user', 'id', 'role'));
    }
    public function addeduser(Request $request, $id)
    {
        DB::table('project_user')->insert([
            'project_id' => $id,
            'role_id' => $request->rollen,
            'user_id' => $request->user_id
        ]);
        return redirect()->route("projects.user", ['id' => $id])->with('success', 'gebruiker succesvol toegevoegt');
    }
    public function search(Request $request)
    {
        $searchTerm = "%" . $request->input('search') . "%";
        if ($searchTerm) {
            $project = Project::where('name', 'LIKE', $searchTerm);
        } else {
            $project = project::query();
        }
        $project = $project->orderBy('created_at', 'desc')
            ->paginate(6)
            ->appends(request()->query());
        return view('projects.dashboard', compact('project'));
    }
}
