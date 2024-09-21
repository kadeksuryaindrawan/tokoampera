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
            <a href="{{ route('export-order', ['status' => 'all']) }}"><button class="btn btn-danger">Export PDF</button></a>
            <div class="card mb-4 mt-4">
                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <h4>Order</h4>
                                    </div>
                                    <div style="overflow-x: scroll;">
                                        <table id="zero-conf" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Invoice</th>
                                                    <th>Nama Customer</th>
                                                    <th>Total</th>
                                                    <th>Alamat</th>
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
                                                        <td>{{ ucwords($order->customer->nama_lengkap) }}</td>
                                                        <td>Rp. {{ number_format($order->total,0,",",".") }}</td>
                                                        <td><a target="_blank" href="https://www.google.com/maps?q={{ $order->lat}},{{ $order->long}}"><button class="btn btn-primary btn-sm">Lihat</button></a></td>
                                                        @if ($order->shipping_price == NULL)
                                                            <td>-</td>
                                                            <td>-</td>
                                                        @else
                                                            <td>{{ $order->shipping_courier }}</td>
                                                            <td class="text-danger">Rp. {{ number_format($order->shipping_price,0,",",".") }}</td>
                                                        @endif

                                                        <td>
                                                            @if ($order->status == 'pending' || $order->status == 'menunggu pembayaran' || $order->status == 'konfirmasi pembayaran')
                                                                <span class="badge rounded-pill alert-warning text-warning">{{ ucwords($order->status) }}</span>
                                                            @elseif ($order->status == 'terbayar' || $order->status == 'terkirim' || $order->status == 'diterima')
                                                                <span class="badge rounded-pill alert-success text-success">{{ ucwords($order->status) }}</span>
                                                            @else
                                                                <span class="badge rounded-pill alert-danger text-danger">{{ ucwords($order->status) }}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ date("d M Y H:i:s",strtotime($order->created_at)) }}</td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <button class="btn btn-sm btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <i class="icon material-icons md-menu"></i>
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                                    @if ($order->status == 'pending')
                                                                        <a onclick="openShippingModal('{{ $order->id }}')" class="dropdown-item">Input Shipping</a>
                                                                    @elseif ($order->status == 'konfirmasi pembayaran')
                                                                        <a href="{{ route('pay-detail',$order->id) }}" class="dropdown-item">Lihat Pembayaran</a>
                                                                    @elseif ($order->status == 'terbayar')
                                                                        <a onclick="openResiModal('{{ $order->id }}')" class="dropdown-item">Input No Resi</a>
                                                                    @elseif($order->status == 'terkirim')
                                                                        <a onclick="openDetailResiModal('{{ $order->resi }}')" class="dropdown-item">Lihat No Resi</a>
                                                                    @endif
                                                                    <a href="{{ route('order-detail',$order->id) }}" class="dropdown-item">Detail</a>
                                                                    <form action="{{ route('order-delete',$order->id) }}" method="post" onsubmit="return confirm('Yakin hapus order?')">
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

                    <!-- Modal Shipping -->
                    <div class="modal fade" id="shipping-modal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                        <div class="modal-dialog d-flex justify-content-center">
                            <div class="modal-content w-75">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Shipping Detail</h5>
                                    <a onclick="closeShippingModal()"><i class="fas fa-times"></i></a>
                                </div>
                                <div class="modal-body p-4">
                                    <form method="POST" action="{{ route('add-shipping') }}">
                                        @csrf

                                        <input type="hidden" id="order_id" name="order_id" value="">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="shipping_courier">Shipping Courier</label>
                                            <input type="text" name="shipping_courier" id="shipping_courier" placeholder="Input Shipping Courier..." class="form-control" required />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="shipping_price">Shipping Price</label>
                                            <input type="number" name="shipping_price" id="shipping_price" placeholder="Input Shipping Price..." class="form-control" required />
                                        </div>

                                        <!-- Submit button -->
                                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
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
                                    <h5 class="modal-title" id="exampleModalLabel1">Input No Resi</h5>
                                    <a onclick="closeResiModal()"><i class="fas fa-times"></i></a>
                                </div>
                                <div class="modal-body p-4">
                                    <form method="POST" action="{{ route('add-resi') }}">
                                        @csrf

                                        <input type="hidden" id="order_id_resi" name="order_id" value="">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="resi">No Resi</label>
                                            <input type="text" name="resi" id="resi" placeholder="Input No Resi..." class="form-control" required />
                                        </div>

                                        <!-- Submit button -->
                                        <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->

                    <!-- Modal Detail Resi -->
                    <div class="modal fade" id="detail-resi-modal" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                        <div class="modal-dialog d-flex justify-content-center">
                            <div class="modal-content w-75">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Detail No Resi</h5>
                                    <a onclick="closeDetailResiModal()"><i class="fas fa-times"></i></a>
                                </div>
                                <div class="modal-body p-4">
                                    <form>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="resi">No Resi</label>
                                            <input type="text" name="resi" id="resi_detail" class="form-control" readonly required />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->

        <script>
            function openShippingModal(orderId){
                $('#shipping-modal').modal('show');
                $('#order_id').val(orderId);
            }
            function closeShippingModal(){
                $('#shipping-modal').modal('hide');
            }
            function openResiModal(orderId){
                $('#resi-modal').modal('show');
                $('#order_id_resi').val(orderId);
            }
            function closeResiModal(){
                $('#resi-modal').modal('hide');
            }

            function openDetailResiModal(resi){
                $('#detail-resi-modal').modal('show');
                $('#resi_detail').val(resi);
            }
            function closeDetailResiModal(){
                $('#detail-resi-modal').modal('hide');
            }
        </script>

@endsection
