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
            <a href="{{ route('export-order', ['status' => 'diterima']) }}"><button class="btn btn-danger">Export PDF</button></a>
            <div class="card mb-4 mt-4">
                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4>Order Sukses</h4>
                                    </div>
                                    <div style="overflow-x: scroll;">
                                        <table id="zero-conf" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Invoice</th>
                                                    <th>Nama Customer</th>
                                                    <th>Total</th>
                                                    <th>Alamat</th>
                                                    <th>Kurir</th>
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
                                                        <td>
                                                            @if ($order->customer->user->role == 'customer')
                                                                <a target="_blank" href="https://www.google.com/maps?q={{ $order->lat}},{{ $order->long}}"><button class="btn btn-primary btn-sm">Lihat</button></a>
                                                            @else
                                                                -
                                                            @endif

                                                        </td>
                                                        @if ($order->shipping_price == NULL)
                                                            <td>-</td>
                                                            <td>-</td>
                                                        @else
                                                            <td>{{ $order->shipping_courier }}</td>
                                                            <td class="text-danger">Rp. {{ number_format($order->shipping_price,0,",",".") }}</td>
                                                        @endif

                                                        <td>
                                                            <span class="badge rounded-pill alert-success text-success">{{ ucwords($order->status) }}</span>
                                                        </td>
                                                        <td>{{ date("d M Y H:i:s",strtotime($order->created_at)) }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <i class="icon material-icons md-menu"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                    <a href="{{ route('order-detail',$order->id) }}" class="dropdown-item">Detail</a>
                                                                    <form action="{{ route('order-delete',$order->id) }}" method="post" onsubmit="return confirm('Yakin hapus order?')">
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
