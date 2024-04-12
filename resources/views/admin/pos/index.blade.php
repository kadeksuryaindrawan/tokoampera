@extends('layouts.admin')

@section('content')
        <section class="content-main">
            <div class="row">

                <div class="col-lg-12 text-center mb-30">
                    <h4 class="mb-10">POS Admin</h4>
                    <a href="{{ url('/pos-history') }}"><button class="btn btn-sm btn-primary">History POS</button></a>
                </div>
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
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h4>Daftar Produk</h4>
                                            </div>
                                            <div style="overflow-x: scroll;">
                                                <table id="zero-conf" class="table" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Produk</th>
                                                            <th>Harga</th>
                                                            <th>Stok</th>
                                                            <th>Jumlah</th>
                                                            <th>Order</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $no=1;
                                                        @endphp
                                                        @foreach ($products as $product)
                                                            <tr>
                                                                <td style="vertical-align: middle;">{{ $no++ }}</td>
                                                                <td style="vertical-align: middle;">
                                                                    {{ strtoupper($product->nama_produk) }}
                                                                </td>
                                                                <td style="vertical-align: middle;">Rp. {{ number_format($product->price,0,",",".") }}</td>
                                                                <td style="vertical-align: middle;">{{ $product->stok }}</td>
                                                                <td style="vertical-align: middle;">
                                                                    <form action="{{ route('add-cart') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                    <input style="width: 70px;" class="form-control" name="qty" oninput="validateNumberInput()" type="number" id="myNumberInput" value="1" min="1">
                                                                </td>
                                                                <td style="vertical-align: middle;">
                                                                    <button type="submit" class="btn btn-sm btn-primary text-center"><i class="fas fa-plus"></i></button>
                                                                </td>
                                                                    </form>

                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-4">
                                <h4>Cart</h4>
                            </div>
                            <div class="col-lg-12 mb-30">
                                @if (session('nominal'))
                                    <p class="mb-10 font-sm">Anda sudah menggunakan kode voucher.</p>
                                    <form method="post" action="{{ route('voucher-destroy') }}">
                                        @csrf
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-md btn-primary">Hapus Kode Voucher Sebelumnya</button>
                                        </div>
                                    </form>
                                @else
                                    <p class="mb-10 font-sm">Anda Memiliki Voucher? Input kode voucher dibawah</p>
                                    <form method="post" action="{{ route('voucher') }}">
                                        @csrf
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="voucher" placeholder="Masukkan Kode Voucher...">
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-md btn-primary">Apply Coupon</button>
                                            </div>
                                        </div>
                                    </form>

                                @endif


                            </div>

                            <div class="table-responsive">
                            <table class="table shopping-summery text-center clean">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <td class="product-des" >
                                                <h5 class="product-name" style="padding-top: -200px;">{{ ucwords($cart->product->nama_produk) }}</h5>
                                            </td>
                                            <td class="price" data-title="Price"><span>Rp. {{ number_format($cart->product->price,0,",",".") }} </span></td>
                                            <td class="text-center" data-title="Stock">
                                                <form action="{{ route('update-cart',$cart->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="d-flex text-center justify-content-center align-items-center">
                                                        <div class="">
                                                            <input style="width: 70px;" class="form-control" name="qty" oninput="validateNumberInput()" type="number" id="myNumberInput" value="{{ $cart->qty }}" min="1">
                                                        </div>
                                                        <div class="">
                                                            <button type="submit" class="btn btn-sm btn-success text-light"><i class="fa fa-sync"></i></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                            <td class="text-right" data-title="Cart">
                                                <span>Rp. {{ number_format($cart->total,0,",",".") }} </span>
                                            </td>
                                            <td>
                                                <form action="{{ route('delete-cart',$cart->id) }}" method="post" onsubmit="return confirm('Yakin hapus product dari cart?')">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach


                                    <tr>
                                        <td colspan="6" class="text-end">
                                            <form action="{{ route('clear-cart') }}" method="post" onsubmit="return confirm('Yakin hapus cart?')">
                                                @csrf
                                                @method('delete')
                                                <button class="btn-xs btn-danger"><i class="fi-rs-cross-small"></i> Clear Cart</button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <form action="{{ route('checkout-process') }}" method="POST">
                            @csrf
                        @if (session('nama_voucher'))
                                @php
                                    $total = $total_cart - session('nominal');
                                @endphp
                                <input type="hidden" name="voucher" value="{{ session('nama_voucher') }}">
                                <input type="hidden" name="discount" value="{{ session('nominal') }}">
                                <input type="hidden" name="total" value="{{ $total }}">
                            @endif
                            <input type="hidden" name="total_sebelum_discount" value="{{ $total_cart }}">
                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">

                        <div class="row mb-50">
                            <div class="col-lg-12 col-md-12">
                                <div class="border p-md-4 p-30 border-radius cart-totals">
                                    <div class="heading_s1 mb-3">
                                        <h4>Cart Totals</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Cart Subtotal</td>
                                                    <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">Rp. {{ number_format($total_cart,0,",",".") }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Voucher</td>
                                                    @if (session('nominal'))
                                                        <td class="cart_total_amount">{{ session('nama_voucher') }}</td>
                                                    @else
                                                        <td class="cart_total_amount">-</td>
                                                    @endif

                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Discount</td>
                                                    @if (session('nominal'))
                                                        <td class="cart_total_amount">Rp. {{ number_format(session('nominal'),0,",",".") }}</td>
                                                    @else
                                                        <td class="cart_total_amount">-</td>
                                                    @endif

                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Total</td>
                                                    @if (session('nominal'))
                                                        <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">Rp. {{ number_format($total,0,",",".") }}</span></strong></td>
                                                    @else
                                                        <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">Rp. {{ number_format($total_cart,0,",",".") }}</span></strong></td>
                                                    @endif

                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button type="submit" class="btn btn-md btn-primary"> Order</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

            </div>

        </section> <!-- content-main end// -->

    <script>
        function validateNumberInput() {
            var input = document.getElementById("myNumberInput");
            if (input.value < 1) {
                input.value = 1;
            }
        }


    </script>

@endsection
