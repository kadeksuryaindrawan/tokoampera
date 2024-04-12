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
            <a href="{{ url('/pos') }}"><button class="btn btn-sm btn-primary">Kembali</button></a>
            <div class="card mt-20">
                <div class="card-body">
                    <div class="container mb-5 mt-3">
                    <div class="row d-flex align-items-baseline">
                        <div class="col-xl-9">
                        <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>{{ $order->invoice }}</strong></p>
                        </div>
                        <div class="col-xl-3 text-end">
                        <a href="{{ route('export-pdf-invoice',$order->id) }}" class="btn btn-light text-capitalize"><i
                            class="far fa-file-pdf text-danger"></i> Export</a>
                        </div>
                        <hr>
                    </div>

                    <div class="container">
                        <div class="col-md-12">
                        <div class="text-center">
                            <h4 class="pt-0">Art Shop Cempaka</h4>
                        </div>

                        </div>


                        <div class="row">
                        <div class="col-xl-12">
                            <p class="text-muted">Invoice</p>
                            <ul class="list-unstyled">
                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                class="fw-bold">{{ $order->invoice }}</li>
                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                class="fw-bold">Order Date: </span>{{ date("d M Y H:i:s",strtotime($order->created_at)) }}</li>
                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                class="me-1 fw-bold">Status:</span><span class="badge bg-success text-black fw-bold">
                                {{ ucwords($order->status) }}</span></li>
                            </ul>
                        </div>
                        </div>

                        <div class="row my-2 mx-1 justify-content-center">
                        <table class="table table-striped table-borderless">
                            <thead style="background-color:#84B0CA ;" class="text-white">
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_products as $op)
                                    <tr>
                                        <td>{{ ucwords($op->product->nama_produk) }}</td>
                                        <td>Rp. {{ number_format($op->product->price,0,",",".") }}</td>
                                        <td>{{ $op->qty }}</td>
                                        <td>Rp. {{ number_format($op->total,0,",",".") }}</td>
                                    </tr>
                                @endforeach


                            </tbody>

                        </table>
                        </div>
                        <div class="row">
                        <div class="col-xl-8">
                        </div>
                        <div class="col-xl-3">
                            <ul class="list-unstyled">
                            <li class="text-muted ms-3"><span class="text-black me-4">SubTotal</span>Rp. {{ number_format($order->total_sebelum_discount,0,",",".") }}</li>
                            @if ($order->discount == NULL)
                                <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Discount</span>-</li>
                            @else
                                <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Discount</span>Rp. {{ number_format($order->discount,0,",",".") }}</li>
                            @endif

                            </ul>
                            <p class="text-black float-start mt-20 ml-15"><span class="text-black me-3"> Total</span><span
                                style="font-size: 25px;">Rp. {{ number_format($order->total,0,",",".") }}</span></p>
                        </div>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col-xl-12">
                            <p>Thank you for your purchase</p>
                        </div>
                        </div>

                    </div>
                    </div>
                </div>
            </div>

        </section> <!-- content-main end// -->

@endsection
