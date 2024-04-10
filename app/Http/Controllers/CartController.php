<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function add(Request $request){

        $validator = Validator::make($request->all(), [
            'qty' => ['required', 'numeric']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $customer = Customer::where('user_id', Auth::user()->id)->first();
            $product = Product::where('id',$request->product_id)->first();

            $price = $product->price;

            $total = $request->qty * $price;

            $cart = Cart::where('customer_id', $customer->id)->where('product_id', $request->product_id)->first();

            if($cart == NULL){
                if ($request->qty > $product->stok) {
                    return redirect()->back()->with('error', 'Jumlah tidak boleh melebihi dari stok yang tersedia!');
                } else {
                    Cart::create([
                        "customer_id" => $customer->id,
                        "product_id" => $request->product_id,
                        "qty" => $request->qty,
                        "total" => $total,
                    ]);

                    return redirect()->back()->with('success', 'Berhasil menambah product ke cart!');
                }
            }else{
                $old_qty = $cart->qty;
                $new_qty = $old_qty + $request->qty;

                if ($new_qty > $product->stok) {
                    return redirect()->back()->with('error', 'Jumlah tidak boleh melebihi dari stok yang tersedia!');
                } else {
                    $cart->update([
                        "qty" => $new_qty
                    ]);

                    return redirect()->back()->with('success', 'Berhasil menambah product ke cart!');
                }

            }


        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete($id)
    {
        Cart::find($id)->delete();
        return redirect()->back()->with('success', 'Product berhasil dihapus dari cart!');
    }

    public function clear(){
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        Cart::where('customer_id',$customer->id)->delete();
        return redirect()->back()->with('success', 'Cart berhasil dihapus!');
    }

    public function update(Request $request,$id)
    {
        $cart = Cart::find($id);
        $product = Product::where('id', $cart->product_id)->first();

        $price = $product->price;

        $total = $request->qty * $price;
        if ($request->qty > $product->stok) {
            return redirect()->back()->with('error', 'Stok pada produk '.$product->nama_produk.' hanya '.$product->stok.'. Qty tidak boleh melebihi stok!');
        } else {
            Cart::find($id)->update([
                'qty' => $request->qty,
                'total' => $total
            ]);
            return redirect()->back();
        }

    }
}
