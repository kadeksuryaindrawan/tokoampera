<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>Toko Ampera</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('landing') }}/imgs/theme/logo.jpg">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('landing/css/main.css?v=3.4') }}">
    <link href="{{ asset('admin/DataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/lightbox.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/font-awesome/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

</head>

<body>
    <!-- Modal -->
    {{-- <div class="modal fade custom-modal" id="onloadModal" tabindex="-1" aria-labelledby="onloadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="deal" style="background-image: url('{{ asset('landing') }}/imgs/banner/menu-banner-7.png')">
                        <div class="deal-top">
                            <h2 class="text-brand">Deal of the Day</h2>
                            <h5>Limited quantities.</h5>
                        </div>
                        <div class="deal-content">
                            <h6 class="product-title"><a href="shop-product-right.html">Summer Collection New Morden Design</a></h6>
                            <div class="product-price"><span class="new-price">$139.00</span><span class="old-price">$160.99</span></div>
                        </div>
                        <div class="deal-bottom">
                            <p>Hurry Up! Offer End In:</p>
                            <div class="deals-countdown" data-countdown="2025/03/25 00:00:00"><span class="countdown-section"><span class="countdown-amount hover-up">03</span><span class="countdown-period"> days </span></span><span class="countdown-section"><span class="countdown-amount hover-up">02</span><span class="countdown-period"> hours </span></span><span class="countdown-section"><span class="countdown-amount hover-up">43</span><span class="countdown-period"> mins </span></span><span class="countdown-section"><span class="countdown-amount hover-up">29</span><span class="countdown-period"> sec </span></span></div>
                            <a href="shop-grid-right.html" class="btn hover-up">Shop Now <i class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
        </div>
        </div>
    </div> --}}

    <!-- Quick view -->
    {{-- <div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('landing') }}/imgs/shop/product-16-2.jpg" alt="product image">
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('landing') }}/imgs/shop/product-16-1.jpg" alt="product image">
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('landing') }}/imgs/shop/product-16-3.jpg" alt="product image">
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('landing') }}/imgs/shop/product-16-4.jpg" alt="product image">
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('landing') }}/imgs/shop/product-16-5.jpg" alt="product image">
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('landing') }}/imgs/shop/product-16-6.jpg" alt="product image">
                                    </figure>
                                    <figure class="border-radius-10">
                                        <img src="{{ asset('landing') }}/imgs/shop/product-16-7.jpg" alt="product image">
                                    </figure>
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails pl-15 pr-15">
                                    <div><img src="{{ asset('landing') }}/imgs/shop/thumbnail-3.jpg" alt="product image"></div>
                                    <div><img src="{{ asset('landing') }}/imgs/shop/thumbnail-4.jpg" alt="product image"></div>
                                    <div><img src="{{ asset('landing') }}/imgs/shop/thumbnail-5.jpg" alt="product image"></div>
                                    <div><img src="{{ asset('landing') }}/imgs/shop/thumbnail-6.jpg" alt="product image"></div>
                                    <div><img src="{{ asset('landing') }}/imgs/shop/thumbnail-7.jpg" alt="product image"></div>
                                    <div><img src="{{ asset('landing') }}/imgs/shop/thumbnail-8.jpg" alt="product image"></div>
                                    <div><img src="{{ asset('landing') }}/imgs/shop/thumbnail-9.jpg" alt="product image"></div>
                                </div>
                            </div>
                            <!-- End Gallery -->
                            <div class="social-icons single-share">
                                <ul class="text-grey-5 d-inline-block">
                                    <li><strong class="mr-10">Share this:</strong></li>
                                    <li class="social-facebook"><a href="#"><img src="{{ asset('landing') }}/imgs/theme/icons/icon-facebook.svg" alt=""></a></li>
                                    <li class="social-twitter"> <a href="#"><img src="{{ asset('landing') }}/imgs/theme/icons/icon-twitter.svg" alt=""></a></li>
                                    <li class="social-instagram"><a href="#"><img src="{{ asset('landing') }}/imgs/theme/icons/icon-instagram.svg" alt=""></a></li>
                                    <li class="social-linkedin"><a href="#"><img src="{{ asset('landing') }}/imgs/theme/icons/icon-pinterest.svg" alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info">
                                <h3 class="title-detail mt-30">Colorful Pattern Shirts HD450</h3>
                                <div class="product-detail-rating">
                                    <div class="pro-details-brand">
                                        <span> Brands: <a href="shop-grid-right.html">Bootstrap</a></span>
                                    </div>
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width:90%">
                                            </div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (25 reviews)</span>
                                    </div>
                                </div>
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <ins><span class="text-brand">$120.00</span></ins>
                                        <ins><span class="old-price font-md ml-15">$200.00</span></ins>
                                        <span class="save-price  font-md color3 ml-15">25% Off</span>
                                    </div>
                                </div>
                                <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                <div class="short-desc mb-30">
                                    <p class="font-sm">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam rem officia, corrupti reiciendis minima nisi modi,!</p>
                                </div>

                                <div class="attr-detail attr-color mb-15">
                                    <strong class="mr-10">Color</strong>
                                    <ul class="list-filter color-filter">
                                        <li><a href="#" data-color="Red"><span class="product-color-red"></span></a></li>
                                        <li><a href="#" data-color="Yellow"><span class="product-color-yellow"></span></a></li>
                                        <li class="active"><a href="#" data-color="White"><span class="product-color-white"></span></a></li>
                                        <li><a href="#" data-color="Orange"><span class="product-color-orange"></span></a></li>
                                        <li><a href="#" data-color="Cyan"><span class="product-color-cyan"></span></a></li>
                                        <li><a href="#" data-color="Green"><span class="product-color-green"></span></a></li>
                                        <li><a href="#" data-color="Purple"><span class="product-color-purple"></span></a></li>
                                    </ul>
                                </div>
                                <div class="attr-detail attr-size">
                                    <strong class="mr-10">Size</strong>
                                    <ul class="list-filter size-filter font-small">
                                        <li><a href="#">S</a></li>
                                        <li class="active"><a href="#">M</a></li>
                                        <li><a href="#">L</a></li>
                                        <li><a href="#">XL</a></li>
                                        <li><a href="#">XXL</a></li>
                                    </ul>
                                </div>
                                <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                <div class="detail-extralink">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <span class="qty-val">1</span>
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <div class="product-extra-link2">
                                        <button type="submit" class="button button-add-to-cart">Add to cart</button>
                                        <a aria-label="Add To Wishlist" class="action-btn hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                        <a aria-label="Compare" class="action-btn hover-up" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                    </div>
                                </div>
                                <ul class="product-meta font-xs color-grey mt-50">
                                    <li class="mb-5">SKU: <a href="#">FWM15VKT</a></li>
                                    <li class="mb-5">Tags: <a href="#" rel="tag">Cloth</a>, <a href="#" rel="tag">Women</a>, <a href="#" rel="tag">Dress</a> </li>
                                    <li>Availability:<span class="in-stock text-success ml-5">8 Items In Stock</span></li>
                                </ul>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                </div>
        </div>
        </div>
    </div> --}}


    <header class="header-area header-style-1 header-height-2">
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                            <ul>
                                <li><i class="fi-rs-smartphone"></i> <a href="#">(+01) - 2345 - 6789</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">

                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>
                                <li>

                                    @if (app()->getLocale() == 'id')
                                        <a class="language-dropdown-active"> <i class="fi-rs-world"></i> Indonesia <i class="fi-rs-angle-small-down"></i></a>
                                    @endif

                                    @if (app()->getLocale() == 'en')
                                        <a class="language-dropdown-active"> <i class="fi-rs-world"></i> English <i class="fi-rs-angle-small-down"></i></a>
                                    @endif

                                    <ul class="language-dropdown">
                                        @if (app()->getLocale() == 'id')
                                            <li><a href="{{ route('locale','en') }}"><img src="{{ asset('landing/imgs/en.png') }}" alt="">En</a></li>
                                        @endif

                                        @if (app()->getLocale() == 'en')
                                            <li><a href="{{ route('locale','id') }}"><img src="{{ asset('landing/imgs/id.png') }}" alt="">Id</a></li>
                                        @endif

                                    </ul>
                                </li>
                                @if (Auth::check() == false)
                                    <li><i class="fi-rs-user"></i><a href="{{ url('/login') }}">{{ __('navbar.login') }} / {{ __('navbar.register') }}</a></li>
                                @endif

                                @if (Auth::check() == true)
                                    <li style="margin-top: -12px; margin-bottom:-12px;">
                                        <a class="nav-link" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <button class="btn btn-sm radius-xl" style="background-color: #e74c3c; border:none;">{{ __('navbar.logout') }}</button>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo">
                        <a href="{{ url('/') }}"><img src="{{ asset('landing') }}/imgs/theme/logo.jpg" width="7%" alt="logo"></a>
                    </div>
                    <div class="header-right">
                        <div class="search-style-2">
                            {{-- <form action="#">
                                <select class="select-active">
                                    <option>All Categories</option>
                                    <option>Women's</option>
                                    <option>Men's</option>
                                    <option>Cellphones</option>
                                    <option>Computer</option>
                                    <option>Electronics</option>
                                    <option> Accessories</option>
                                    <option>{{ __('navbar.home') }} & Garden</option>
                                    <option>Luggage</option>
                                    <option>Shoes</option>
                                    <option>Mother & Kids</option>
                                </select>
                                <input type="text" placeholder="Search for items...">
                            </form> --}}
                        </div>
                        <div class="header-action-right">
                            <div class="header-action-2">
                                <div class="header-action-icon-2">
                                    {{-- <a href="shop-wishlist.html">
                                        <img class="svgInject" alt="Evara" src="{{ asset('landing') }}/imgs/theme/icons/icon-heart.svg">
                                        <span class="pro-count blue">4</span>
                                    </a> --}}
                                </div>
                                <div class="header-action-icon-2">
                                    <a class="mini-cart-icon" href="{{ url('/cart') }}">
                                        <img alt="Evara" src="{{ asset('landing') }}/imgs/theme/icons/icon-cart.svg">

                                        @if (Auth::check() == true)
                                            <span class="pro-count blue">{{ $count_cart }}</span>
                                        @endif
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo d-block d-lg-none">
                        <a href="{{ url('/') }}"><img src="{{ asset('landing') }}/imgs/theme/logo.jpg" width="13%" alt="logo"></a>
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                            <a class="categori-button-active" href="#">
                                <span class="fi-rs-apps"></span> {{ __('navbar.browse_categories') }}
                            </a>
                            <div class="categori-dropdown-wrap categori-dropdown-active-large">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li><a href="{{ route('category-shop',$category->id) }}">{{ ucwords($category->name) }}</a></li>
                                    @endforeach
                                </ul>
                                <div class="more_categories">{{ __('navbar.show_more') }}...</div>
                            </div>
                        </div>
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                            <nav>
                                <ul>
                                    <li><a class="{{ (request()->segment(1) == 'home' || request()->segment(1) == '') ? 'active' : '' }}" href="{{ url('/') }}">{{ __('navbar.home') }}</a></li>
                                    <li><a class="{{ (request()->segment(1) == 'shop' || request()->segment(1) == 'product-detail' || request()->segment(1) == 'cart' || request()->segment(1) == 'category-shop' || request()->segment(1) == 'checkout' || request()->segment(1) == 'customer-address') ? 'active' : '' }}" href="{{ url('/shop') }}">{{ __('navbar.shop') }}</a></li>
                                    {{-- <li><a class="{{ (request()->segment(1) == 'blogs' || request()->segment(1) == 'blog-detail') ? 'active' : '' }}" href="{{ url('/blogs') }}">{{ __('navbar.blog') }}</a></li> --}}
                                    <li><a class="{{ (request()->segment(1) == 'contact') ? 'active' : '' }}" href="{{ url('/contact') }}">{{ __('navbar.contact') }}</a></li>
                                    <li><a class="{{ (request()->segment(1) == 'order-lists' || request()->segment(1) == 'order-history' || request()->segment(1) == 'pay' || request()->segment(1) == 'order-acc') ? 'active' : '' }}" href="{{ url('/order-lists') }}">{{ __('navbar.order') }}</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="hotline d-none d-lg-block">

                    </div>
                    <p class="mobile-promotion">Happy <span class="text-brand">Mother's Day</span>. Big Sale Up to 40%</p>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                {{-- <a href="shop-wishlist.html">
                                    <img alt="Evara" src="{{ asset('landing') }}/imgs/theme/icons/icon-heart.svg">
                                    <span class="pro-count white">4</span>
                                </a> --}}
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ url('/cart') }}">
                                    <img alt="Evara" src="{{ asset('landing') }}/imgs/theme/icons/icon-cart.svg">
                                    @if (Auth::check() == true)
                                        <span class="pro-count white">{{ $count_cart }}</span>
                                    @endif
                                </a>

                            </div>
                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="{{ url('/') }}"><img src="{{ asset('landing') }}/imgs/theme/logo.jpg" alt="logo"></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                {{-- <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="text" placeholder="Search for items…">
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div> --}}
                <div class="mobile-menu-wrap mobile-header-border">
                    <div class="main-categori-wrap mobile-header-border">
                        <a class="categori-button-active-2" href="#">
                            <span class="fi-rs-apps"></span> {{ __('navbar.browse_categories') }}
                        </a>
                        <div class="categori-dropdown-wrap categori-dropdown-active-small">
                            <ul>
                                @foreach ($categories as $category)
                                        <li><a href="shop-grid-right.html">{{ ucwords($category->name) }}</a></li>
                                    @endforeach

                            </ul>
                        </div>
                    </div>
                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ url('/home') }}">{{ __('navbar.home') }}</a>
                            </li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ url('/shop') }}">{{ __('navbar.shop') }}</a>
                            </li>
                            {{-- <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ url('/blogs') }}">{{ __('navbar.blog') }}</a>
                            </li> --}}
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ url('/contact') }}">{{ __('navbar.contact') }}</a>
                            </li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{ url('/order-lists') }}">{{ __('navbar.order') }}</a>
                            </li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">{{ __('navbar.language') }}</a>
                                <ul class="dropdown">
                                    <li><a href="{{ route('locale','en') }}">En</a></li>
                                    <li><a href="{{ route('locale','id') }}">Id</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap mobile-header-border">
                    <div class="single-mobile-header-info">
                        @if (Auth::check() == false)
                                    <a href="{{ url('/login') }}">{{ __('navbar.login') }} / {{ __('navbar.register') }} </a>
                                @endif

                                @if (Auth::check() == true)
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                            <button class="btn btn-sm radius-xl" style="background-color: #e74c3c; border:none;">{{ __('navbar.logout') }}</button>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                @endif

                    </div>
                    <div class="single-mobile-header-info">
                        <a href="#">(+01) - 2345 - 6789 </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @yield('content')
    <footer class="main">
        <section class="newsletter p-30 text-white wow fadeIn animated">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 mb-md-12 mb-lg-0">
                        <div class="row align-items-center text-center">
                            <div class="col">
                                <h4 class="font-size-20 mb-0 ml-3">{{ __('content.interested') }} <a href="{{ url('login') }}">{{ __('navbar.login') }}/{{ __('navbar.register') }}</a></h4>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col-lg-8 col-md-4">
                        <div class="widget-about font-md mb-md-5 mb-lg-0">
                            <div class="logo wow fadeIn animated">
                                <a href="{{ url('/') }}"><img src="{{ asset('landing') }}/imgs/theme/logo.jpg" style="width: 15%;" alt="logo"></a>
                            </div>
                            <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">{{ __('navbar.contact') }}</h5>
                            <p class="wow fadeIn animated">
                                <strong>{{ __('content.address') }} : </strong>{{ __('content.address_name') }}
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>{{ __('content.phone') }} : </strong>+01 2222 365 /(+91) 01 2345 6789
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <h5 class="widget-title wow fadeIn animated">Menu</h5>
                        <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                            <li><a href="{{ url('/') }}">{{ __('navbar.home') }}</a></li>
                            <li><a href="{{ url('/shop') }}">{{ __('navbar.shop') }}</a></li>
                            {{-- <li><a href="{{ url('/blogs') }}">{{ __('navbar.blog') }}</a></li> --}}
                            <li><a href="{{ url('/contact') }}">{{ __('navbar.contact') }}</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <h5 class="widget-title wow fadeIn animated">{{ __('navbar.my_account') }}</h5>
                        <ul class="footer-list wow fadeIn animated">
                            <li><a href="{{ url('/login') }}">{{ __('navbar.login') }}</a></li>
                            <li><a href="{{ url('/cart') }}">{{ __('navbar.cart') }}</a></li>
                            <li><a href="{{ url('/order-lists') }}">{{ __('navbar.order') }}</a></li>
                        </ul>
                    </div>

                </div>
            </div>
        </section>
        <div class="container pb-20 wow fadeIn animated">
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-lg-6">
                    <p class="float-md-left font-sm text-muted mb-0">&copy; 2022, <strong class="text-brand">Evara</strong> - HTML Ecommerce Template </p>
                </div>
                <div class="col-lg-6">
                    <p class="text-lg-end text-start font-sm text-muted mb-0">
                        Designed by <a href="http://alithemes.com" target="_blank">Alithemes.com</a>. All rights reserved
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <h5 class="mb-10">Now Loading</h5>
                    <div class="loader">
                        <div class="bar bar1"></div>
                        <div class="bar bar2"></div>
                        <div class="bar bar3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->
    <script src="{{ asset('landing/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('landing/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('landing/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('landing/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('landing/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('landing/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('landing/js/plugins/jquery-ui.js') }}"></script>
    <script src="{{ asset('landing/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('landing/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('landing/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('landing/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('landing/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('landing/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('landing/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('landing/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('landing/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('landing/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('landing/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('landing/js/plugins/jquery.elevatezoom.js') }}"></script>
    <script src="{{ asset('admin/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/js/datatables.js') }}"></script>
    <script src="{{ asset('admin/js/lightbox.js') }}"></script>


    <!-- Template  JS -->
    <script src="{{ asset('landing/js/main.js?v=3.4') }}"></script>
    <script src="{{ asset('landing/js/shop.js?v=3.4') }}"></script>


</body>

</html>
