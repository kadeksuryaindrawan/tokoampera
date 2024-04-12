@extends('layouts.customer')

@section('content')

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Checkout
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
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
                            <a href="{{ url('/cart') }}"><button class="btn btn-sm btn-primary">Kembali</button></a>
                        </div>

                    <div class="col-lg-6 mb-sm-15 mt-40">
                        <div class="toggle_info">
                            <span></i><span class="text-muted">Ingin menambah alamat?</span> <a href="{{ route('customer-address.index') }}">Tambah Alamat Baru</a></span>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-40">
                        <div class="toggle_info">
                            <span><i class="fi-rs-label mr-10"></i><span class="text-muted">Have a coupon?</span> <a href="#coupon" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click here to enter your code</a></span>
                        </div>
                        <div class="panel-collapse collapse coupon_form " id="coupon">
                            <div class="panel-body">
                                @if (session('nominal'))
                                    <p class="mb-30 font-sm">Anda sudah menggunakan kode voucher. Hapus terlebih dahulu kode voucher sebelumnya</p>
                                    <form method="post" action="{{ route('voucher-destroy') }}">
                                        @csrf
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-md">Hapus Kode Voucher Sebelumnya</button>
                                        </div>
                                    </form>
                                @else
                                    <p class="mb-30 font-sm">Jika anda memiliki kode voucher, masukkan kode voucher dibawah.</p>
                                    <form method="post" action="{{ route('voucher') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="voucher" placeholder="Masukkan Kode Voucher...">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-md">Apply Coupon</button>
                                        </div>
                                    </form>

                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="divider mt-50 mb-50"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-25">
                            <h4>Billing Details</h4>
                        </div>
                        <form method="post" action="{{ route('checkout-process') }}">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" required="" name="nama_lengkap" value="{{ $customer->nama_lengkap }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" required="" name="email" value="{{ $customer->user->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">No Telp</label>
                                <input type="number" required="" name="telp" value="{{ $customer->telp }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <select name="customer_address_id" id="" class="form-control" required>
                                    <option value="" selected disabled>- Pilih Alamat -</option>
                                    @foreach ($customer_addresses as $ca)
                                        <option value="{{ $ca->id }}">{{ $ca->nama_alamat }} - {{ $ca->alamat }}</option>
                                    @endforeach
                                </select>
                            </div>

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


                    </div>
                    <div class="col-md-6">
                        <div class="order_review">
                            <div class="mb-20">
                                <h4>Your Orders</h4>
                            </div>
                            <div class="table-responsive order_table text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $cart)
                                            <tr>
                                                <td class="image product-thumbnail">
                                                <a class="example-image-link" href="{{ asset('storage/products/'.$cart->product->img) }}" data-lightbox="example-1">
                                                    <img style="object-fit: cover; width: 80px; height:50px;" src="{{ asset('storage/products/'.$cart->product->img) }}" alt="product image">
                                                </a>
                                            </td>
                                                <td>
                                                    <h5><a href="{{ route('product-detail',$cart->product_id) }}">{{ ucwords($cart->product->nama_produk) }}</a></h5> <span class="product-qty">x {{ $cart->qty }}</span>
                                                </td>
                                                <td>Rp. {{ number_format($cart->total,0,",",".") }} </td>
                                            </tr>
                                        @endforeach


                                        <tr>
                                            <th>SubTotal</th>
                                            <td class="product-subtotal" colspan="2">Rp. {{ number_format($total_cart,0,",",".") }}</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td colspan="2"><em>Pending</em></td>
                                        </tr>
                                        <tr>
                                            <th>Discount</th>
                                            @if (session('nominal'))
                                                <td colspan="2"><em class="text-brand">Rp. {{ number_format(session('nominal'),0,",",".") }}</em></td>
                                            @else
                                                <td colspan="2"><em>-</em></td>
                                            @endif

                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            @if (session('nominal'))
                                                <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">Rp. {{ number_format($total,0,",",".") }}</span></td>
                                            @else
                                                <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">Rp. {{ number_format($total_cart,0,",",".") }}</span></td>
                                            @endif

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button onclick="return confirm('Yakin checkout? Pastikan data anda sudah benar!')" type="submit" class="btn btn-fill-out btn-block mt-30">Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        function validateNumberInput() {
            var input = document.getElementById("myNumberInput");
            if (input.value < 1) {
                input.value = 1;
            }
        }
    </script>

@endsection
