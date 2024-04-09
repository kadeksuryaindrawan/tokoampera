@extends('layouts.customer')

@section('content')

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow">Home</a>
                    <span></span> Blog
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container custom">
                <div class="row">
                    <div class="col-lg-12 m-auto">
                        <div class="single-page pl-30">
                            <div class="single-header style-2">
                                <h1 class="mb-30">{{ ucwords($blog->judul) }}</h1>
                                <div class="single-header-meta">
                                    <div class="entry-meta meta-1 font-xs">
                                        <span>{{ date("d M Y H:i:s",strtotime($blog->created_at)) }}</span>
                                    </div>
                                </div>
                            </div>
                            <figure class="single-thumbnail text-center">
                                <img style="width: 1000px; height: 500px; object-fit: contain;" src="{{ asset('storage/blogs/'.$blog->gambar) }}" alt="">
                            </figure>
                            <div class="single-content">
                                <p>{{ ucfirst($blog->deskripsi) }}</p>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
