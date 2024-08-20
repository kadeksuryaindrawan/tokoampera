<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::orderBy('created_at', 'desc')->get();
        return view('admin.voucher.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.voucher.add');
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
            'nama' => ['required', 'string', 'max:255'],
            'nominal' => ['required', 'numeric'],
            'status' => ['required'],
            'deskripsi' => ['required', 'string'],
            'gambar_voucher' => ['required', 'file', 'mimes:jpg,jpeg,png'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('vouchers.create')->withErrors($validator)->withInput();
        }
        try {
            if ($request->hasFile('gambar_voucher')) {
                $file = md5(time()) . '_Voucher_' . $request->file('gambar_voucher')->getClientOriginalName();
                $path = $request->file('gambar_voucher')->storeAs('public/vouchers', $file);
                Voucher::create([
                    "nama" => $request->nama,
                    "nominal" => $request->nominal,
                    "status" => $request->status,
                    "deskripsi" => $request->deskripsi,
                    "gambar_voucher" => $file,
                ]);
            } else {
                Voucher::create([
                    "nama" => $request->nama,
                    "nominal" => $request->nominal,
                    "status" => $request->status,
                    "deskripsi" => $request->deskripsi,
                    "gambar_voucher" => '',
                ]);
            }

            return redirect()->route('vouchers.index')->with('success', 'Berhasil tambah voucher!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function show(Voucher $voucher)
    {
        return view('admin.voucher.detail', compact('voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function edit(Voucher $voucher)
    {
        return view('admin.voucher.edit', compact('voucher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Voucher $voucher)
    {
        if ($request->hasFile('gambar_voucher')) {
            $validator = Validator::make($request->all(), [
                'nama' => ['required', 'string', 'max:255'],
                'nominal' => ['required', 'numeric'],
                'status' => ['required'],
                'deskripsi' => ['required', 'string'],
                'gambar_voucher' => ['required', 'file', 'mimes:jpg,jpeg,png'],
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'nama' => ['required', 'string', 'max:255'],
                'nominal' => ['required', 'numeric'],
                'status' => ['required'],
                'deskripsi' => ['required', 'string'],
            ]);
        }

        if ($validator->fails()) {
            return redirect()->route('vouchers.edit', ['voucher' => $voucher->id])->withErrors($validator)->withInput();
        }
        try {
            if ($request->hasFile('gambar_voucher')) {
                unlink(storage_path('app/public/vouchers/' . $voucher->gambar_voucher));
                $file = md5(time()) . '_Voucher_' . $request->file('gambar_voucher')->getClientOriginalName();
                $path = $request->file('gambar_voucher')->storeAs('public/vouchers', $file);
                $voucher->update([
                    "nama" => $request->nama,
                    "nominal" => $request->nominal,
                    "status" => $request->status,
                    "deskripsi" => $request->deskripsi,
                    "gambar_voucher" => $file,
                ]);
            } else {
                $voucher->update([
                    "nama" => $request->nama,
                    "nominal" => $request->nominal,
                    "status" => $request->status,
                    "deskripsi" => $request->deskripsi,
                ]);
            }

            return redirect()->route('vouchers.index')->with('success', 'Berhasil edit voucher!');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Voucher  $voucher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Voucher $voucher)
    {
        unlink(storage_path('app/public/vouchers/' . $voucher->gambar_voucher));
        $voucher->delete();
        return redirect()->back()->with('success', 'Voucher berhasil dihapus!');
    }
}
