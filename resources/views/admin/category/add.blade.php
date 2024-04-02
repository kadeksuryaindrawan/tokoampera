@extends('layouts.admin')

@section('content')

        <section class="content-main">
            <div class="row">
                <div class="col-12">
                    <div class="content-header">
                        <h2 class="content-title">Tambah Kategori</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Form Tambah Kategori</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label for="name" class="form-label">Nama Kategori</label>
                                    <input type="text" placeholder="Masukkan Nama Kategori" name="name" class="form-control" id="name">
                                    @error('name')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div> <!-- card end// -->
                </div>

            </div>
        </section> <!-- content-main end// -->


@endsection
