@extends('layouts.customer')

@section('content')

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{ url('/') }}" rel="nofollow">Home</a>
                    <span></span> Order
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
                        <a href="{{ url('/order-history') }}"><button class="btn btn-sm btn-primary">History {{ __('navbar.order') }} </button></a>
                            <div class="card mb-4 mt-40">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4>{{ __('navbar.order') }}</h4>
                                    </div>
                                    <div style="overflow-x: scroll;">
                                        <table id="zero-conf" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Invoice</th>
                                                    <th>Total</th>
                                                    <th>Kurir</th>
                                                    <th>Ongkir</th>
                                                    <th>Status</th>
                                                    <th>Tanggal Checkout</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $no=1;
                                                @endphp
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $order->invoice }}</td>
                                                        <td>Rp. {{ number_format($order->total,0,",",".") }}</td>
                                                        @if ($order->shipping_price == NULL)
                                                            <td>-</td>
                                                            <td>-</td>
                                                        @else
                                                            <td>{{ $order->shipping_courier }}</td>
                                                            <td class="text-danger">Rp. {{ number_format($order->shipping_price,0,",",".") }}</td>
                                                        @endif

                                                        <td>
                                                            @if ($order->status == 'pending' || $order->status == 'menunggu pembayaran')
                                                                <span class="badge rounded-pill alert-warning text-warning">{{ ucwords($order->status) }}</span>
                                                            @elseif ($order->status == 'terbayar' || $order->status == 'terkirim' || $order->status == 'diterima')
                                                                <span class="badge rounded-pill alert-success text-success">{{ ucwords($order->status) }}</span>
                                                            @elseif ($order->status == 'konfirmasi pembayaran')
                                                                <span class="badge rounded-pill alert-warning text-warning">Menunggu Konfirmasi</span>
                                                            @else
                                                                <span class="badge rounded-pill alert-danger text-danger">{{ ucwords($order->status) }}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ date("d M Y H:i:s",strtotime($order->created_at)) }}</td>
                                                        <td class="d-flex justify-content-center">
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                    @if ($order->status == 'menunggu pembayaran')
                                                                        <a href="{{ route('pay',$order->id) }}" class="dropdown-item">Bayar</a>
                                                                    @elseif ($order->status == 'ditolak')
                                                                        <a onclick="openRejectDetailModal('{{ $order->catatan }}')" class="dropdown-item">Lihat Catatan Penolakan</a>
                                                                    @elseif ($order->status == 'terkirim')
                                                                        <a onclick="openResiModal('{{ $order->resi }}')" class="dropdown-item">Lihat No Resi</a>
                                                                    @endif
                                                                    <a href="{{ route('order-detail',$order->id) }}" class="dropdown-item">Detail</a>
                                                                </div>
                                                            </div>
                                                            @if ($order->status == 'terkirim')
                                                                <a href="{{ route('order-acc',$order->id) }}"><button class="ml-20 btn btn-success btn-sm">Terima Pesanan</button></a>
                                                            @endif
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

                    <!-- Modal Reject Detail -->
                    <div class="modal fade" id="reject-detail-modal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                        <div class="modal-dialog d-flex justify-content-center">
                            <div class="modal-content w-75">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Catatan Penolakan</h5>
                                    <a onclick="closeRejectDetailModal()"><i class="fas fa-times"></i></a>
                                </div>
                                <div class="modal-body p-4">
                                    <form>
                                        {{-- <input type="hidden" id="order_id" name="order_id" value=""> --}}
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="catatan">Alasan Tolak</label>
                                            <textarea name="catatan" class="form-control" id="catatan" cols="30" rows="10" readonly></textarea>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->

                    <!-- Modal Resi -->
                    <div class="modal fade" id="resi-modal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                        <div class="modal-dialog d-flex justify-content-center">
                            <div class="modal-content w-75">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Detail No Resi</h5>
                                    <a onclick="closeResiModal()"><i class="fas fa-times"></i></a>
                                </div>
                                <div class="modal-body p-4">
                                    <form>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="resi">No Resi</label>
                                            <input type="text" name="resi" id="resi" class="form-control" readonly required />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->

    <script>
        function validateNumberInput() {
            var input = document.getElementById("myNumberInput");
            if (input.value < 1) {
                input.value = 1;
            }
        }

        function openRejectDetailModal(catatan){
            $('#reject-detail-modal').modal('show');
            $('#catatan').text(catatan);
        }
        function closeRejectDetailModal(){
            $('#reject-detail-modal').modal('hide');
        }

        function openResiModal(resi){
            $('#resi-modal').modal('show');
            $('#resi').val(resi);
        }
        function closeResiModal(){
            $('#resi-modal').modal('hide');
        }
    </script>

@endsection
