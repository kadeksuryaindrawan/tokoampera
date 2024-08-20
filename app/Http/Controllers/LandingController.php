<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Customer;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
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

    public function index()
    {
        $count_cart = $this->count_cart();
        $categories = Category::orderBy('created_at','desc')->get();
        // $blogs = Blog::orderBy('created_at','desc')->where('status','tampil')->paginate(3);
        $new_products = Product::orderBy('created_at', 'desc')->where('status', 'active')->where('stok','>',0)->paginate(8);
        $old_products = Product::orderBy('created_at', 'asc')->where('status', 'active')->where('stok', '>', 0)->paginate(8);
        return view('index',compact('categories','new_products','old_products','count_cart'));
    }

    public function shop()
    {
        $count_cart = $this->count_cart();
        $categories = Category::orderBy('created_at', 'desc')->get();
        $products = Product::orderBy('created_at', 'desc')->where('status', 'active')->where('stok', '>', 0)->get();
        $count_products = Product::orderBy('created_at', 'desc')->where('status', 'active')->count();
        return view('shop', compact('products','categories','count_products', 'count_cart'));
    }

    public function category_shop($category_id)
    {
        $count_cart = $this->count_cart();
        $categories = Category::orderBy('created_at', 'desc')->get();
        $category = Category::find($category_id);
        $products = Product::orderBy('created_at', 'desc')->where('status', 'active')->where('category_id', $category_id)->where('stok', '>', 0)->get();
        $count_products = Product::orderBy('created_at', 'desc')->where('category_id', $category_id)->where('status', 'active')->count();
        return view('category-shop', compact('products', 'categories', 'count_products','category', 'count_cart'));
    }

    public function product_detail($id){
        $count_cart = $this->count_cart();
        $product = Product::find($id);
        $products = Product::orderBy('created_at', 'desc')->where('status', 'active')->where('id', '!=', $id)->where('stok', '>', 0)->paginate(4);
        $rater = OrderProduct::where('product_id',$product->id)->where('rating','!=',NULL)->count();
        $order_products = OrderProduct::orderBy('created_at','desc')->where('product_id', $product->id)->where('rating', '!=', NULL)->get();
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('product-detail', compact('product', 'categories','products', 'count_cart','rater','order_products'));
    }

    // public function blogs()
    // {
    //     $count_cart = $this->count_cart();
    //     $categories = Category::orderBy('created_at', 'desc')->get();
    //     $blogs = Blog::orderBy('created_at', 'desc')->where('status', 'tampil')->get();
    //     return view('blogs', compact('blogs','categories', 'count_cart'));
    // }

    // public function blog_detail($id)
    // {
    //     $count_cart = $this->count_cart();
    //     $categories = Category::orderBy('created_at', 'desc')->get();
    //     $blog = Blog::find($id);
    //     return view('blog-detail', compact('blog','categories', 'count_cart'));
    // }

    public function contact()
    {
        $count_cart = $this->count_cart();
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('contact', compact('categories','count_cart'));
    }

    public function cart()
    {
        $count_cart = $this->count_cart();
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        $categories = Category::orderBy('created_at', 'desc')->get();
        $carts = Cart::orderBy('created_at', 'desc')->where('customer_id', $customer->id)->get();
        $total_cart = Cart::where('customer_id', $customer->id)->sum('total');
        return view('customer.cart', compact('categories', 'carts', 'count_cart','total_cart'));
    }
}
