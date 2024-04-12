@extends('layouts.customer')

@section('content')

<main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow">Home</a>
                    <span></span> {{ __('navbar.shop') }}
                    <span></span> {{ ucwords($product->nama_produk) }}
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
                    <div class="col-lg-12">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-gallery">
                                        {{-- <span class="zoom-icon"><i class="fi-rs-search"></i></span> --}}
                                        <!-- MAIN SLIDES -->
                                        {{-- <div class="product-image-slider"> --}}
                                            <figure class="border-radius-10">
                                                <a class="example-image-link" href="{{ asset('storage/products/'.$product->img) }}" data-lightbox="example-1">
                                                    <img style="object-fit: cover; width: 1000px; height:500px;" src="{{ asset('storage/products/'.$product->img) }}" alt="product image">
                                                </a>
                                            </figure>
                                        {{-- </div> --}}
                                    </div>
                                    <!-- End Gallery -->
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info">
                                        <h2 class="title-detail">{{ ucwords($product->nama_produk) }}</h2>
                                        <div class="product-detail-rating">
                                            <div class="pro-details-brand">
                                                <span> {{ __('content.category') }} : <a href="{{ route('category-shop',$product->category_id) }}">{{ ucwords($product->category->name) }}</a></span>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <div>
                                                    @php
                                                        $rating = !empty($product->rated) ? $product->rated : 0;
                                                    @endphp
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($rating - $i >= 0)
                                                            <i class="fas fa-star" style="margin-right: -30px; color: #f6b93b;"></i>
                                                        @elseif($rating - $i < 0 && $rating - $i > -1)
                                                            <i class="fas fa-star-half-alt" style="margin-right: -30px; color: #f6b93b;"></i>
                                                        @else
                                                            <i class="far fa-star" style="margin-right: -30px; color: #f6b93b;"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <span class="font-small ml-5 text-muted"> ({{ $rater }} {{ __('content.reviews') }})</span>
                                            </div>
                                        </div>
                                        <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">
                                                <ins><span class="text-brand">Rp. {{ number_format($product->price,0,",",".") }}</span></ins>
                                            </div>
                                        </div>

                                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                            <form action="{{ route('add-cart') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <div class="row">
                                                    <div class="col-2">
                                                        <input class="form-control" name="qty" oninput="validateNumberInput()" type="number" id="myNumberInput" value="1" min="1">
                                                    </div>
                                                    <div class="col-10">
                                                        <button type="submit" class="btn btn-success">Add to cart</button>
                                                    </div>
                                                </div>
                                            </form>

                                        <ul class="product-meta font-xs color-grey mt-50">
                                            <li>{{ __('content.stock') }} :<span class="in-stock text-success ml-5">{{ $product->stok }}</span></li>
                                        </ul>
                                    </div>
                                    <!-- Detail Info -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 m-auto entry-main-content">
                                    <h2 class="section-title style-1 mb-30">Desc</h2>
                                    <div class="description mb-50">
                                        <p>{{ ucfirst($product->deskripsi) }}</p>
                                    </div>
                                    <h3 class="section-title style-1 mb-30 mt-30">{{ ucfirst(__('content.reviews')) }} ({{ $rater }})</h3>
                                    <!--Comments-->
                                    <div class="comments-area style-2">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="comment-list">
                                                    @foreach ($order_products as $op)
                                                        <div class="single-comment justify-content-between d-flex">
                                                            <div class="user justify-content-between d-flex">
                                                                <div class="desc">
                                                                    <img style="width: 50px;height:50px;object-fit:cover;" src="{{ asset('landing') }}/imgs/page/avatar-6.jpg" alt="">
                                                                    <h6>{{ ucwords($op->order->customer->nama_lengkap) }}</h6>
                                                                    <div class="">
                                                                        @php
                                                                            $rating = !empty($op->rating) ? $op->rating : 0;
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
                                                                    </div>
                                                                    @if ($op->media != NULL)
                                                                        <a class="example-image-link" href="{{ asset('storage/media_review/'.$op->media) }}" data-lightbox="example-1">
                                                                            <img style="width: 120px; height: 80px; object-fit:cover;" src="{{ asset('storage/media_review/'.$op->media) }}" alt="">
                                                                        </a>
                                                                    @endif

                                                                    <p>{{ ucfirst($op->review) }}</p>
                                                                    <div class="d-flex justify-content-between">
                                                                        <div class="d-flex align-items-center">
                                                                            <p class="font-xs mr-30">{{ date("d M Y H:i:s",strtotime($op->updated_at)) }} </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <h4 class="mb-30">{{ ucfirst(__('content.reviews')) }} Customer </h4>
                                                <div class="d-flex justify-content-start mb-30">
                                                    <div style="margin-top: -8px; margin-right: 10px;">
                                                        @php
                                                            $rating = !empty($product->rated) ? $product->rated : 0;
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
                                                    </div>
                                                    @if ($product->rated == NULL)
                                                        <h6>0 out of 5</h6>
                                                    @else
                                                        <h6>{{ $product->rated }} out of 5</h6>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-60">
                                <div class="col-12">
                                    <h3 class="section-title style-1 mb-30">{{ __('content.related') }}</h3>
                                </div>
                                <div class="col-12">
                                    <div class="row related-products">
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
