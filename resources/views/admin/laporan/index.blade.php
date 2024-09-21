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
                <h4>Filter Laporan</h4>
                    <form action="{{ route('filter-laporan') }}" method="GET">
                        <div class="row">
                            <div class="col-auto">
                                <label for="dari">Dari Tanggal</label>
                                @if (isset($dari) && isset($sampai))
                                    <input type="date" value="{{ $dari }}" class="form-control" id="dari" name="dari" required>
                                @else
                                    <input type="date" class="form-control" id="dari" name="dari" required>
                                @endif
                            </div>
                            <div class="col-auto">
                                <label for="sampai">Sampai Tanggal</label>
                                @if (isset($dari) && isset($sampai))
                                    <input type="date" value="{{ $sampai }}" class="form-control" id="sampai" name="sampai" required>
                                @else
                                    <input type="date" class="form-control" id="sampai" name="sampai" required>
                                @endif
                            </div>
                            <div class="col-auto">
                                <label for=""></label>
                                <button type="submit" style="margin-top: 25px;" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>

            <div class="card mb-4 mt-4">
                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4>Laporan Pemesanan</h4>
                                        @if ($orders->isNotEmpty())
                                            @if (isset($dari) && isset($sampai))
                                                <div>
                                                    <a href="{{ route('export-filter-pdf', ['dari' => $dari, 'sampai' => $sampai]) }}"><button class="btn btn-danger">Export PDF</button></a>
                                                    {{-- <a href="{{ route('export-filter-excel', ['dari' => $dari, 'sampai' => $sampai]) }}"><button class="btn btn-success">Export Excel</button></a> --}}
                                                </div>
                                            @else
                                                <div>
                                                    <a href="{{ route('export-all-pdf') }}"><button class="btn btn-danger">Export PDF</button></a>
                                                    {{-- <a href="{{ route('export-all-excel') }}"><button class="btn btn-success">Export Excel</button></a> --}}
                                                </div>
                                            @endif

                                        @endif
                                    </div>
                                    <div style="overflow-x: scroll;">
                                        <table id="zero-conf" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Invoice</th>
                                                    <th>Nama Customer</th>
                                                    <th>Total</th>
                                                    <th>Kurir</th>
                                                    <th>Ongkir</th>
                                                    <th>Tanggal Checkout</th>
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
                                                            <td>-</td>
                                                        @else
                                                            <td>{{ $order->shipping_courier }}</td>
                                                            <td class="text-danger">Rp. {{ number_format($order->shipping_price,0,",",".") }}</td>
                                                        @endif
                                                        <td>{{ date("d M Y H:i:s",strtotime($order->created_at)) }}</td>

                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                </div>


            </div>

        </section> <!-- content-main end// -->

@endsection
