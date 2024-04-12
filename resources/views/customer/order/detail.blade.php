@extends('layouts.customer')

@section('content')

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow">Home</a>
                    <span></span> Order
                    <span></span> Order Detail
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <section class="content-main">
            <div class="content-header mb-20">
                <h2 class="content-title">Detail {{ ucwords($order->invoice) }}</h2>
            </div>
            <a href="{{ route('order-lists') }}"><button class="btn btn-sm btn-primary">Kembali</button></a>
            <div class="card mt-30">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                                    <h5 class="card-title">Data Order</h5>
                                    <p>Invoice : {{ ucwords($order->invoice) }}</p>
                                    <p>Nama Customer : {{ ucwords($order->customer->nama_lengkap) }}</p>
                                    <p>Alamat : {{ ucwords($order->alamat) }}</p>
                                    <p>Telp : {{ ucwords($order->customer->telp) }}</p>
                                    @if ($order->voucher == NULL)
                                    <p>Voucher : -</p>
                                    <p>Discount : -</p>
                                    @else
                                    <p>Voucher : {{ $order->voucher }}</p>
                                    <p>Discount : Rp. {{ number_format($order->discount,0,",",".") }}</p>
                                    @endif

                                    <p>Total Sebelum Discount : Rp. {{ number_format($order->total_sebelum_discount,0,",",".") }}</p>
                                    <p>Total : Rp. {{ number_format($order->total,0,",",".") }}</p>
                                    @if ($order->shipping_courier == NULL)
                                    <p>Kurir : -</p>
                                    <p>Ongkir : -</p>
                                    @else
                                    <p>Kurir : {{ $order->shipping_courier }}</p>
                                    <p>Ongkir : Rp. {{ number_format($order->shipping_price,0,",",".") }}</p>
                                    @endif

                                    <p>Total + Ongkir : Rp. {{ number_format($order->total + $order->shipping_price,0,",",".") }}</p>

                                    @if ($order->nama_bank == NULL)
                                    <p>Nama Bank : -</p>
                                    <p>No Bank : -</p>
                                    <p>Pemilik Bank : -</p>
                                    <p>Tanggal Bayar : -</p>
                                    <p>Bukti Bayar : -</p>
                                    @else
                                    <p>Nama Bank : {{ $order->nama_bank }}</p>
                                    <p>No Bank : {{ $order->no_bank }}</p>
                                    <p>Pemilik Bank : {{ ucwords($order->pemilik_bank) }}</p>
                                    <p>Tanggal Bayar : {{ date("d M Y H:i:s",strtotime($order->tanggal_bayar)) }}</p>
                                    <p>Bukti Bayar : </p>
                                    <a class="example-image-link" href="{{ asset('storage/bukti_bayar/'.$order->bukti_bayar) }}" data-lightbox="example-1">
                                        <img style="width: 40%;" src="{{ asset('storage/bukti_bayar/'.$order->bukti_bayar) }}" alt="">
                                    </a><br><br>
                                    @endif


                                    @if ($order->no_resi == NULL)
                                    <p>No Resi : -</p>
                                    @else
                                    <p>No Resi : {{ $order->resi }}</p>
                                    @endif

                                    <p>
                                        Status :
                                        @if ($order->status == 'pending' || $order->status == 'menunggu pembayaran' || $order->status == 'konfirmasi pembayaran')
                                            <span class="badge rounded-pill alert-warning text-warning">{{ ucwords($order->status) }}</span>
                                        @elseif ($order->status == 'terbayar' || $order->status == 'terkirim' || $order->status == 'diterima')
                                            <span class="badge rounded-pill alert-success text-success">{{ ucwords($order->status) }}</span>
                                        @else
                                            <span class="badge rounded-pill alert-danger text-danger">{{ ucwords($order->status) }}</span>
                                        @endif

                                    </p>
                                    <p>Checkout Pada : {{ date("d M Y H:i:s",strtotime($order->created_at)) }}</p>

                        </div>
                        <div class="col-lg-8">
                            <h5 class="card-title">Data Produk</h5>
                            <div class="row">
                                @foreach ($order_products as $op)
                                    <div class="col-lg-6 mb-50">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div>
                                                <a class="example-image-link" href="{{ asset('storage/products/'.$op->product->img) }}" data-lightbox="example-1">
                                                    <img style="width: 100px; height: 100px; object-fit:cover;" src="{{ asset('storage/products/'.$op->product->img) }}" alt="">
                                                </a>
                                            </div>
                                            <div class="ml-20">
                                                <h5 class="product-name"><a href="{{ route('product-detail',$op->product_id) }}">{{ ucwords($op->product->nama_produk) }} x {{ $op->qty }}</a></h5>
                                                <p>Total : Rp. {{ number_format($op->total,0,",",".") }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div> <!-- card-body // -->
            </div> <!-- card end// -->

        </section>

            </div>
        </section>
    </main>

@endsection
