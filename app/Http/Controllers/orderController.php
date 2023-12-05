<?php

namespace App\Http\Controllers;

use App\Http\Requests\amountRequest;
use App\Http\Requests\orderInfo;
use App\Http\Requests\shippingInfoRequest;
use App\Http\Requests\updateAddresShippingrequest;
use App\Models\Address;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class orderController extends Controller
{
    public function home()
    {
        $user = auth::id();
        $orders = Order::orderBy('created_at', 'desc')->where('user_id', $user)->get();
        // dd($orders);
        return view('home.order', compact('orders'));
    }
    public function details(Order $order)
    {
        $this->authorize('Order', [Order::class, $order]);
        $orderProduct = Order_product::where('order_id', $order->id)->get();
        $addres = Address::where('order_id', $order->id)->get();
        //get only the product from a order_product
        $product = [];
        foreach ($orderProduct as $item) {
            $product[] = Product::find($item->product_id);
        }

        return view('products.details', compact('order', 'product', 'orderProduct', 'addres'));
    }
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
    public function store(shippingInfoRequest $request)
    {
        session()->put('shoping_info', $request->all());
        return redirect()->route("cart.overview");
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
        $order->fullName = $shoping_info['shipping']['firstName'] . ' ' . $shoping_info['shipping']['lastName'];
        $order->email = $shoping_info['shipping']['email'];
        $order->phoneNumber = $shoping_info['shipping']["phone"];
        $order->total_excl = $shoping_info['subtotal'];
        $order->vat = $shoping_info['vatTotal'];
        $order->total_incl = $shoping_info['totalPrice'];
        $order->save();
        $orders = order::get()->last();
        $order = new Address();
        $order->order_id = $orders->id;
        $order->type = 'shipping';
        $order->firstName = $shoping_info['shipping']['firstName'];
        $order->lastName = $shoping_info['shipping']['lastName'];
        $order->address = $shoping_info['shipping']['street'];
        $order->zipCode = $shoping_info['shipping']['postalcade'];
        $order->city = $shoping_info['shipping']['city'];
        $order->save();
        if (!isset($shoping_info['openbilling'])) {
            $order = new Address();
            $order->order_id = $orders->id;
            $order->firstName = $shoping_info["billing"]['firstName'];
            $order->lastName = $shoping_info["billing"]['firstName'];
            $order->address = $shoping_info["billing"]['street'];
            $order->zipCode = $shoping_info["billing"]['postalcade'];
            $order->city = $shoping_info["billing"]['city'];
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
            $order_product->amount = $value[1];
            $order_product->price_excl = $products->price;
            $order_product->vat = $products->price / 100 * $products->vat;
            $order_product->price_incl = ($products->price / 100 * $products->vat) + $products->price;
            $order_product->save();
        }
        $this->orderMail();
        // Clear session data
        session()->forget('cart');
        session()->forget('shoping_info');
        return redirect()->route('cart.storeSucces')->with('success', 'Bedankt voor uw bestelling!');
    }
    public function storeSucces()
    {
        $order = order::get()->last();
        $orderAddres = Address::where('order_id', $order->id)->get();
        $orderProduct = order_product::where('order_id', $order->id)->get();
        $products = [];
        foreach ($orderProduct as $item) {
            $product = Product::find($item->product_id);
            $product->amount = $item->amount;
            $products[] = $product;
        }
        return view('cart.succes', compact('order', 'orderAddres', 'products', 'orderProduct'));
    }

    private function orderMail()
    {
        $order = Order::get()->last();
        $orderProduct = Order_product::where('order_id', $order->id)->get();
        $addres = Address::where('order_id', $order->id)->get();
        //get only the product from a order_product
        $product = [];
        foreach ($orderProduct as $item) {
            $product[] = Product::find($item->product_id);
        }
        Mail::send('mail.order', compact(
            'order',
            'product',
            'orderProduct',
            'addres'
        ), function ($message) use ($order) {
            $message->to($order['email'])->subject('Order confirmation');
        });
    }
    public function index()
    {
        $this->authorize('isAdmin', User::class);
        $orders = Order::orderby('created_at', 'desc')->get();
        return view('order.index', compact('orders'));
    }
    //show
    public function show(Order $order)
    {
        $this->authorize('isAdmin', User::class);
        $orderProduct = Order_product::where('order_id', $order->id)->get();
        $addres = Address::where('order_id', $order->id)->get();
        //get only the product from a order_product
        $product = [];
        foreach ($orderProduct as $item) {
            $product[] = Product::find($item->product_id);
        }
        $fullName =  $addres[0]->firstName . $addres[0]->lastName;
        return view('order.show', compact('order', 'product', 'fullName',  'orderProduct', 'addres'));
    }
    //delete
    public function delete(Order $order)
    {
        $this->authorize('isAdmin', User::class);
        $order->delete();
        return redirect()->route("orders.index")->with('success', 'Order deleted successfully');
    }
    //search
    public function search(Request $request)
    {
        $this->authorize('isAdmin', User::class);
        $search = $request->get('search');
        $orders = Order::where('id', 'like', '%' . $search . '%')->paginate(5);
        return view('order.index', compact('orders'));
    }
    //edit
    public function edit(Order $order)
    {
        $this->authorize('isAdmin', User::class);
        return view('order.edit', compact('order',));
    }
    //update
    public function orderInfo(orderInfo $request, Order $order)
    {
        $this->authorize('isAdmin', User::class);
        $order->firstName = $request->firstName;
        $order->lastName = $request->lastName;
        $order->email = $request->email;
        $order->phoneNumber = $request->phoneNumber;
        $order->save();
        return redirect()->route("orders.index")->with('success', 'Order updated successfully');
    }
    //editProduct
    public function editProduct(Order $order, Product $product)
    {
        $this->authorize('isAdmin', User::class);
        $allproduct = product::all();
        $orderProduct = Order_product::where('order_id', $order->id)->get();

        //get only the product from a order_product
        $products = [];
        foreach ($orderProduct as $item) {
            $product->amount = $item->amount;
            $products[] = Product::find($item->product_id);
        }
        return view('order.product', compact('order', 'products', 'allproduct',  'orderProduct',));
    }
    //addproduct function
    public function addProduct(amountRequest $request, Order $order)
    {
        $this->authorize('isAdmin', User::class);
        $product = Product::where('id', $request->product);
        //check if product is in database
        $product = $product->first();
        if ($product->count() == 0) {
            return redirect()->route('orders.editProduct', $order)->with('danger', 'Product not found');
        }
        //check if product is already in order
        $orderProduct = Order_product::where('order_id', $order->id)->get();
        foreach ($orderProduct as $item) {
            if ($item->product_id == $request->product) {
                //update the amount
                $this->calculateTotalPrice($order);
                $item->amount += $request->amount;
                $item->save();
                return redirect()->route('orders.editProduct', $order)->with('success', 'Hoeveelheid van product succesfol aangepast');
            } else {
                $order_product = new Order_product();
                $order_product->order_id = $order->id;
                $order_product->product_id = $request->product;
                $order_product->amount = $request->amount;
                $order_product->price_excl = $product->price;
                $order_product->vat = $product->price / 100 * $product->vat;
                $order_product->price_incl = ($product->price / 100 * $product->vat) + $product->price;
                $this->calculateTotalPrice($order);
                $order_product->save();
                return redirect()->route('orders.editProduct', $order)->with('success', 'Product successfully toegevoegt');
            }
        }
    }

    private function calculateTotalPrice($order)
    {
        $this->authorize('isAdmin', User::class);
        $orderProduct = Order_product::where('order_id', $order->id)->get();
        $totalPrice = 0;
        foreach ($orderProduct as $item) {
            $totalPrice += $item->price_incl * $item->amount;
        }
        $order->total_incl = $totalPrice;
        $order->save();
        //for vat and total_excl
        $total_excl = 0;
        foreach ($orderProduct as $item) {
            $total_excl += $item->price_excl * $item->amount;
        }
        $order->total_excl = $total_excl;
        $order->save();
        $vat = 0;
        foreach ($orderProduct as $item) {
            $vat += $item->vat * $item->amount;
        }
        $order->vat = $vat;
        $order->save();
        return redirect()->route("orders.index")->with('success', 'Total price calculated and saved successfully');
    }
    //delete product
    public function deleteProduct(Order $order,  request $request)
    {
        $this->authorize('isAdmin', User::class);
        $orderProduct = Order_product::find($request->id);
        $this->removeTotalPrice($order, $orderProduct);
        $orderProduct->delete();
        return redirect()->route("orders.editProduct", $order)->with('success', 'Product deleted successfully');
    }
    //a function to remove to total of the product of the total of all
    private function removeTotalPrice($order, $orderProduct)
    {
        $this->authorize('isAdmin', User::class);
        $totalPrice = $order->total_incl;
        $totalPrice -= $orderProduct->price_incl * $orderProduct->amount;
        $order->total_incl = $totalPrice;
        $order->save();
        return redirect()->route("orders.index")->with('success', 'Total price calculated and saved successfully');
    }
    public function editAddress(Order $order)
    //get method
    {
        $this->authorize('isAdmin', User::class);
        $address = Address::where('order_id', $order->id)->get();
        return view('order.address', compact('order', 'address'));
    }
    //updateaddress_0
    public function updateAddress_0(updateAddresShippingrequest $request, Order $order)
    //post method
    {
        $this->authorize('isAdmin', User::class);
        Address::where([['order_id', $order->id], ['type', 'shipping']])->update(
            [
                'firstName' => $request->first_name_0,
                "lastName" => $request->last_name_0,
                "address" => $request->street_0,
                "zipCode" => $request->postal_code_0,
                "city" => $request->city_0,
            ]
        );


        return redirect()->route("orders.editAdress", $order)->with('success', 'Address updated successfully');
    }
    //updateaddress_1
    public function updateAddress_1(updateAddresShippingrequest $request, Order $order)
    //post method
    {
        $this->authorize('isAdmin', User::class);
        Address::where([['order_id', $order->id], ['type', 'billing']])->update(
            [
                'firstName' => $request->first_name_1,
                "lastName" => $request->last_name_1,
                "address" => $request->street_1,
                "zipCode" => $request->postal_code_1,
                "city" => $request->city_1,
            ]
        );

        return redirect()->route("orders.editAdress", $order)->with('success', 'Address updated successfully');
    }
}
