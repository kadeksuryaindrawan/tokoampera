@extends('layouts.customer')

@section('content')

<main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow">Home</a>
                    <span></span> Shop
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p> We found <strong class="text-brand">{{ $count_products }}</strong> items for you!</p>
                            </div>
                        </div>
                        <div class="row product-grid-3">
                            @foreach ($products as $new)
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('product-detail',$new->id) }}">
                                                    <img style="width: 500px; height:200px; object-fit:cover;" class="default-img" src="{{ asset('storage/products/'.$new->img) }}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="{{ route('category-shop',$new->category_id) }}">{{ ucwords($new->category->name) }}</a>
                                            </div>
                                            <h2><a href="{{ route('product-detail',$new->id) }}">{{ ucwords($new->nama_produk) }}</a></h2>
                                            <div class="rating-result">

                                            </div>
                                            <div class="product-price">
                                                <span>Rp. {{ number_format($new->price,0,",",".") }}</span>
                                            </div>
                                            <div class="product-action-1 show">
                                                <a aria-label="Add To Cart" class="action-btn hover-up" href="shop-cart.html"><i class="fi-rs-shopping-bag-add"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
