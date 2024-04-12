@extends('layouts.admin')

@section('content')

        <section class="content-main">
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
            </div>
            <div class="card mb-4">
                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4>Voucher</h4>
                                        <a href="{{ route('vouchers.create') }}"><button class="btn btn-primary">Tambah Voucher</button></a>
                                    </div>
                                    <div style="overflow-x: scroll;">
                                        <table id="zero-conf" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Voucher</th>
                                                    <th>Nominal</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no=1;
                                                @endphp
                                                @foreach ($vouchers as $voucher)
                                                    <tr>
                                                        <td style="vertical-align: middle;">{{ $no++ }}</td>
                                                        <td style="vertical-align: middle;">
                                                            <div class="d-flex align-items-center">
                                                                <a class="example-image-link" href="{{ asset('storage/vouchers/'.$voucher->gambar_voucher) }}" data-lightbox="example-1">
                                                                    <img style="width: 50px; height: 50px; object-fit:cover;" src="{{ asset('storage/vouchers/'.$voucher->gambar_voucher) }}" alt="">
                                                                </a>
                                                                <span style="margin-left: 5px; font-weight: 600; letter-spacing:1px;">{{ $voucher->nama }}</span>
                                                            </div>
                                                        </td>
                                                        <td style="vertical-align: middle;">Rp. {{ number_format($voucher->nominal,0,",",".") }}</td>
                                                        <td style="vertical-align: middle;">
                                                            @if ($voucher->status == 'tersedia')
                                                                <span class="badge rounded-pill alert-success text-success">{{ ucwords($voucher->status) }}</span>
                                                            @else
                                                                <span class="badge rounded-pill alert-danger text-danger">{{ ucwords($voucher->status) }}</span>
                                                            @endif
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <div class="dropdown d-flex align-items-center">
                                                                <button class="btn btn-sm btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <i class="icon material-icons md-menu"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                    <a href="{{ route('vouchers.show',$voucher->id) }}" class="dropdown-item">Detail</a>
                                                                    <a href="{{ route('vouchers.edit',$voucher->id) }}" class="dropdown-item">Edit</a>
                                                                    <form action="{{route('vouchers.destroy',$voucher->id)}}" method="post" onsubmit="return confirm('Yakin hapus voucher?')">
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

        </section> <!-- content-main end// -->


@endsection
