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
                    <div class="col-lg-12">
                        <div class="single-header mb-50 text-center">
                            <h1 class="font-xxl text-brand">Our Blog</h1>
                        </div>
                        <div class="loop-grid pr-30">
                            <div class="row">
                                @foreach ($blogs as $blog)
                                    <div class="col-lg-3">
                                        <article class="wow fadeIn animated hover-up mb-30">
                                            <div class="post-thumb img-hover-scale">
                                                <a href="{{ route('blog-detail',$blog->id) }}">
                                                    <img style="width: 500px; height:200px; object-fit:cover;" class="default-img" src="{{ asset('storage/blogs/'.$blog->gambar) }}" alt="">
                                                </a>
                                            </div>
                                            <div class="entry-content-2">
                                                <h4 class="post-title mb-15">
                                                    <a href="{{ route('blog-detail',$blog->id) }}">{{ ucwords($blog->judul) }}</a></h4>
                                                <p class="post-exerpt mb-30 font-sm">{{ substr(ucfirst($blog->deskripsi), 0, 20) }}...</p>
                                                <div class="entry-meta meta-1 font-xs color-grey mt-10 pb-10">
                                                <div>
                                                    <span class="post-on"> <i class="fi-rs-clock"></i> {{ date("d M Y H:i:s",strtotime($blog->created_at)) }}</span>
                                                </div>
                                                <a href="{{ route('blog-detail',$blog->id) }}" class="text-brand">Detail <i class="fi-rs-arrow-right"></i></a>
                                            </div>
                                            </div>
                                        </article>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
