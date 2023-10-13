<?php

namespace App\Http\Controllers;

use App\Models\role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class rolesController extends Controller
{
    public function index()
    {
        $allcate = role::get();
        return view('roles.dashboard', compact('allcate'));
    }
    public function store(Request $request)
    {
        role::insert([
            'name' => $request->input('title'),
            'created_at' => date('y-m-d'),
            'updated_at' => date('y-m-d'),
        ]);
        return redirect()->route("role.index")->with('success', 'categorie succesvol aangemaakt');
    }
    public function edit($id)
    {
        if (role::find($id, '*') == false) {
            return Redirect::route('roles.add');
        }
        $data = role::where('id', $id)->first();
        return view('roles.edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        role::where('id', $id)->update([
            'name' => $request->input('title'),
            'updated_at' => date('y-m-d'),
        ]);
    }
    public function delete($id)
    {
        role::where('id', $id)->delete();
        return Redirect::route('roles.index');
    }
    public function search(Request $request)
    {
        $searchTerm = "%" . $request->input('search') . "%";
        if ($searchTerm) {
            $roles = role::where('name', 'LIKE', $searchTerm);
        } else {
            $roles = role::query();
        }
        $roles = $roles->orderBy('created_at', 'desc')
            ->paginate(6)
            ->appends(request()->query());
        return view('roles.dashboard', compact('roles'));
    }
}
