@extends('layouts.admin')

@section('content')

        <section class="content-main">
            <div class="content-header">
                <h2 class="content-title">Detail Voucher {{ $voucher->nama }}</h2>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                                    <h5 class="card-title">Data Voucher</h5>
                                    <p>Nama Voucher : {{ $voucher->nama }}</p>
                                    <p>Nominal : Rp. {{ number_format($voucher->nominal,0,",",".") }}</p>
                                    <p>
                                        Status :
                                        @if ($voucher->status == 'tersedia')
                                            <span class="badge rounded-pill alert-success text-success">{{ ucwords($voucher->status) }}</span>
                                        @else
                                            <span class="badge rounded-pill alert-danger text-danger">{{ ucwords($voucher->status) }}</span>
                                        @endif

                                    </p>
                                    <p>Voucher Ditambahkan Pada : {{ date("d M Y H:i:s",strtotime($voucher->created_at)) }}</p>
                                    <p>Voucher Diedit Pada : {{ date("d M Y H:i:s",strtotime($voucher->updated_at)) }}</p>
                                    <p>Gambar Voucher : </p>
                                    <a class="example-image-link" href="{{ asset('storage/vouchers/'.$voucher->gambar_voucher) }}" data-lightbox="example-1">
                                        <img style="width: 40%;" src="{{ asset('storage/vouchers/'.$voucher->gambar_voucher) }}" alt="">
                                    </a>
                        </div>
                        <div class="col-lg-8">
                                    <h5 class="card-title">Deskripsi</h5>
                                    <p><?= $voucher->deskripsi ?></p>
                        </div>
                    </div>
                </div> <!-- card-body // -->
            </div> <!-- card end// -->

        </section>


@endsection
