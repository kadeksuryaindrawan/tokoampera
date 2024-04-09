<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Customer;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CustomerAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
        $categories = Category::orderBy('created_at', 'desc')->get();
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        $customer_addresses = CustomerAddress::orderBy('created_at', 'desc')->where('customer_id',$customer->id)->get();
        return view('customer.address.index', compact('customer_addresses','count_cart','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $count_cart = $this->count_cart();
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('customer.address.add',compact('count_cart','categories'));
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
            'nama_alamat' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'lat' => ['required'],
            'long' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('customer_address.create')->withErrors($validator)->withInput();
        }
        try {
            $customer = Customer::where('user_id', Auth::user()->id)->first();
            CustomerAddress::create([
                "customer_id" => $customer->id,
                "nama_alamat" => $request->nama_alamat,
                "alamat" => $request->alamat,
                "lat" => $request->lat,
                "long" => $request->long,
            ]);
            return redirect()->route('customer-address.index')->with('success', 'Berhasil tambah alamat!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerAddress  $customerAddress
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerAddress $customerAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerAddress  $customerAddress
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerAddress $customerAddress)
    {
        $count_cart = $this->count_cart();
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('customer.address.edit', compact('count_cart', 'categories','customerAddress'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerAddress  $customerAddress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerAddress $customerAddress)
    {
        $validator = Validator::make($request->all(), [
            'nama_alamat' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string'],
            'lat' => ['required'],
            'long' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('customer-address.edit', ['customerAddress' => $customerAddress->id])->withErrors($validator)->withInput();
        }
        try {
            $customerAddress->update([
                "nama_alamat" => $request->nama_alamat,
                "alamat" => $request->alamat,
                "lat" => $request->lat,
                "long" => $request->long,
            ]);
            return redirect()->route('customer-address.index')->with('success', 'Berhasil edit alamat!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerAddress  $customerAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerAddress $customerAddress)
    {
        $customerAddress->delete();
        return redirect()->back()->with('success', 'Alamat berhasil dihapus!');
    }
}
