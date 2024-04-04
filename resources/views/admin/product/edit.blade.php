@extends('layouts.admin')

@section('content')

        <section class="content-main">
            <div class="row">
                <div class="col-12">
                    <div class="content-header">
                        <h2 class="content-title">Edit Produk</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Form Edit Produk</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('product.update',$product->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-4">
                                    <label for="category_id" class="form-label">Kategori</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" selected disabled>- Pilih Kategori -</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ ($product->category_id == $category->id) ? 'selected' : ''; }}>{{ ucfirst($category->name) }}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="nama_produk" class="form-label">Nama Produk</label>
                                            <input type="text" placeholder="Masukkan Nama Produk" name="nama_produk" value="{{ $product->nama_produk }}" class="form-control" id="nama_produk" required>
                                            @error('nama_produk')
                                                <div class="text-danger text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mb-4">
                                            <label for="price" class="form-label">Harga</label>
                                            <input type="number" placeholder="Masukkan Harga" value="{{ $product->price }}" name="price" class="form-control" id="price" required>
                                            @error('price')
                                                <div class="text-danger text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-4">
                                            <label for="status" class="form-label">Status</label>
                                            <select name="status" id="status" class="form-control" required>
                                            <option value="" selected disabled>- Pilih Status -</option>
                                            @php
                                                $status = ['active', 'deactive'];
                                            @endphp
                                            @foreach ($status as $status)
                                                <option value="{{ $status }}" {{ ($product->status == $status) ? 'selected' : ''; }}>{{ ucfirst($status) }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-4">
                                            <label for="stok" class="form-label">Stok</label>
                                            <input type="number" placeholder="Masukkan Stok" name="stok" value="{{ $product->stok }}" class="form-control" id="stok" required>
                                            @error('stok')
                                                <div class="text-danger text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-4">
                                            <label for="rated" class="form-label">Rated</label>
                                            <input type="text" placeholder="Masukkan Rated" name="rated" class="form-control" value="{{ $product->rated }}" id="rated" required>
                                            @error('rated')
                                                <div class="text-danger text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="img" class="form-label">Img</label>
                                    <input type="file" name="img" class="form-control" id="img">
                                    @error('img')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10" required>{{ $product->deskripsi }}</textarea>
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
