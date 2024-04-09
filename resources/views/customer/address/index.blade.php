@extends('layouts.customer')

@section('content')

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Your Address
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

                    <div class="col-12">
                        <a href="{{ url('/checkout') }}"><button class="btn btn-sm btn-primary">Kembali</button></a>
                            <div class="card mb-4 mt-40">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4>Alamat</h4>
                                        <a href="{{ route('customer-address.create') }}"><button class="btn btn-primary">Tambah Alamat</button></a>
                                    </div>
                                    <div style="overflow-x: scroll;">
                                        <table id="zero-conf" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Alamat</th>
                                                    <th>Alamat</th>
                                                    <th>Lokasi</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no=1;
                                                @endphp
                                                @foreach ($customer_addresses as $c_address)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ ucwords($c_address->nama_alamat) }}</td>
                                                        <td>{{ ucfirst($c_address->alamat) }}</td>
                                                        <td><a target="_BLANK" href="https://www.google.com/maps?q={{ $c_address->lat}},{{ $c_address->long}}"><button class="btn btn-sm btn-primary">Lihat Lokasi</button></a></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                    {{-- <a href="{{ route('category.show',$category->id) }}" class="dropdown-item"><i data-feather="zoom-in"></i> Detail</a> --}}
                                                                    <a href="{{ route('customer-address.edit',$c_address->id) }}" class="dropdown-item">Edit</a>

                                                                    <form action="{{route('customer-address.destroy',$c_address->id)}}" method="post" onsubmit="return confirm('Yakin hapus alamat?')">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <button class="dropdown-item"> Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
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
