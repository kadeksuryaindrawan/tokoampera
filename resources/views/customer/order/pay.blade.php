@extends('layouts.customer')

@section('content')

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow">Home</a>
                    <span></span> Order
                    <span></span> Pay Order
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="row">
                <div class="col-12">
                    <a href="{{ url('/order-lists') }}"><button class="btn btn-primary btn-sm">Kembali</button></a>
                    <div class="content-header mt-40">
                        <h2 class="content-title">{{ __('content.pay') }} Order</h2>
                        <p class="p mt-2">{{ __('content.tf_to') }} <strong class="text-danger">9849839483</strong> Surya Indrawan total : <strong class="text-danger">Rp. {{ number_format($order->total+$order->shipping_price,0,",",".") }}</strong></p>
                    </div>
                </div>
                <div class="col-lg-12 mt-50">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Form</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('pay-process',$order->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="nama_bank" class="form-label">Bank </label>
                                            <input type="text" placeholder="Bank..." name="nama_bank" class="form-control" id="nama_bank" required>
                                            @error('nama_bank')
                                                <div class="text-danger text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="no_bank" class="form-label">No Bank</label>
                                            <input type="number" placeholder="No Bank..." name="no_bank" class="form-control" id="no_bank" required>
                                            @error('no_bank')
                                                <div class="text-danger text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="pemilik_bank" class="form-label">{{ __('content.bank_owner') }}</label>
                                            <input type="text" placeholder="{{ __('content.bank_owner') }}..." name="pemilik_bank" class="form-control" id="pemilik_bank" required>
                                            @error('pemilik_bank')
                                                <div class="text-danger text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="bukti_bayar" class="form-label">{{ __('content.payment_proof') }}</label>
                                            <input type="file" placeholder="{{ __('content.payment_proof') }}..." name="bukti_bayar" class="form-control" id="bukti_bayar" required>
                                            @error('bukti_bayar')
                                                <div class="text-danger text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 mt-30">
                                    <button class="btn btn-primary" type="submit">{{ __('content.pay') }}</button>
                                </div>
                            </form>
                        </div>
                    </div> <!-- card end// -->
                </div>

            </div>
                </div>
            </div>
        </section>
    </main>

@endsection
