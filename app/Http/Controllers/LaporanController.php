<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use PDF;

class LaporanController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->where('status','diterima')->get();
        return view('admin.laporan.index', compact('orders'));
    }

    public function daftar_filter_laporan(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $sampai_carbon = Carbon::parse($sampai)->endOfDay();
        $orders = Order::whereBetween('created_at', [$dari, $sampai_carbon])->where('status', 'diterima')->orderBy('created_at', 'desc')->get();
        return view('admin.laporan.index', compact('orders', 'dari', 'sampai'));
    }

    public function export_all_pdf()
    {
        $orders = Order::where('status', 'diterima')->orderBy('created_at', 'desc')->get();
        $total = Order::where('status', 'diterima')->orderBy('created_at', 'desc')->sum('total');

        $pdfOptions = [
            'isRemoteEnabled' => true,
        ];

        $pdf = PDF::loadView('admin.laporan.pdfview', [
            'orders' =>  $orders,
            'total' => $total,
        ], $pdfOptions)
            ->setPaper('a4', 'portrait');

        return $pdf->download('all-laporan-order.pdf');
    }

    public function export_filter_pdf(Request $request)
    {
        $dari = $request->dari;
        $sampai = $request->sampai;
        $sampai_carbon = Carbon::parse($sampai)->endOfDay();
        $orders = Order::whereBetween('created_at', [$dari, $sampai_carbon])->where('status', 'diterima')->orderBy('created_at', 'desc')->get();
        $total = Order::whereBetween('created_at', [$dari, $sampai_carbon])->where('status', 'diterima')->orderBy('created_at', 'desc')->sum('total');

        $pdfOptions = [
            'isRemoteEnabled' => true,
        ];

        $pdf = PDF::loadView('admin.laporan.pdfview', [
            'orders' =>  $orders,
            'total' => $total,
        ], $pdfOptions)
            ->setPaper('a4', 'portrait');

        return $pdf->download('laporan-order-' . $dari . '-sampai-' . $sampai . '.pdf');
    }
}
