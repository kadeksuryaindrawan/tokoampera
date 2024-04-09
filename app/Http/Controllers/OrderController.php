<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function voucher(Request $request)
    {
        $voucher_input = $request->voucher;

        // $voucher = Voucher::where('nama',$voucher_input)->first();

        $voucher = Voucher::whereRaw('BINARY nama = ?', [$voucher_input])->where('status','tersedia')->first();

        if ($voucher == NULL) {
            return redirect()->back()->with('error', 'Voucher tidak tersedia!');
        } else {
            $nominal = $voucher->nominal;
            session()->put('nominal', $nominal);
            return redirect()->back()->with('success', 'Sukses! Anda mendapatkan discount sebesar Rp.'. number_format($nominal, 0, ",", "."));
        }
    }

    public function voucher_destroy()
    {
        session()->forget('nominal');
        return redirect()->back()->with('success', 'Voucher berhasil dihapus!');
    }

    public function index()
    {
        $count_cart = $this->count_cart();
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        $categories = Category::orderBy('created_at', 'desc')->get();
        $carts = Cart::orderBy('created_at', 'desc')->where('customer_id', $customer->id)->get();
        $total_cart = Cart::where('customer_id', $customer->id)->sum('total');
        return view('customer.checkout', compact('categories', 'carts', 'count_cart', 'total_cart'));
    }


}
