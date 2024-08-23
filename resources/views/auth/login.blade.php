<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Toko Ampera Dashboard</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/imgs/theme/favicon.svg') }}">
    <!-- Template CSS -->
    <link href="{{ asset('admin/css/main.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    <main>
        <section class="content-main mt-80 mb-80">
            <div class="card mx-auto card-login">
                <div class="card-body pb-50">
                    <div class="mb-4 text-center">
                        <a href="{{ url('/') }}"><img src="{{ asset('landing') }}/imgs/theme/logo-ampera.png" width="20%" alt="logo"></a>
                    </div>

                    <h4 class="card-title mb-3">{{ __('navbar.login') }}</h4>
                    <p class="mb-4">{{ __('content.please_login') }}</p>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email...">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div> <!-- form-group// -->
                        <div class="mb-4">
                            <label class="form-label" for="password">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password...">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div> <!-- form-group// -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100"> {{ __('navbar.login') }} </button>
                        </div> <!-- form-group// -->
                    </form>

                    <p class="text-center">{{ __('content.dont_account') }} <a href="{{ url('/register') }}">{{ __('navbar.register') }}</a></p>
                </div>
            </div>
        </section>
        <footer class="main-footer text-center">
            <p class="font-xs">
                <script>
                document.write(new Date().getFullYear())
                </script> ©, Toko Ampera
            </p>
            <p class="font-xs mb-30">All rights reserved</p>
        </footer>
    </main>
    <script src="{{ asset('admin/js/vendors/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/js/vendors/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/vendors/jquery.fullscreen.min.js') }}"></script>
    <!-- Main Script -->
    <script src="{{ asset('admin/js/main.js') }}" type="text/javascript"></script>
</body>

</html>
