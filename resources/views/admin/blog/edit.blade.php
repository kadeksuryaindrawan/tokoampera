@extends('layouts.admin')

@section('content')

        <section class="content-main">
            <div class="row">
                <div class="col-12">
                    <div class="content-header">
                        <h2 class="content-title">Tambah Blog</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Form Edit Blog</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('blog.update',$blog->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                        <div class="mb-4">
                                            <label for="judul" class="form-label">Judul</label>
                                            <input type="text" placeholder="Masukkan Judul" name="judul" value="{{ $blog->judul }}" class="form-control" id="judul" required>
                                            @error('judul')
                                                <div class="text-danger text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label for="status" class="form-label">Status</label>
                                            <select name="status" id="status" class="form-control" required>
                                            <option value="" selected disabled>- Pilih Status -</option>
                                            @php
                                                $status = ['tampil', 'tidak tampil'];
                                            @endphp
                                            @foreach ($status as $status)
                                                <option value="{{ $status }}" {{ ($blog->status == $status) ? 'selected' : ''; }}>{{ ucfirst($status) }}</option>
                                            @endforeach
                                            </select>
                                        </div>

                                <div class="mb-4">
                                    <label for="gambar" class="form-label">Gambar</label>
                                    <input type="file" name="gambar" class="form-control" id="gambar">
                                    @error('gambar')
                                        <div class="text-danger text-sm">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10" required>{{ $blog->deskripsi }}</textarea>
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
