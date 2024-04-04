<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('created_at','desc')->get();
        return view('admin.product.add',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => ['required', 'string'],
            'nama_produk' => ['required', 'string','max:255'],
            'deskripsi' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'status' => ['required'],
            'stok' => ['required', 'numeric'],
            'rated' => ['required', 'string', 'max:255'],
            'img' => ['required', 'file', 'mimes:jpg,jpeg,png'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('product.create')->withErrors($validator)->withInput();
        }
        try {
            if ($request->hasFile('img')) {
                $file = md5(time()) . '_Foto_Produk_' . $request->file('img')->getClientOriginalName();
                $path = $request->file('img')->storeAs('public/products', $file);
                Product::create([
                    "category_id" => $request->category_id,
                    "nama_produk" => $request->nama_produk,
                    "deskripsi" => $request->deskripsi,
                    "price" => $request->price,
                    "status" => $request->status,
                    "stok" => $request->stok,
                    "rated" => $request->rated,
                    "img" => $file,
                ]);
            } else {
                Product::create([
                    "category_id" => $request->category_id,
                    "nama_produk" => $request->nama_produk,
                    "deskripsi" => $request->deskripsi,
                    "price" => $request->price,
                    "status" => $request->status,
                    "stok" => $request->stok,
                    "rated" => $request->rated,
                    "img" => '',
                ]);
            }

            return redirect()->route('product.index')->with('success', 'Berhasil tambah product!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.detail', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('admin.product.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        if ($request->hasFile('img')) {
            $validator = Validator::make($request->all(), [
                'category_id' => ['required', 'string'],
                'nama_produk' => ['required', 'string', 'max:255'],
                'deskripsi' => ['required', 'string'],
                'price' => ['required', 'numeric'],
                'status' => ['required'],
                'stok' => ['required', 'numeric'],
                'rated' => ['required', 'string', 'max:255'],
                'img' => ['required', 'file', 'mimes:jpg,jpeg,png'],
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'category_id' => ['required', 'string'],
                'nama_produk' => ['required', 'string', 'max:255'],
                'deskripsi' => ['required', 'string'],
                'price' => ['required', 'numeric'],
                'status' => ['required'],
                'stok' => ['required', 'numeric'],
                'rated' => ['required', 'string', 'max:255'],
            ]);
        }

        if ($validator->fails()) {
            return redirect()->route('product.edit', ['product' => $product->id])->withErrors($validator)->withInput();
        }
        try {
            if ($request->hasFile('img')) {
                unlink(storage_path('app/public/products/' . $product->img));
                $file = md5(time()) . '_Foto_Produk_' . $request->file('img')->getClientOriginalName();
                $path = $request->file('img')->storeAs('public/products', $file);
                $product->update([
                    "category_id" => $request->category_id,
                    "nama_produk" => $request->nama_produk,
                    "deskripsi" => $request->deskripsi,
                    "price" => $request->price,
                    "status" => $request->status,
                    "stok" => $request->stok,
                    "rated" => $request->rated,
                    "img" => $file,
                ]);
            } else {
                $product->update([
                    "category_id" => $request->category_id,
                    "nama_produk" => $request->nama_produk,
                    "deskripsi" => $request->deskripsi,
                    "price" => $request->price,
                    "status" => $request->status,
                    "stok" => $request->stok,
                    "rated" => $request->rated,
                ]);
            }

            return redirect()->route('product.index')->with('success', 'Berhasil edit produk!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        unlink(storage_path('app/public/products/' . $product->img));
        $product->delete();
        return redirect()->back()->with('success', 'Produk berhasil dihapus!');
    }
}
