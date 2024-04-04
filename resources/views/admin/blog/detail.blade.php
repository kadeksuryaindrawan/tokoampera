@extends('layouts.admin')

@section('content')

        <section class="content-main">
            <div class="content-header">
                <h2 class="content-title">Detail Blog {{ $blog->nama }}</h2>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                                    <h5 class="card-title">Data Blog</h5>
                                    <p>Judul : {{ $blog->judul }}</p>
                                    <p>
                                        Status :
                                        @if ($blog->status == 'tampil')
                                            <span class="badge rounded-pill alert-success text-success">{{ ucwords($blog->status) }}</span>
                                        @else
                                            <span class="badge rounded-pill alert-danger text-danger">{{ ucwords($blog->status) }}</span>
                                        @endif

                                    </p>
                                    <p>Blog Ditambahkan Pada : {{ date("d M Y H:i:s",strtotime($blog->created_at)) }}</p>
                                    <p>Blog Diedit Pada : {{ date("d M Y H:i:s",strtotime($blog->updated_at)) }}</p>
                                    <p>Gambar Blog : </p>
                                    <a class="example-image-link" href="{{ asset('storage/blogs/'.$blog->gambar) }}" data-lightbox="example-1">
                                        <img style="width: 40%;" src="{{ asset('storage/blogs/'.$blog->gambar) }}" alt="">
                                    </a>
                        </div>
                        <div class="col-lg-8">
                                    <h5 class="card-title">Deskripsi</h5>
                                    <p><?= $blog->deskripsi ?></p>
                        </div>
                    </div>
                </div> <!-- card-body // -->
            </div> <!-- card end// -->

        </section>


@endsection
