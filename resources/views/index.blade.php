@extends('layouts.customer')

@section('content')

    <main class="main">
        <section class="home-slider position-relative pt-50">
            <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
                <div class="single-hero-slider single-animation-wrap">
                    <div class="container">
                        <div class="row align-items-center slider-animated-1">
                            <div class="col-lg-5 col-md-6">
                                <div class="hero-slider-content-2">
                                    <h4 class="animated">{{ __('content.hot_promo') }}</h4>
                                    <h2 class="animated fw-900">{{ __('content.trend') }}</h2>
                                    <h1 class="animated fw-900 text-7">{{ __('content.great') }}</h1>
                                    <p class="animated">{{ __('content.save') }}</p>
                                    <a class="animated btn btn-brush btn-brush-2" href="{{ url('/shop') }}"> {{ __('content.shop_now') }} </a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6 d-none d-md-block">
                                <div class="single-slider-img single-slider-img-1">
                                    <img style="width: 800px; height:500px; object-fit:cover" class="animated slider-1-2" src="{{ asset('landing') }}/imgs/2.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="single-hero-slider single-animation-wrap">
                    <div class="container">
                        <div class="row align-items-center slider-animated-1">
                            <div class="col-lg-5 col-md-6">
                                <div class="hero-slider-content-2">
                                    <h4 class="animated">{{ __('content.upcoming') }}</h4>
                                    <h2 class="animated fw-900">{{ __('content.big_deals') }}</h2>
                                    <h1 class="animated fw-900 text-8">{{ __('content.painter') }}</h1>
                                    <p class="animated">{{ __('content.many_categories') }}</p>
                                    <a class="animated btn btn-brush btn-brush-1" href="{{ url('/shop') }}"> {{ __('content.shop_now') }} </a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6 d-none d-md-block">
                                <div class="single-slider-img single-slider-img-1">
                                    <img style="width: 800px; height:500px; object-fit:cover" class="animated slider-1-3" src="{{ asset('landing') }}/imgs/3.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </section>
        <section class="featured section-padding position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="{{ asset('landing') }}/imgs/theme/icons/feature-1.png" alt="">
                            <h4 class="bg-1">{{ __('content.shipping') }}</h4>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="{{ asset('landing') }}/imgs/theme/icons/feature-2.png" alt="">
                            <h4 class="bg-3">{{ __('content.online') }}</h4>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="{{ asset('landing') }}/imgs/theme/icons/feature-3.png" alt="">
                            <h4 class="bg-2">{{ __('content.save_money') }}</h4>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="banner-features wow fadeIn animated hover-up">
                            <img src="{{ asset('landing') }}/imgs/theme/icons/feature-4.png" alt="">
                            <h4 class="bg-4">{{ __('content.discount') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="product-tabs section-padding position-relative wow fadeIn animated">
            <div class="bg-square"></div>
            <div class="container">
                <div class="tab-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">{{ __('content.new_added') }}</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two" type="button" role="tab" aria-controls="tab-two" aria-selected="false">{{ __('content.old_added') }}</button>
                        </li>
                    </ul>
                    <a href="{{ url('/shop') }}" class="view-more d-none d-md-flex">{{ __('content.view_more') }}<i class="fi-rs-angle-double-small-right"></i></a>
                </div>

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
                <!--End nav-tabs-->
                <div class="tab-content wow fadeIn animated" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">
                            @foreach ($new_products as $new)
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
                                            @php
                                                $rating = !empty($new->rated) ? $new->rated : 0;
                                            @endphp
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($rating - $i >= 0)
                                                    <i class="fas fa-star" style="margin-right: -3px; color: #f6b93b;"></i>
                                                @elseif($rating - $i < 0 && $rating - $i > -1)
                                                    <i class="fas fa-star-half-alt" style="margin-right: -3px; color: #f6b93b;"></i>
                                                @else
                                                    <i class="far fa-star" style="margin-right: -3px; color: #f6b93b;"></i>
                                                @endif
                                            @endfor
                                            <div class="product-price">
                                                <span>Rp. {{ number_format($new->price,0,",",".") }}</span>
                                            </div>
                                            <div class="product-action-1 show">
                                                <a aria-label="Add To Cart" class="action-btn hover-up" href="{{ route('add-cart-1') }}?product_id={{ $new->id }}&qty=1"><i class="fi-rs-shopping-bag-add"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab one (Featured)-->
                    <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="tab-two">
                        <div class="row product-grid-4">
                            @foreach ($old_products as $old)
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('product-detail',$old->id) }}">
                                                    <img style="width: 500px; height:200px; object-fit:cover;" class="default-img" src="{{ asset('storage/products/'.$old->img) }}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a href="{{ route('category-shop',$old->category_id) }}">{{ ucwords($old->category->name) }}</a>
                                            </div>
                                            <h2><a href="{{ route('product-detail',$old->id) }}">{{ ucwords($old->nama_produk) }}</a></h2>
                                            @php
                                                $rating = !empty($old->rated) ? $old->rated : 0;
                                            @endphp
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($rating - $i >= 0)
                                                    <i class="fas fa-star" style="margin-right: -3px; color: #f6b93b;"></i>
                                                @elseif($rating - $i < 0 && $rating - $i > -1)
                                                    <i class="fas fa-star-half-alt" style="margin-right: -3px; color: #f6b93b;"></i>
                                                @else
                                                    <i class="far fa-star" style="margin-right: -3px; color: #f6b93b;"></i>
                                                @endif
                                            @endfor
                                            <div class="product-price">
                                                <span>Rp. {{ number_format($old->price,0,",",".") }}</span>
                                            </div>
                                            <div class="product-action-1 show">
                                                <a aria-label="Add To Cart" class="action-btn hover-up" href="{{ route('add-cart-1') }}?product_id={{ $old->id }}&qty=1"><i class="fi-rs-shopping-bag-add"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--End tab two (Popular)-->
                </div>
                <!--End tab-content-->
            </div>
        </section>
        <section class="banner-2 section-padding pb-0 d-none d-md-block">
            <div class="container">
                <div class="banner-img banner-big wow fadeIn animated f-none">
                    <img src="{{ asset('landing') }}/imgs/banner/banner-4.png" alt="">
                    <div class="banner-text d-md-block d-none">
                        <h4 class="mb-15 mt-40 text-brand">{{ __('content.good_service') }}</h4>
                        <h1 class="fw-600 mb-20">{{ __('content.we_are_best') }}</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="popular-categories section-padding mt-15 mb-25">
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20">{{ __('content.all_category') }}</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows"></div>
                    <div class="carausel-6-columns" id="carausel-6-columns">
                        @foreach ($categories as $category)
                            <a href="{{ route('category-shop',$category->id) }}"><div class="card-1">
                                <h5>{{ ucwords($category->name) }}</h5>
                            </div></a>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>
        <section class="section-padding">
            <div class="container pt-25 pb-20">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="section-title mb-20">{{ __('content.new_blog') }}</h3>
                            <a href="{{ url('/blogs') }}" class="view-more">{{ __('content.view_more') }} <i class="fi-rs-angle-double-small-right"></i></a>
                        </div>

                        <div class="post-list mb-4 mb-lg-0">
                            @foreach ($blogs as $blog)
                                <article class="wow fadeIn animated">
                                    <div class="d-md-flex d-block">
                                        <div class="post-thumb d-flex mr-15">
                                            <a class="color-white" href="{{ route('blog-detail',$blog->id) }}">
                                                <img style="width: 200px; height:120px; object-fit:cover;" src="{{ asset('storage/blogs/'.$blog->gambar) }}" alt="">
                                            </a>
                                        </div>
                                        <div class="post-content row align-items-center">
                                            <h4 class="post-title mb-25 text-limit-2-row">
                                                <a href="{{ route('blog-detail',$blog->id) }}">{{ ucwords($blog->judul) }}</a>
                                            </h4>
                                            <div class="entry-meta meta-1 font-xs color-grey mt-10 pb-10">
                                                <div>
                                                    <span class="post-on">{{ date("d M Y H:i:s",strtotime($blog->created_at)) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

@endsection
