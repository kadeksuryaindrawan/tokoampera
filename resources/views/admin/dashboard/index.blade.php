@extends('layouts.admin')

@section('content')
        <section class="content-main">
            <div class="content-header">
                <div>
                    <h2 class="content-title card-title">Dashboard </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <div class="text">
                                <h6 class="mb-1 card-title">Jumlah Kategori</h6>
                                <span>{{ $category_count }}</span>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <div class="text">
                                <h6 class="mb-1 card-title">Jumlah Produk</h6>
                                <span>{{ $product_count }}</span>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <div class="text">
                                <h6 class="mb-1 card-title">Jumlah Voucher</h6>
                                <span>{{ $voucher_count }}</span>
                            </div>
                        </article>
                    </div>
                </div>
                {{-- <div class="col-lg-3">
                    <div class="card card-body mb-4">
                        <article class="icontext">
                            <div class="text">
                                <h6 class="mb-1 card-title">Jumlah Blog</h6>
                                <span>{{ $blog_count }}</span>
                            </div>
                        </article>
                    </div>
                </div> --}}
            </div>

            <livewire:year-sort :year="$year"/>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h4>Latest Order</h4>
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
                </div>
            </div>

        </section> <!-- content-main end// -->

    <script type="text/javascript">
        (function ($) {
            "use strict";

            /*Sale statistics Chart*/
            let chart;
            if ($('#myChart').length) {
                var ctx = document.getElementById('myChart').getContext('2d');
                chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                        datasets: [

                            {
                                label: 'Penjualan',
                                tension: 0.3,
                                fill: true,
                                backgroundColor: 'rgba(4, 209, 130, 0.6)',
                                borderColor: 'rgb(4, 209, 130)',
                                data: [{{ $januari }}, {{ $februari }}, {{ $maret }}, {{ $april }}, {{ $mei }}, {{ $juni }}, {{ $juli }}, {{ $agustus }}, {{ $september }}, {{ $oktober }}, {{ $november }}, {{ $desember }}]
                            }

                        ]
                    },
                    options: {
                        plugins: {
                        legend: {
                            labels: {
                            usePointStyle: true,
                            },
                        }
                        }
                    }
                });


            } //End if

            document.addEventListener('livewire:load', function () {
                    Livewire.hook('message.processed', (message, component) => {
                        const updateChartEvent = message.response.effects.dispatches.find(event => event.event === 'updateChart');

                        if (updateChartEvent) {
                            //console.log(updateChartEvent.data.april);
                            chart.destroy();
                            if ($('#myChart').length) {
                                var ctx = document.getElementById('myChart').getContext('2d');
                                chart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                                        datasets: [

                                            {
                                                label: 'Penjualan',
                                                tension: 0.3,
                                                fill: true,
                                                backgroundColor: 'rgba(4, 209, 130, 0.6)',
                                                borderColor: 'rgb(4, 209, 130)',
                                                data: [updateChartEvent.data.januari,updateChartEvent.data.februari,updateChartEvent.data.maret,updateChartEvent.data.april,updateChartEvent.data.mei,updateChartEvent.data.juni,updateChartEvent.data.juli,updateChartEvent.data.agustus,updateChartEvent.data.september,updateChartEvent.data.oktober,updateChartEvent.data.november,updateChartEvent.data.desember]
                                            }

                                        ]
                                    },
                                    options: {
                                        plugins: {
                                        legend: {
                                            labels: {
                                            usePointStyle: true,
                                            },
                                        }
                                        }
                                    }
                                });


                            } //End if
                        }
                    });
                });



        })(jQuery);



    </script>

@endsection

