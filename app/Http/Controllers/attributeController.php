<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeAttributeValidion;
use App\Models\Attribute;
use Illuminate\Http\Request;

class attributeController extends Controller
{
    public function index()
    {
        $attribute = Attribute::paginate(6);
        return view('attributes.index', compact('attribute'));
    }
    public function store(storeAttributeValidion $request, $id)
    {
        $attribute = new Attribute();
        $attribute->title = $request->title;
        $attribute->save();
        return redirect()->route("attribute.index")->with('success', 'kenmerk succesvol aangemaakt');
    }
    //search function
    public function search(Request $request)
    {
        $search = $request->get('search');
        $attribute = Attribute::where('title', 'like', '%' . $search . '%')->paginate(6);
        return view('attributes.index', compact('attribute'));
    }
    //edit function
    public function edit($id)
    {
        $attribute = Attribute::find($id);
        return view('attributes.edit', compact('attribute' , 'id'));
    }
    //update function
    public function update(storeAttributeValidion $request, $id)
    {
        $attribute = Attribute::find($id);
        $attribute->title = $request->title;
        $attribute->save();
        return redirect()->route("attributes.index")->with('success', 'kenmerk succesvol aangepast');
    }
    //delete function
    public function delete($id)
    {
        $attribute = Attribute::find($id);
        $attribute->delete();
        return redirect()->route("attributes.index")->with('success', 'kenmerk succesvol verwijderd');
    }
}
