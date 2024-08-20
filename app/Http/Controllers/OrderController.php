<?php

namespace App\Http\Controllers;

use App\Exports\ExportPenjualanTahun;
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
use Maatwebsite\Excel\Facades\Excel;

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
        if(Auth::user()->role == 'customer'){
            $validator = Validator::make($request->all(), [
                'customer_address_id' => ['required'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
        }

        try {

            if(Auth::user()->role == 'customer'){
                $customer_address = CustomerAddress::where('id', $request->customer_address_id)->first();
                $alamat = $customer_address->alamat;
                $lat = $customer_address->lat;
                $long = $customer_address->long;
            }

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
                    if (Auth::user()->role == 'customer') {
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
                    }else{
                        $order = Order::create([
                            "customer_id" => $customer_id,
                            "invoice" => $invoice,
                            "total_sebelum_discount" => $total_sebelum_discount,
                            "total" => $total,
                            "status" => 'diterima',
                            "voucher" => $voucher,
                            "discount" => $discount,
                        ]);
                    }


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
                    if (Auth::user()->role == 'customer') {
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
                    }else{
                        $order = Order::create([
                            "customer_id" => $customer_id,
                            "invoice" => $invoice,
                            "total_sebelum_discount" => $total_sebelum_discount,
                            "total" => $total,
                            "status" => 'diterima',
                        ]);
                    }


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
                if (Auth::user()->role == 'customer') {
                    return redirect()->route('order-lists')->with('success', 'Sukses checkout! Silahkan menunggu konfirmasi admin!');
                }else{
                    return redirect()->route('invoice-detail',$order->id)->with('success', 'Sukses Order!');
                }

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

    public function add_shipping(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', 'string'],
            'shipping_courier' => ['required', 'string', 'max:255'],
            'shipping_price' => ['required', 'numeric'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('order')->withErrors($validator)->withInput();
        }
        try {
            $order_id = $request->order_id;
            $shipping_courier = $request->shipping_courier;
            $shipping_price = $request->shipping_price;

            Order::where('id', $order_id)->update([
                'shipping_courier' => $shipping_courier,
                'shipping_price' => $shipping_price,
                'status' => 'menunggu pembayaran',
            ]);

            return redirect()->route('order')->with('success', 'Berhasil input shipping!');
        } catch (\Throwable $th) {
            throw $th;
        }


    }

    public function pay_detail($id)
    {
        $order = Order::find($id);
        if($order->status == 'konfirmasi pembayaran'){
            return view('admin.order.pay-detail', compact('order'));
        }
        else{
            return redirect()->back();
        }

    }

    public function pay_accept($id)
    {
        try {
            Order::where('id', $id)->update([
                'status' => 'terbayar',
            ]);

            return redirect()->route('order')->with('success', 'Berhasil terima pembayaran!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function pay_reject(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'catatan' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('pay-detail', $id)->withErrors($validator)->withInput();
        }
        try {
            $catatan = $request->catatan;
            $order_products = OrderProduct::where('order_id', $id)->get();

            Order::where('id', $id)->update([
                'catatan' => $catatan,
                'status' => 'ditolak',
            ]);

            foreach ($order_products as $op) {
                $product_id = $op->product_id;
                $product = Product::find($product_id);
                $product->stok += $op->qty;
                $product->save();
            }

            return redirect()->route('order')->with('success', 'Berhasil tolak pembayaran!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function add_resi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id' => ['required', 'string'],
            'resi' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('order')->withErrors($validator)->withInput();
        }
        try {
            $order_id = $request->order_id;
            $resi = $request->resi;

            Order::where('id', $order_id)->update([
                'resi' => $resi,
                'status' => 'terkirim',
            ]);

            return redirect()->route('order')->with('success', 'Berhasil input resi!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function pay($id)
    {
        $count_cart = $this->count_cart();
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        $categories = Category::orderBy('created_at', 'desc')->get();
        $carts = Cart::orderBy('created_at', 'desc')->where('customer_id', $customer->id)->get();
        $order = Order::where('id', $id)->first();
        $total_cart = Cart::where('customer_id', $customer->id)->sum('total');
        if ($order->status == 'menunggu pembayaran') {
            return view('customer.order.pay', compact('categories', 'carts', 'count_cart', 'total_cart', 'customer', 'order'));
        } else {
            return redirect()->back();
        }

    }

    public function pay_process(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'nama_bank' => ['required','string', 'max:255'],
            'no_bank' => ['required', 'numeric'],
            'pemilik_bank' => ['required', 'string', 'max:255'],
            'bukti_bayar' => ['required', 'file', 'mimes:jpg,jpeg,png'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('pay-process', ['order' => $id])->withErrors($validator)->withInput();
        }
        try {
            $order = Order::find($id);
            $customer_id = $order->customer_id;
            $file = md5(time()).$customer_id.'_Bukti_Bayar_' . $request->file('bukti_bayar')->getClientOriginalName();
            $path = $request->file('bukti_bayar')->storeAs('public/bukti_bayar', $file);
            Order::where('id',$id)->update([
                "nama_bank" => $request->nama_bank,
                "no_bank" => $request->no_bank,
                "pemilik_bank" => $request->pemilik_bank,
                "bukti_bayar" => $file,
                "status" => 'konfirmasi pembayaran',
                "tanggal_bayar" => now()
            ]);
            return redirect()->route('order-lists')->with('success', 'Pembayaran berhasil! Silahkan menunggu konfirmasi admin!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function order_acc($id)
    {
        $count_cart = $this->count_cart();
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        $categories = Category::orderBy('created_at', 'desc')->get();
        $carts = Cart::orderBy('created_at', 'desc')->where('customer_id', $customer->id)->get();
        $order = Order::where('id', $id)->first();
        $order_products = OrderProduct::orderBy('created_at', 'desc')->where('order_id',$order->id)->get();
        $total_cart = Cart::where('customer_id', $customer->id)->sum('total');
        if ($order->status == 'terkirim') {
            return view('customer.order.acc', compact('categories', 'carts', 'count_cart', 'total_cart', 'customer', 'order','order_products'));
        } else {
            return redirect()->back();
        }
    }

    public function acc_process(Request $request)
    {
        $order_id = $request->order_id;
        $product_ids = $request->product_id;
        $ratings = $request->rating;
        $reviews = $request->review;

        if ($request->hasFile('media')) {
            $validator = Validator::make($request->all(), [
                'rating.*' => ['required'],
                'media.*' => ['file', 'mimes:jpg,jpeg,png'],
            ]);
        }
        else{
            $validator = Validator::make($request->all(), [
                'rating.*' => ['required'],
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {

            foreach ($product_ids as $index => $product_id) {
                $file = null;

                if ($request->hasFile('media') && isset($request->file('media')[$index]) && $request->file('media')[$index]->isValid()) {
                    $file = md5(time()) . '_Media_' . $request->file('media')[$index]->getClientOriginalName();
                    $path = $request->file('media')[$index]->storeAs('public/media_review', $file);
                }

                $updateData = [
                    "rating" => $ratings[$index],
                    "review" => $reviews[$index],
                ];

                if ($file) {
                    $updateData["media"] = $file;
                }

                OrderProduct::where('order_id', $order_id)
                ->where('product_id', $product_id)
                ->update($updateData);

                Order::where('id',$order_id)->update([
                    "status" => 'diterima'
                ]);

                $order_product_avg = OrderProduct::where('product_id',$product_id)->avg('rating');

                Product::where('id',$product_id)->update([
                    'rated' => $order_product_avg
                ]);
            }

            return redirect()->route('order-lists')->with('success', 'Berhasil menerima pesanan!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function order_detail($id)
    {
        $order = Order::find($id);
        $order_products = OrderProduct::orderBy('created_at', 'desc')->where('order_id', $order->id)->get();
        if (Auth::user()->role == 'admin') {
            return view('admin.order.detail', compact('order','order_products'));
        } else {
            $count_cart = $this->count_cart();
            $customer = Customer::where('user_id', Auth::user()->id)->first();
            $categories = Category::orderBy('created_at', 'desc')->get();
            $carts = Cart::orderBy('created_at', 'desc')->where('customer_id', $customer->id)->get();
            $total_cart = Cart::where('customer_id', $customer->id)->sum('total');
            return view('customer.order.detail', compact('categories', 'carts', 'count_cart', 'total_cart', 'customer', 'order', 'order_products'));
        }
    }

    public function order_delete($id){
        $order = Order::find($id);
        if($order->bukti_bayar != NULL){
            unlink(storage_path('app/public/bukti_bayar/' . $order->bukti_bayar));
        }
        $order->delete();

        $order_products = OrderProduct::where('order_id',$id)->get();

        foreach($order_products as $op){
            if($op->media != NULL){
                unlink(storage_path('app/public/media_review/' . $op->media));
            }
        }

        OrderProduct::where('order_id',$id)->delete();

        return redirect()->back()->with('success', 'Order berhasil dihapus!');
    }

    public function order_success()
    {
        $orders = Order::orderBy('created_at', 'desc')->where('status', 'diterima')->get();
        return view('admin.order-success.index', compact('orders'));
    }

    public function exportExcelTahun($year)
    {
        return Excel::download(new ExportPenjualanTahun($year), 'data-penjualan-' . $year . '.xlsx');
    }


}
