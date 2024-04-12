<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $orders = Order::orderBy('created_at', 'desc')->where('status', '!=', 'diterima')->get();
            $category_count = Category::count();
            $product_count = Product::count();
            $voucher_count = Voucher::count();
            $blog_count = Blog::count();
            $year = date('Y');
            $januari = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', '01')->where('status', 'diterima')->count();
            $februari = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', '02')->where('status', 'diterima')->count();
            $maret = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', '03')->where('status', 'diterima')->count();
            $april = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', '04')->where('status', 'diterima')->count();
            $mei = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', '05')->where('status', 'diterima')->count();
            $juni = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', '06')->where('status', 'diterima')->count();
            $juli = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', '07')->where('status', 'diterima')->count();
            $agustus = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', '08')->where('status', 'diterima')->count();
            $september = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', '09')->where('status', 'diterima')->count();
            $oktober = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', '10')->where('status', 'diterima')->count();
            $november = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', '11')->where('status', 'diterima')->count();
            $desember = Order::whereYear('created_at', date('Y'))->whereMonth('created_at', '12')->where('status', 'diterima')->count();
            return view('admin.dashboard.index',compact('orders','category_count','product_count','voucher_count','blog_count', 'januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember', 'year'));
        }
        if (Auth::user()->role == 'customer') {
            if (Auth::check() == true) {
                $customer = Customer::where('user_id', Auth::user()->id)->first();
                $count_cart = Cart::where('customer_id', $customer->id)->count();
            } else {
                $count_cart = 0;
            }
            $categories = Category::orderBy('created_at', 'desc')->get();
            $blogs = Blog::orderBy('created_at', 'desc')->where('status', 'tampil')->paginate(3);
            $new_products = Product::orderBy('created_at', 'desc')->where('status', 'active')->where('stok', '>', 0)->paginate(8);
            $old_products = Product::orderBy('created_at', 'asc')->where('status', 'active')->where('stok', '>', 0)->paginate(8);
            return view('index', compact('categories', 'blogs', 'new_products', 'old_products','count_cart'));
        }
    }
}
