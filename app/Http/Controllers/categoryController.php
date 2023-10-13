<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class categoryController extends Controller
{
    public function index()
    {
        $allcate = Category::paginate(6);
        return view('categorys.category', ['allcate' => $allcate]);
    }
    public function store(Request $request)
    {
        Category::insert([
            'name' => $request->input('title'),
            'created_at' => date('y-m-d'),
            'updated_at' => date('y-m-d'),
        ]);
        return redirect()->route("category.index")->with('success', 'categorie succesvol aangemaakt');
    }
    public function edit($id)
    {
        if (Category::find($id, '*') == false) {
            return redirect::route('category.add');
        }
        $data = Category::where('id', $id)->first();
        return view('categorys.edit', compact('id', 'data'));
    }
    public function update(Request $request, $id)
    {
        Category::where('id', $id)->update([
            'name' => $request->input('title'),
            'updated_at' => date('y-m-d'),
        ]);
    }
    public function delete($id)
    {
        Category::where('id', $id)->delete();
        return Redirect::route('category.index');
    }
    public function search(Request $request)
    {
        $searchTerm = "%" . $request->input('search') . "%";
        if ($searchTerm) {
            $categorys = Category::where('name', 'LIKE', $searchTerm);
        } else {
            $categorys = Category::query();
        }
        $categorys = $categorys->orderBy('created_at', 'desc')
            ->paginate(6)
            ->appends(request()->query());
        return view('categorys.category', compact('categorys'));
    }
}
