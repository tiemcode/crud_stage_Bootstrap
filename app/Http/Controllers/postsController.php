<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleValidation;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;

class postsController extends Controller
{
    public function index()
    {
        $allPosts = Post::get();
        return  view('home.welcome', [
            'allposts' => $allPosts,
        ]);
    }
    public function showAdmin()
    {
        $allPosts = Post::orderBy('created_at', 'desc')->paginate(6);
        return view("articales.dashboard", ['allposts' => $allPosts]);
    }
    public function edit($id)
    {
        if (Post::find($id, '*') == false) {
            return redirect::route('addPost');
        }
        $allcate = Category::get();
        $data = Post::where('id', $id)->first();
        return view('articales.edit', ['data' => $data, 'catedata' => $allcate]);
    }
    public function addGet()
    {
        $allcate = Category::get();
        return view('articales.addPost', ['catedata' => $allcate]);
    }
    public function deletePost($id)
    {
        Post::where('id', $id)->delete();
        return redirect::route('dashboard');
    }
    public function store(StoreArticleValidation $request)
    {
        $article = new Post();
        $article->title = $request->title;
        $article->intro = $request->intro;
        $article->description = $request->description;
        if ($request->has('file')) {

            $p = 'public/';
            $path = $request->file('file')->store($p . 'articles');
            $article->file_name = 'storage/' . substr($path, strlen($p));
        }
        $article->category_id = $request->cate;
        // https://stackoverflow.com/a/11435513
        $article->date_posted = (new \DateTime($request->date_publised))->format('Y-m-d');
        $article->save();
        return redirect()->route("dashboard")->with('success', 'bericht aangemaakt');
    }

    public function editpost(Request $request, $id)
    {
        Post::where('id', $id)->update([
            'title' => $request->input('title'),
            'intro' => $request->input('intro'),
            'description' => $request->input('description'),
            'date_posted' => $request->input('date_publised'),
            "updated_at" => date('y-m-d'),
            'category_id' => $request->cate
        ]);
        return redirect()->route("dashboard")->with('success', 'Bericht succesvol bewerkt');
    }
    public function search(Request $request)
    {
        $searchTerm = "%" . $request->input('search') . "%";
        if ($searchTerm) {
            $posts = Post::where('title', 'LIKE', $searchTerm);
            if ($posts->IsNotEmpty()) {
                $posts = $posts->orWhereBelongsTo(Category::where('name', 'like', $searchTerm)->get());
            }
        } else {
            $posts = Post::query();
        }
        $posts = $posts->orderBy('created_at', 'desc')
            ->paginate(6)
            ->appends(request()->query());
        return view('articales.search', compact('posts'));
    }
}
