@extends('layouts.customer')

@section('content')

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow">Home</a>
                    <span></span> {{ __('navbar.shop') }}
                    <span></span> {{ __('navbar.cart') }}
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
                        </div>

                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table shopping-summery text-center clean">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">{{ __('content.img') }}</th>
                                        <th scope="col">{{ __('content.name') }}</th>
                                        <th scope="col">{{ __('content.price') }}</th>
                                        <th scope="col">{{ __('content.qty') }}</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">{{ __('content.remove') }}</th>
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
                                            <td class="product-des product-name">
                                                <h5 class="product-name"><a href="{{ route('product-detail',$cart->product_id) }}">{{ ucwords($cart->product->nama_produk) }}</a></h5>
                                            </td>
                                            <td class="price" data-title="Price"><span>Rp. {{ number_format($cart->product->price,0,",",".") }} </span></td>
                                            <td class="text-center" data-title="Stock">
                                                <form action="{{ route('update-cart',$cart->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row text-center justify-content-center align-items-center">
                                                        <div class="col-2">
                                                            <input style="width: 70px;" class="form-control" name="qty" oninput="validateNumberInput()" type="number" id="myNumberInput" value="{{ $cart->qty }}" min="1">
                                                        </div>
                                                        <div class="col-4">
                                                            <button type="submit" class="btn btn-sm btn-success">{{ __('content.update') }} {{ __('content.qty') }}</button>
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
                                                    <button class="btn-xs btn-danger"><i class="fi-rs-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach


                                    <tr>
                                        <td colspan="6" class="text-end">
                                            <form action="{{ route('clear-cart') }}" method="post" onsubmit="return confirm('Clear cart?')">
                                                @csrf
                                                @method('delete')
                                                <button class="btn-xs btn-danger"><i class="fi-rs-cross-small"></i> {{ __('content.clear') }} Cart</button>
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="cart-action text-end">
                            <a class="btn" href="{{ url('/shop') }}"><i class="fi-rs-shopping-bag mr-10"></i>{{ __('navbar.shop') }}</a>
                        </div>
                        <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                        <div class="row mb-50">
                            <div class="col-lg-12 col-md-12">
                                <div class="border p-md-4 p-30 border-radius cart-totals">
                                    <div class="heading_s1 mb-3">
                                        <h4>Total</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Subtotal</td>
                                                    <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">Rp. {{ number_format($total_cart,0,",",".") }}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">{{ __('content.shipping_price') }}</td>
                                                    <td class="cart_total_amount"> <i class="ti-gift mr-5"></i> Pending</td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Total</td>
                                                    <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">Rp. {{ number_format($total_cart,0,",",".") }}</span></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="{{ url('/checkout') }}" class="btn "> <i class="fi-rs-box-alt mr-10"></i>CheckOut</a>
                                </div>
                            </div>
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
