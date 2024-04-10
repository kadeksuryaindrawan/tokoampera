<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Art Shop Cempaka Group - {{ ucwords(request()->segment(1)) }}</title>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('admin/css/main.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('admin/DataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/lightbox.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/font-awesome/css/all.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="screen-overlay"></div>
    <aside class="navbar-aside" id="offcanvas_aside">
        <div class="aside-top">
            <a href="{{ url('/') }}" class="brand-wrap">
                <img src="{{ asset('admin/imgs/theme/logo.jpg') }}" style="width: 20%; margin-bottom:-10px;" alt="Evara Dashboard">
            </a>
            <div>
                <button class="btn btn-icon btn-aside-minimize"> <i class="text-muted material-icons md-menu_open"></i> </button>
            </div>
        </div>
        <nav>
            <ul class="menu-aside">

                <li class="menu-item {{ (request()->segment(1) == 'home') ? 'active' : '' }}">
                    <a class="menu-link" href="{{ url('/home') }}"> <i class="icon material-icons md-home"></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li class="menu-item {{ (request()->segment(1) == 'user') ? 'active' : '' }}">
                    <a class="menu-link" href="{{ route('user.index') }}"> <i class="icon material-icons md-person"></i>
                        <span class="text">User</span>
                    </a>
                </li>
                <li class="menu-item {{ (request()->segment(1) == 'category') ? 'active' : '' }}">
                    <a class="menu-link" href="{{ route('category.index') }}"> <i class="icon material-icons md-toc"></i>
                        <span class="text">Kategori</span>
                    </a>
                </li>
                <li class="menu-item {{ (request()->segment(1) == 'product') ? 'active' : '' }}">
                    <a class="menu-link" href="{{ route('product.index') }}"> <i class="icon material-icons md-shopping_bag"></i>
                        <span class="text">Produk</span>
                    </a>
                </li>
                <li class="menu-item {{ (request()->segment(1) == 'voucher') ? 'active' : '' }}">
                    <a class="menu-link" href="{{ route('voucher.index') }}"> <i class="icon material-icons md-local_offer"></i>
                        <span class="text">Voucher</span>
                    </a>
                </li>
                <li class="menu-item {{ (request()->segment(1) == 'blog') ? 'active' : '' }}">
                    <a class="menu-link" href="{{ route('blog.index') }}"> <i class="icon material-icons md-library_books"></i>
                        <span class="text">Blog</span>
                    </a>
                </li>
                <li class="menu-item {{ (request()->segment(1) == 'order') ? 'active' : '' }}">
                    <a class="menu-link" href="{{ url('/order') }}"> <i class="icon material-icons md-shopping_cart"></i>
                        <span class="text">Order</span>
                    </a>
                </li>

                <li class="menu-item has-submenu">
                    <a class="menu-link" href="page-transactions-1.html"> <i class="icon material-icons md-monetization_on"></i>
                        <span class="text">Transactions</span>
                    </a>
                    <div class="submenu">
                        <a href="page-transactions-1.html">Transaction 1</a>
                        <a href="page-transactions-2.html">Transaction 2</a>
                        <a href="page-transactions-details.html">Transaction Details</a>
                    </div>
                </li>

            </ul>

            <br>
            <br>
        </nav>
    </aside>
    <main class="main-wrap">
        <header class="main-header navbar">
            <div class="col-search">
                {{-- <form class="searchform">
                    <div class="input-group">
                        <input list="search_terms" type="text" class="form-control" placeholder="Search term">
                        <button class="btn btn-light bg" type="button"> <i class="material-icons md-search"></i></button>
                    </div>
                    <datalist id="search_terms">
                        <option value="Products">
                        <option value="New orders">
                        <option value="Apple iphone">
                        <option value="Ahmed Hassan">
                    </datalist>
                </form> --}}
            </div>
            <div class="col-nav">
                <button class="btn btn-icon btn-mobile me-auto" data-trigger="#offcanvas_aside"> <i class="material-icons md-apps"></i> </button>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link btn-icon darkmode" href="#"> <i class="material-icons md-nights_stay"></i> </a>
                    </li>
                    <li class="dropdown nav-item">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#" id="dropdownAccount" aria-expanded="false"> <img class="img-xs rounded-circle" src="{{ asset('admin/imgs/people/avatar2.jpg') }}" alt="User"></a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccount">
                            <a class="dropdown-item" href="#">Selamat Datang, {{ ucwords(Auth::user()->username) }}</a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="material-icons md-exit_to_app"></i>Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                        </div>
                    </li>
                </ul>
            </div>
        </header>
        @yield('content')
        <footer class="main-footer font-xs">
            <div class="row pb-30 pt-15">
                <div class="col-sm-6">
                    <script>
                    document.write(new Date().getFullYear())
                    </script> ©, Evara - HTML Ecommerce Template .
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end">
                        All rights reserved
                    </div>
                </div>
            </div>
        </footer>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="{{ asset('admin/js/vendors/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('admin/js/vendors/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/js/vendors/select2.min.js') }}"></script>
    <script src="{{ asset('admin/js/vendors/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/js/vendors/jquery.fullscreen.min.js') }}"></script>
    <script src="{{ asset('admin/js/vendors/chart.js') }}"></script>
    <script src="{{ asset('admin/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/js/datatables.js') }}"></script>
    <script src="{{ asset('admin/js/lightbox.js') }}"></script>
    <!-- Main Script -->
    <script src="{{ asset('admin/js/main.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin/js/custom-chart.js') }}" type="text/javascript"></script>
</body>

</html>
