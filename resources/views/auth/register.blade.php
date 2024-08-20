<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Evara Dashboard</title>
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
            <div class="card mx-auto card-login-2">
                <div class="card-body pb-50">
                    <div class="mb-4 text-center">
                        <a href="{{ url('/') }}"><img src="{{ asset('landing') }}/imgs/theme/logo-ampera.png" width="20%" alt="logo"></a>
                    </div>
                    <h4 class="card-title mb-3">{{ __('navbar.register') }}</h4>
                    <p class="mb-4">Silahkan daftar menggunakan data diri anda.</p>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="nama_lengkap">{{ __('content.fullname') }}</label>
                            <input id="nama_lengkap" type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required autocomplete="nama_lengkap" autofocus placeholder="{{ __('content.fullname') }}...">

                                @error('nama_lengkap')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div> <!-- form-group// -->
                        <div class="mb-3">
                            <label class="form-label" for="username">Username</label>
                            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username...">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div> <!-- form-group// -->

                        <div class="mb-3">
                            <label class="form-label" for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email...">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div> <!-- form-group// -->
                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password...">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div> <!-- form-group// -->
                        <div class="mb-4">
                            <label class="form-label" for="password-confirm">Re Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Re Password...">
                        </div> <!-- form-group// -->

                        <div class="mb-3">
                            <label class="form-label" for="telp">Hp</label>
                            <input id="telp" type="number" class="form-control @error('telp') is-invalid @enderror" name="telp" value="{{ old('telp') }}" required autocomplete="telp" autofocus placeholder="Hp...">

                                @error('telp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div> <!-- form-group// -->
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary w-100"> {{ __('navbar.register') }} </button>
                        </div> <!-- form-group// -->
                    </form>

                    <p class="text-center mb-2">{{ __('content.already_account') }} <a href="{{ url('/login') }}">{{ __('navbar.login') }}</a></p>
                </div>
            </div>
        </section>
        <footer class="main-footer text-center">
            <p class="font-xs">
                <script>
                document.write(new Date().getFullYear())
                </script> ©, Evara - HTML Ecommerce Template .
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
