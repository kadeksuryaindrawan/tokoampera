<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class POSController extends Controller
{
    public function index()
    {
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        $carts = Cart::orderBy('created_at', 'desc')->where('customer_id', $customer->id)->get();
        $total_cart = Cart::where('customer_id', $customer->id)->sum('total');
        $products = Product::orderBy('created_at', 'desc')->where('status', 'active')->where('stok', '>', 0)->get();
        return view('admin.pos.index', compact('products','customer','carts','total_cart'));
    }

    public function pos_history()
    {
        $orders = Order::orderBy('created_at', 'desc')->where('alamat',NULL)->where('status', 'diterima')->get();
        return view('admin.pos.history', compact('orders'));
    }

    public function invoice_detail($id)
    {
        $order = Order::find($id);
        $order_products = OrderProduct::orderBy('created_at','desc')->where('order_id',$id)->get();
        return view('admin.pos.invoice', compact('order','order_products'));
    }

    public function exportPdfInvoice($id)
    {
        $order = Order::find($id);
        $order_products = OrderProduct::orderBy('created_at', 'desc')->where('order_id', $id)->get();

        $pdfOptions = [
            'isRemoteEnabled' => true,
        ];

        $pdf = PDF::loadView('admin.pos.pdf-invoice', [
            'order' =>  $order,
            'order_products' => $order_products
        ], $pdfOptions)
        ->setPaper('a4', 'portrait');

        return $pdf->download('invoice_'.$order->invoice.'.pdf');
    }
}
