@extends('layouts.admin')

@section('content')

        <section class="content-main">
            <div class="content-header">
                <h2 class="content-title">Detail Pembayaran {{ $order->invoice }}</h2>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                                    <h5 class="card-title">Data Pembayaran</h5>
                                    <p>Invoice : {{ $order->invoice }}</p>
                                    <p>Nama Bank : {{ $order->nama_bank }}</p>
                                    <p>No Bank : {{ $order->no_bank }}</p>
                                    <p>Pemilik Bank : {{ ucwords($order->pemilik_bank) }}</p>
                                    <p>Total + Ongkir : Rp. {{ number_format($order->total+$order->shipping_price,0,",",".") }}</p>
                                    <p>Dibayar Pada Tanggal : {{ date("d M Y H:i:s",strtotime($order->tanggal_bayar)) }}</p>
                                    <p>Bukti Bayar : </p>
                                    <a class="example-image-link" href="{{ asset('storage/bukti_bayar/'.$order->bukti_bayar) }}" data-lightbox="example-1">
                                        <img style="width: 10%;" src="{{ asset('storage/bukti_bayar/'.$order->bukti_bayar) }}" alt="">
                                    </a><br><br>
                                    <a href="{{ route('pay-accept',$order->id) }}" onclick="return confirm('Yakin terima pembayaran?')"><button class="btn btn-primary btn-sm">Terima Pembayaran</button></a>
                                    <a onclick="openCatatanModal()"><button class="btn btn-danger btn-sm">Tolak Pembayaran</button></a>
                        </div>
                    </div>
                </div> <!-- card-body // -->
            </div> <!-- card end// -->

        </section>

                    <!-- Modal Catatan -->
                    <div class="modal fade" id="catatan-modal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                        <div class="modal-dialog d-flex justify-content-center">
                            <div class="modal-content w-75">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Catatan</h5>
                                    <a onclick="closeCatatanModal()"><i class="fas fa-times"></i></a>
                                </div>
                                <div class="modal-body p-4">
                                    <form method="POST" action="{{ route('pay-reject',$order->id) }}">
                                        @csrf
                                        @method('PUT')
                                        {{-- <input type="hidden" id="order_id" name="order_id" value=""> --}}
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="catatan">Alasan Tolak</label>
                                            <textarea name="catatan" class="form-control" id="catatan" cols="30" rows="10" required></textarea>
                                        </div>

                                        <!-- Submit button -->
                                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->

        <script>
            function openCatatanModal(){
                $('#catatan-modal').modal('show');
            }
            function closeCatatanModal(){
                $('#catatan-modal').modal('hide');
            }
        </script>

@endsection
