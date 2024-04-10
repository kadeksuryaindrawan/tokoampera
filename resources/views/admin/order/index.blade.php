@extends('layouts.admin')

@section('content')

        <section class="content-main">
            <div class="row">
                <div class="col-lg-12">
                            @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{session('success')}}
                            </div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{session('error')}}
                            </div>
                            @endif
                        </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4>Order</h4>
                                    </div>
                                    <div style="overflow-x: scroll;">
                                        <table id="zero-conf" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Invoice</th>
                                                    <th>Nama Customer</th>
                                                    <th>Total</th>
                                                    <th>Ongkir</th>
                                                    <th>Status</th>
                                                    <th>Tanggal Checkout</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no=1;
                                                @endphp
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $order->invoice }}</td>
                                                        <td>{{ ucwords($order->customer->nama_lengkap) }}</td>
                                                        <td>Rp. {{ number_format($order->total,0,",",".") }}</td>
                                                        @if ($order->shipping_price == NULL)
                                                            <td>-</td>
                                                        @else
                                                            <td class="text-danger">Rp. {{ number_format($order->shipping_price,0,",",".") }}</td>
                                                        @endif

                                                        <td>
                                                            @if ($order->status == 'pending' || $order->status == 'menunggu pembayaran' || $order->status == 'konfirmasi pembayaran')
                                                                <span class="badge rounded-pill alert-warning text-warning">{{ ucwords($order->status) }}</span>
                                                            @elseif ($order->status == 'terbayar' || $order->status == 'terkirim' || $order->status == 'diterima')
                                                                <span class="badge rounded-pill alert-success text-success">{{ ucwords($order->status) }}</span>
                                                            @else
                                                                <span class="badge rounded-pill alert-danger text-danger">{{ ucwords($order->status) }}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ date("d M Y H:i:s",strtotime($order->created_at)) }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <i class="icon material-icons md-menu"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                    <a href="" class="dropdown-item">Detail</a>
                                                                    <a href="" class="dropdown-item">Edit</a>

                                                                    <form action="" method="post" onsubmit="return confirm('Yakin hapus alamat?')">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button class="dropdown-item"> Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
            </div>

        </section> <!-- content-main end// -->


@endsection
