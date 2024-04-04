@extends('layouts.admin')

@section('content')

        <section class="content-main">
            <div class="content-header">
                <h2 class="content-title">Detail {{ ucwords($product->nama_produk) }}</h2>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                                    <h5 class="card-title">Data Produk</h5>
                                    <p>Kategori : {{ ucwords($product->category->name) }}</p>
                                    <p>Nama Produk : {{ ucwords($product->nama_produk) }}</p>
                                    <p>Harga : Rp. {{ number_format($product->price,0,",",".") }}</p>
                                    <p>
                                        Status :
                                        @if ($product->status == 'active')
                                            <span class="badge rounded-pill alert-success text-success">{{ ucwords($product->status) }}</span>
                                        @else
                                            <span class="badge rounded-pill alert-danger text-danger">{{ ucwords($product->status) }}</span>
                                        @endif

                                    </p>
                                    <p>Stok : {{ $product->stok }}</p>
                                    <p>Rated : {{ ucfirst($product->rated) }}</p>
                                    <p>Produk Ditambahkan Pada : {{ date("d M Y H:i:s",strtotime($product->created_at)) }}</p>
                                    <p>Produk Diedit Pada : {{ date("d M Y H:i:s",strtotime($product->updated_at)) }}</p>
                                    <p>Foto : </p>
                                    <a class="example-image-link" href="{{ asset('storage/products/'.$product->img) }}" data-lightbox="example-1">
                                        <img style="width: 40%;" src="{{ asset('storage/products/'.$product->img) }}" alt="">
                                    </a>
                        </div>
                        <div class="col-lg-8">
                                    <h5 class="card-title">Deskripsi</h5>
                                    <p><?= $product->deskripsi ?></p>
                        </div>
                    </div>
                </div> <!-- card-body // -->
            </div> <!-- card end// -->

        </section>


@endsection
