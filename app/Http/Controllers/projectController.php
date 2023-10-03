<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectValidation;
use App\Models\Project;
use App\Models\role;
use App\Models\user;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class projectController extends Controller
{
    public function home()
    {
        return view('home.projects');
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
    public function update(Request $request, $id)
    {
        project::where('id', $id)->update([
            'name' => $request->input('title'),
            'intro' => $request->input('intro'),
            'description' => $request->input('description'),
            'updated_at' => date('y-m-d'),
        ]);
    }
    public function add()
    {
        return view('projects.add');
    }
    public function store(StoreProjectValidation $request)
    {
        $project = new Project();
        $project->title = $request->title;
        $project->intro = $request->intro;
        $project->description = $request->description;
        $project->save();
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
            $projects = Project::where('name', 'LIKE', $searchTerm);
        } else {
            $projects = project::query();
        }
        $projects = $projects->orderBy('created_at', 'desc')
            ->paginate(6)
            ->appends(request()->query());
        return view('projects.search', compact('projects'));
    }
}
