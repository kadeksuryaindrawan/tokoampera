@extends('layouts.customer')

@section('content')

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow">Home</a>
                    <span></span> {{ __('navbar.contact') }}
                </div>
            </div>
        </div>
        <section class="hero-2 bg-green">
            <div class="hero-content">
                <div class="container">
                    <div class="text-center">
                        <h4 class="text-brand mb-20">{{ __('content.get_touch') }}</h4>
                        <h1 class="mb-20 wow fadeIn animated font-xxl fw-900">
                            {{ __('content.contact_us') }} <br> {{ __('content.contact_below') }}
                        </h1>
                        <p class="w-50 m-auto wow fadeIn animated">Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum quam eius placeat, a quidem mollitia at accusantium reprehenderit pariatur provident nam ratione incidunt magnam sequi.</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-border pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="mb-15 text-brand">{{ __('navbar.shop') }}</h4>
                        205 North Michigan Avenue, Suite 810<br>
                        Chicago, 60601, USA<br>
                        <abbr title="Phone">Phone:</abbr> (123) 456-7890<br>
                        <abbr title="Email">Email: </abbr>contact@Evara.com<br>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
