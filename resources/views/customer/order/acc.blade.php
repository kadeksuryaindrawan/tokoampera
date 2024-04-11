@extends('layouts.customer')

@section('content')

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow">Home</a>
                    <span></span> Order
                    <span></span> Accept
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

                    @foreach ($order_products as $op)
                        <div class="col-lg-6 mb-50">
                            <div class="d-flex justify-content-center align-items-center">
                                <div>
                                    <a class="example-image-link" href="{{ asset('storage/products/'.$op->product->img) }}" data-lightbox="example-1">
                                        <img style="width: 210px; height: 300px; object-fit:cover;" src="{{ asset('storage/products/'.$op->product->img) }}" alt="">
                                    </a>
                                </div>
                                <div class="ml-20">
                                    <h4 class="product-name"><a href="{{ route('product-detail',$op->product_id) }}">{{ ucwords($op->product->nama_produk) }}</a></h4>
                                    <form action="{{ route('acc-process') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                        <input type="hidden" name="order_id" value="{{ $op->order_id }}">
                                        <input type="hidden" name="product_id[]" value="{{ $op->product_id }}">
                                    <div class="row mt-3">
                                        <div class="col-lg-12">
                                            <label for="rating" class="label">Rating*</label>
                                            <select name="rating[]" class="form-control input-sm" id="rating" required>
                                                <option value="" selected disabled>- Pilih Rating -</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-12">
                                            <label for="review" class="label">Review</label>
                                            <textarea name="review[]" class="form-control" id="review" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-lg-12">
                                            <label for="media" class="label">Media</label>
                                            <input id="media" type="file" name="media[]" class="form-control">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach


                    <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>

                    <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

@endsection
