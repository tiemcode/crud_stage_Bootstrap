<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeProductValidation;
use App\Models\Attribute;
use App\Models\attribute_product;
use App\Models\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    //home function
    public function home()
    {
        $allproduct = product::all();
        $allattribute = attribute_product::get();
        return view('home.product', compact('allproduct', 'allattribute'));
    }
    //details function
    public function details($id)
    {
        $product = Product::find($id);
        $attributes = attribute_product::where('product_id', $id)->get();
        return view('products.view', compact('product', 'attributes'));
    }
    //shoppingCart function
    public function shoppingCart(Request $request, $productId)
    {

        // session()->flush();
        $amount = $request->amount;
        if (session()->has('cart')) {
            $cart = session('cart');
            // Check if the product ID exists in the cart
            if (array_key_exists($productId, $cart)) {
                // Product exists, update the amount
                $cart[$productId][1] += $amount;
            } else {
                // Product doesn't exist, add it to the cart
                $cart[$productId] = [$productId, $amount];
            }
            // Update the session with the updated cart
            session(['cart' => $cart]);
        } else {
            // If 'cart' key doesn't exist in the session, create a new cart array
            $cart = [$productId => [$productId, $amount]];
            session(['cart' => $cart]);
        }

        return redirect()->route('product.home')->with('success', 'aan winkelmand toegevoegd');
    }
    public function search(Request $request)
    {
        $searchTerm = "%" . $request->input('search') . "%";
        if ($searchTerm) {
            $product = Product::where('title', 'LIKE', $searchTerm);
        } else {
            $product = Product::query();
        }
        $product = $product->orderBy('created_at', 'desc')
            ->paginate(6)
            ->appends(request()->query());
        return view('products.index', compact('product'));
    }
    //index function
    public function index()
    {
        $product = Product::orderBy('created_at', 'desc')->paginate(6);
        return view('products.index', compact('product'));
    }
    //edit function
    public function edit($id)
    {
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }
    //update function
    public function update(storeProductValidation $request, $id)
    {
        $product = Product::find($id);
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->stock = $request->input('stock');
        $product->price = $request->input('price');
        $product->vat = $request->input('vat');
        //a check if img exsits
        if ($request->hasFile('image')) {
            //delete image
            if ($product->img !== 'img-placeholder.png') {
                unlink(public_path('products/' . $product->img));
            }
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $filename = time() . '_' . $name;
            $file->move(public_path('products/'), $filename);
            $product->img = $filename;
        }
        $product->updated_at = date('y-m-d');
        $product->save();
        return redirect()->route('products.index')->with('success', 'attribute is sucsesfull aangepast');
    }
    //add function
    public function add()
    {
        return view('products.add');
    }
    //store function
    public function store(storeProductValidation $request)
    {
        $product = new Product();
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->stock = $request->input('stock');
        $product->price = $request->input('price');
        $product->vat = $request->input('vat');
        //a check if img exsits
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $filename = time() . '_' . $name;
            $file->move(public_path('products/'), $filename);
            $product->img = $filename;
        } else {
            $product->img = 'img-placeholder.png';
        }
        $product->created_at = date('y-m-d');
        $product->save();
        return redirect()->route('products.index')->with('success', 'attribute is sucsesfull toegevoegd');
    }
    //delete function
    public function delete($id)
    {
        $product = Product::find($id);
        if ($product->img !== 'img_placeholder.png') {
            //delete image
            unlink(public_path('products/' . $product->img));
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'attribute is sucsesfull verwijderd');
    }
    public function attributeIndex($id)
    {
        $attributes = attribute_product::where('product_id', $id)->get();
        return view('products.attribute', compact('id', 'attributes'));
    }
    public function attributeAdd($id)
    {
        $allattri = Attribute::all();
        return view('products.attributeAdd', compact('allattri', 'id'));
    }
    //attributeStore
    public function attributeStore(Request $request, $id)
    {
        $attribute = new attribute_product();
        $attribute->product_id = $id;
        $attribute->attribute_id = $request->input('attribuut');
        $attribute->value = $request->input('value');
        $attribute->created_at = date('y-m-d');
        $attribute->save();
        return redirect()->route('products.index')->with('success', 'attribuut is sucsesfull toegevoegd');
    }
    //attributeEdit
    public function attributeEdit($id, $attributeId)
    {
        $allattri = Attribute::all();

        $attribute = attribute_product::find($attributeId);
        return view('products.attributeEdit', compact('attribute', 'allattri', 'id'));
    }
    //attributeUpdate
    public function attributeUpdate(Request $request, $id, $attributeId)
    {
        $attribute = attribute_product::find($attributeId);
        $attribute->attribute_id = $request->input('attribuut');
        $attribute->product_id = $id;
        $attribute->value = $request->input('value');
        $attribute->updated_at = date('y-m-d');
        $attribute->save();
        return redirect()->route('products.attribute', ['id' => $id])->with('success', 'attribuut is sucsesfull aangepast');
    }
    //attributeDelete
    public function attributeDelete($id, $attributeId)
    {
        $attribute = attribute_product::find($attributeId);
        $attribute->delete();
        return redirect()->route('products.attribute', ['id' => $id])->with('success', 'attribuut is sucsesfull verwijderd');
    }
}
