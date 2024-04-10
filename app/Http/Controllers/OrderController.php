<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function count_cart()
    {
        if (Auth::check() == true) {
            $customer = Customer::where('user_id', Auth::user()->id)->first();
            $count_cart = Cart::where('customer_id', $customer->id)->count();
        } else {
            $count_cart = 0;
        }
        return $count_cart;
    }

    public function generateInvoice()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 5; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        $invoice = 'CMPK/' . str_pad(date('m'), 2, '0', STR_PAD_LEFT) . '/' . date('Y') . '/' . $randomString;
        return $invoice;
    }

    public function voucher(Request $request)
    {
        $voucher_input = $request->voucher;

        // $voucher = Voucher::where('nama',$voucher_input)->first();

        $voucher = Voucher::whereRaw('BINARY nama = ?', [$voucher_input])->where('status','tersedia')->first();

        if ($voucher == NULL) {
            return redirect()->back()->with('error', 'Voucher tidak tersedia!');
        } else {
            $nominal = $voucher->nominal;
            $nama_voucher = $voucher->nama;
            session()->put('nominal', $nominal);
            session()->put('nama_voucher', $nama_voucher);
            return redirect()->back()->with('success', 'Sukses! Anda mendapatkan discount sebesar Rp.'. number_format($nominal, 0, ",", "."));
        }
    }

    public function voucher_destroy()
    {
        session()->forget('nominal');
        session()->forget('nama_voucher');
        return redirect()->back()->with('success', 'Voucher berhasil dihapus!');
    }

    public function index()
    {
        $count_cart = $this->count_cart();
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        $customer_addresses = CustomerAddress::orderBy('created_at', 'desc')->where('customer_id', $customer->id)->get();
        $categories = Category::orderBy('created_at', 'desc')->get();
        $carts = Cart::orderBy('created_at', 'desc')->where('customer_id', $customer->id)->get();
        $total_cart = Cart::where('customer_id', $customer->id)->sum('total');
        if($total_cart > 0){
            return view('customer.checkout', compact('categories', 'carts', 'count_cart', 'total_cart', 'customer', 'customer_addresses'));
        }else{
            return redirect()->back();
        }

    }

    public function checkout_process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_address_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {

            $customer_address = CustomerAddress::where('id',$request->customer_address_id)->first();
            $alamat = $customer_address->alamat;
            $lat = $customer_address->lat;
            $long = $customer_address->long;
            $customer_id = $request->customer_id;
            $invoice = $this->generateInvoice();
            $total_sebelum_discount = $request->total_sebelum_discount;
            $carts = Cart::orderBy('created_at', 'desc')->where('customer_id', $customer_id)->get();
            if(session('nama_voucher')){
                $total = $request->total;
                $voucher = $request->voucher;
                $discount = $request->discount;
            }
            else{
                $total = $request->total_sebelum_discount;
            }

            $true = FALSE;
            if(session('nama_voucher')){

                foreach($carts as $cart){
                    if ($cart->qty > $cart->product->stok) {
                        $true = FALSE;
                    } else {
                        $stok_update = $cart->product->stok - $cart->qty;

                        Product::where('id', $cart->product_id)->update([
                            'stok' => $stok_update
                        ]);

                        $true = TRUE;
                    }
                }

                if($true == TRUE){
                    $order = Order::create([
                        "customer_id" => $customer_id,
                        "invoice" => $invoice,
                        "total_sebelum_discount" => $total_sebelum_discount,
                        "total" => $total,
                        "status" => 'pending',
                        "alamat" => $alamat,
                        "lat" => $lat,
                        "long" => $long,
                        "voucher" => $voucher,
                        "discount" => $discount,
                    ]);

                    foreach ($carts as $cart) {
                        OrderProduct::create([
                            "order_id" => $order->id,
                            "product_id" => $cart->product_id,
                            "qty" => $cart->qty,
                            "total" => $cart->total,
                        ]);
                    }

                    session()->forget('nominal');
                    session()->forget('nama_voucher');
                }
            }
            else{

                foreach ($carts as $cart) {
                    if ($cart->qty > $cart->product->stok) {
                        $true = FALSE;
                    } else {
                        $stok_update = $cart->product->stok - $cart->qty;

                        Product::where('id', $cart->product_id)->update([
                            'stok' => $stok_update
                        ]);

                        $true = TRUE;
                    }
                }

                if($true == TRUE){
                    $order = Order::create([
                        "customer_id" => $customer_id,
                        "invoice" => $invoice,
                        "total_sebelum_discount" => $total_sebelum_discount,
                        "total" => $total,
                        "status" => 'pending',
                        "alamat" => $alamat,
                        "lat" => $lat,
                        "long" => $long,
                    ]);

                    foreach ($carts as $cart) {
                        OrderProduct::create([
                            "order_id" => $order->id,
                            "product_id" => $cart->product_id,
                            "qty" => $cart->qty,
                            "total" => $cart->total,
                        ]);
                    }
                }

            }

            if($true == TRUE){
                Cart::where('customer_id', $customer_id)->delete();
                return redirect()->route('order-lists')->with('success', 'Sukses checkout! Silahkan menunggu konfirmasi admin!');
            }else{
                return redirect()->back()->with('error', 'Stok product tidak cukup atau stok tidak ada!');
            }

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function list_order(){
        $count_cart = $this->count_cart();
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        $categories = Category::orderBy('created_at', 'desc')->get();
        $carts = Cart::orderBy('created_at', 'desc')->where('customer_id', $customer->id)->get();
        $orders = Order::orderBy('created_at', 'desc')->where('customer_id', $customer->id)->where('status','!=', 'diterima')->get();
        $total_cart = Cart::where('customer_id', $customer->id)->sum('total');
        return view('customer.order.index', compact('categories', 'carts', 'count_cart', 'total_cart', 'customer', 'orders'));
    }

    public function history_order()
    {
        $count_cart = $this->count_cart();
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        $categories = Category::orderBy('created_at', 'desc')->get();
        $carts = Cart::orderBy('created_at', 'desc')->where('customer_id', $customer->id)->get();
        $orders = Order::orderBy('created_at', 'desc')->where('customer_id', $customer->id)->where('status','diterima')->get();
        $total_cart = Cart::where('customer_id', $customer->id)->sum('total');
        return view('customer.order.history', compact('categories', 'carts', 'count_cart', 'total_cart', 'customer', 'orders'));
    }

    public function order()
    {
        $orders = Order::orderBy('created_at', 'desc')->where('status', '!=', 'diterima')->get();
        return view('admin.order.index', compact('orders'));
    }


}
