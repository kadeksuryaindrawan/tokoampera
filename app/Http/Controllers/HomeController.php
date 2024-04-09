<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
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
            return view('admin.dashboard.index');
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
