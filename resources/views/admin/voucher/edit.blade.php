@extends('layouts.admin')

@section('content')

        <section class="content-main">
            <div class="row">
                <div class="col-12">
                    <div class="content-header">
                        <h2 class="content-title">Edit Voucher</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Form Edit Voucher</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('voucher.update',$voucher->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="nama" class="form-label">Nama Voucher</label>
                                            <input type="text" placeholder="Masukkan Nama Voucher" name="nama" value="{{ $voucher->nama }}" class="form-control" id="nama" required>
                                            @error('nama')
                                                <div class="text-danger text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="nominal" class="form-label">Nominal</label>
                                            <input type="number" placeholder="Masukkan Nominal" value="{{ $voucher->nominal }}" name="nominal" class="form-control" id="nominal" required>
                                            @error('nominal')
                                                <div class="text-danger text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                        <div class="mb-4">
                                            <label for="status" class="form-label">Status</label>
                                            <select name="status" id="status" class="form-control" required>
                                            <option value="" selected disabled>- Pilih Status -</option>
                                            @php
                                                $status = ['tersedia', 'tidak tersedia'];
                                            @endphp
                                            @foreach ($status as $status)
                                                <option value="{{ $status }}" {{ ($voucher->status == $status) ? 'selected' : ''; }}>{{ ucfirst($status) }}</option>
                                            @endforeach
                                            </select>
                                        </div>

                                <div class="mb-4">
                                    <label for="gambar_voucher" class="form-label">Gambar Voucher</label>
                                    <input type="file" name="gambar_voucher" class="form-control" id="gambar_voucher">
                                    @error('gambar_voucher')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10" required>{{ $voucher->deskripsi }}</textarea>
                                    @error('deskripsi')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <button class="btn btn-primary" type="submit">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div> <!-- card end// -->
                </div>

            </div>
        </section> <!-- content-main end// -->


@endsection
