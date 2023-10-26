<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{

    public function generatePDF(Order $order)
    {
        $this->authorize('Order', [Order::class, $order]);
        $orderProduct = Order_product::where('order_id', $order->id)->get();
        $addres = Address::where('order_id', $order->id)->get();
        //get only the product from a order_product
        $product = [];
        foreach ($orderProduct as $item) {
            $product[] = Product::find($item->product_id);
        }
        $data = [
            'order' => $order,
            'product' => $product,
            'orderProduct' => $orderProduct,
            'addres' => $addres,
        ];
        set_time_limit(120);
        $pdf = PDF::loadView('pdf.sample', $data, ['paper' => 'a4', 'orientation' => 'landscape']);

        return $pdf->download('sample.pdf');
        // return redirect()->route('order.home');
    }
}
