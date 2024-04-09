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
                    <div class="row">
                <div class="col-12">
                    <div class="content-header">
                        <h2 class="content-title">Tambah Alamat</h2>
                    </div>
                </div>
                <div class="col-lg-12 mt-50">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4>Form Tambah Alamat</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('customer-address.store') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="nama_alamat" class="form-label">Nama Alamat</label>
                                            <input type="text" placeholder="Masukkan Nama Alamat" name="nama_alamat" class="form-control" id="nama_alamat" required>
                                            @error('nama_alamat')
                                                <div class="text-danger text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="alamat" class="form-label">Alamat</label>
                                            <textarea class="form-control" name="alamat" id="alamat" cols="300" rows="100" required></textarea>
                                            @error('alamat')
                                                <div class="text-danger text-sm">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="" class="form-control-label">Lat</label>
                                        <input type="text" name="lat" id="latitude" required class="form form-control mb-3" readonly>
                                    </div>
                                    <div class="col-lg-6">
                                        <label for="" class="form-control-label">Long</label>
                                        <input type="text" name="long" id="longitude" required class="form form-control mb-3" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-5">
                                        <div id="map" style="width: 100%;height: 500px;border-radius: 10px;"></div>
                                    </div>
                                </div>

                                <div class="mb-4 mt-50">
                                    <button class="btn btn-primary" type="submit">Simpan</button>
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

    <script>

    let mapOptions = {
        center:[-8.6644936, 115.1533424],
        zoom:10
    }

    let map = new L.map('map' , mapOptions);

    let layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
    map.addLayer(layer);


    let marker = null;
    map.on('click', (event)=> {

        if(marker !== null){
            map.removeLayer(marker);
        }

        marker = L.marker([event.latlng.lat , event.latlng.lng]).addTo(map);

        document.getElementById('latitude').value = event.latlng.lat;
        document.getElementById('longitude').value = event.latlng.lng;

    })
    </script>

@endsection
