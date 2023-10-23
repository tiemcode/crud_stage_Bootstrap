<?php

namespace App\Http\Controllers;

use App\Http\Requests\shippingRequest;
use App\Models\Address;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class orderController extends Controller
{
    public function cart()
    {
        $products = [];
        if (session()->has('cart')) {
            foreach (session('cart') as $key) {
                // dd($key[1]);
                $product = Product::find($key[0]);
                $product->amount = $key[1];
                $products[] = $product;
            }
            //calulate the total price from shopping cart
            $subtotal = 0;
            foreach ($products as $product) {
                $subtotal += $product->price * $product->amount;
            }
            $vatTotal = 0;
            foreach ($products as $product) {
                $vatTotal += $product->price * $product->amount * $product->vat / 100;
            }
            $totalPrice = 0;
            foreach ($products as $product) {
                $totalPrice += $product->price * $product->amount * $product->vat / 100 + $product->price * $product->amount;
            }
            $totalAmount = 0;
            foreach ($products as $product) {
                $totalAmount += $product->amount;
            }
        } else {
            $totalAmount = 0;
            $totalPrice = 0;
            $vatTotal = 0;
            $subtotal = 0;
        }
        return view('home.cart', compact('products', 'subtotal', 'vatTotal', 'totalPrice', 'totalAmount'));
    }
    public function update(Request $request)
    {
        if ($request->btn == 'plus') {
            $this->increaseQuantity($request->id);
        } else {
            $this->decreaseQuantity($request->id);
        }
        return redirect()->route('cart');
    }
    public function remove(Request $request)
    {
        $cart = session()->get('cart', []);
        unset($cart[$request->id]);
        session()->put('cart', $cart);
        return redirect()->route('cart');
    }
    private function increaseQuantity($productId)
    {
        $cart = session()->get('cart', []);

        if (array_key_exists($productId, $cart)) {
            $cart[$productId][1]++;
            session()->put('cart', $cart);
        }
    }
    private function decreaseQuantity($productId)
    {
        $cart = session()->get('cart', []);

        if (array_key_exists($productId, $cart)) {
            if ($cart[$productId][1] > 1) {
                $cart[$productId][1]--;
            } else {
                unset($cart[$productId]);
            }
            Session()->put('cart', $cart);
        }
    }
    public function checkout()
    {
        if (empty(session('cart'))) {
            return redirect()->route('cart')->with('danger', 'oops er zit niks in je winkelmandje');
        }
        $products = [];

        if (session()->has('cart')) {
            foreach (session('cart') as $key) {
                $product = Product::find($key[0]);
                $product->amount = $key[1];
                $products[] = $product;
            }
            //calulate the total price from shopping cart
            $subtotal = 0;
            foreach ($products as $product) {
                $subtotal += $product->price * $product->amount;
            }
            $vatTotal = 0;
            foreach ($products as $product) {
                $vatTotal += $product->price * $product->amount * $product->vat / 100;
            }
            $totalPrice = 0;
            foreach ($products as $product) {
                $totalPrice += $product->price * $product->amount * $product->vat / 100 + $product->price * $product->amount;
            }
            $totalAmount = 0;
            foreach ($products as $product) {
                $totalAmount += $product->amount;
            }
        } else {
            $totalAmount = 0;
            $totalPrice = 0;
            $vatTotal = 0;
            $subtotal = 0;
        }
        $shoping_info = session('shoping_info');
        return view('cart.checkout', compact('products', 'subtotal', 'shoping_info', 'vatTotal', 'totalPrice', 'totalAmount'));
    }
    //store function
    public function store(shippingRequest $request)
    {
        session()->put('shoping_info', $request->all());
        return redirect()->route('cart.overview');
    }
    public function overview()
    {
        //get all data from session
        $products = [];
        if (session()->has('cart')) {
            foreach (session('cart') as $key) {
                $product = Product::find($key[0]);
                $product->amount = $key[1];
                $products[] = $product;
            }
            //calulate the total price from shopping cart
            $subtotal = 0;
            foreach ($products as $product) {
                $subtotal += $product->price * $product->amount;
            }
            $vatTotal = 0;
            foreach ($products as $product) {
                $vatTotal += $product->price * $product->amount * $product->vat / 100;
            }
            $totalPrice = 0;
            foreach ($products as $product) {
                $totalPrice += $product->price * $product->amount * $product->vat / 100 + $product->price * $product->amount;
            }
            $totalAmount = 0;
            foreach ($products as $product) {
                $totalAmount += $product->amount;
            }
        } else {
            $totalAmount = 0;
            $totalPrice = 0;
            $vatTotal = 0;
            $subtotal = 0;
        }
        $shoping_info = session('shoping_info');
        //save the subtotal , vattotal , totalprice in the session
        $shoping_info['subtotal'] = $subtotal;
        $shoping_info['vatTotal'] = $vatTotal;
        $shoping_info['totalPrice'] = $totalPrice;
        $shoping_info['totalAmount'] = $totalAmount;
        session()->put('shoping_info', $shoping_info);
        // dd(session());
        return view('cart.overview', compact('products', 'subtotal', 'vatTotal', 'totalPrice', 'totalAmount', 'shoping_info'));
    }
    public function storeOrder()
    {
        // Get all data from session
        $cart = session()->get('cart', []);
        $shoping_info = session()->get('shoping_info', []);
        // Create a new ADDRESS
        $order = new Order();
        if (auth::user()) {
            $order->user_id = Auth::user()->id;
        } else {
            $order->user_id = null;
        }
        $order->email = $shoping_info['email'];
        $order->phoneNumber = $shoping_info['phone_number'];
        $order->total_excl = $shoping_info['subtotal'];
        $order->vat = $shoping_info['vatTotal'];
        $order->total_incl = $shoping_info['totalPrice'];
        $order->save();

        $orders = order::get()->last();

        $order = new Address();
        $order->order_id = $orders->id;
        $order->type = 'shipping';
        $order->firstName = $shoping_info['first_name'];
        $order->lastName = $shoping_info['last_name'];
        $order->address = $shoping_info['street'];
        $order->zipCode = $shoping_info['postalcade'];
        $order->city = $shoping_info['city'];
        $order->save();
        if (!isset($shoping_info['openbilling'])) {
            $order = new Address();
            $order->order_id = $orders->id;
            $order->type = 'billing';
            $order->firstName = $shoping_info['first_name_billing'];
            $order->lastName = $shoping_info['last_name_billing'];
            $order->address = $shoping_info['street_billing'];
            $order->zipCode = $shoping_info['postalcade_billing'];
            $order->city = $shoping_info['city_billing'];
            $order->save();
        }
        // Create a new ORDER
        // Create order products
        foreach ($cart as $key => $value) {
            $products = product::find($key);
            $order_product = new Order_product();
            // dd($key, $value, session());
            $order_product->order_id = $orders->id;
            $order_product->product_id = $key;
            $order_product->quantity = $value[1];
            $order_product->price_excl = $products->price;
            $order_product->vat = $products->price / 100 * $products->vat;
            $order_product->price_incl = ($products->price / 100 * $products->vat) + $products->price;
            $order_product->save();
        }
        // Clear session data
        session()->forget('cart');
        session()->forget('shoping_info');
        return redirect()->route('product.home')->with('success', 'Bedankt voor uw bestelling!');
    }
}
