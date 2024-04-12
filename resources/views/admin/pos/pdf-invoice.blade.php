<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Art Shop Cempaka Group</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <!-- Template CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

        <section class="content-main">
            <div class="mt-20">
                <div class="card-body">
                    <div class="container mb-5 mt-3">
                    <div class="row d-flex align-items-baseline">
                        <div class="col-xl-12">
                        <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>{{ $order->invoice }}</strong></p>
                        </div>
                        <hr>
                    </div>

                    <div class="container">
                        <div class="col-md-12">
                        <div class="text-center">
                            <h4 class="pt-0">Art Shop Cempaka</h4>
                        </div>

                        </div>


                        <div class="row">
                        <div class="col-xl-12">
                            <p class="text-muted">Invoice</p>
                            <ul class="list-unstyled">
                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                class="fw-bold">{{ $order->invoice }}</li>
                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                class="fw-bold">Order Date: </span>{{ date("d M Y H:i:s",strtotime($order->created_at)) }}</li>
                            <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                class="me-1 fw-bold">Status:</span><span class="badge bg-success text-black fw-bold">
                                {{ ucwords($order->status) }}</span></li>
                            </ul>
                        </div>
                        </div>

                        <div class="row my-2 mx-1 justify-content-center">
                        <table class="table table-striped table-borderless">
                            <thead style="background-color:#84B0CA ;" class="text-white">
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($order_products as $op)
                                    <tr>
                                        <td>{{ ucwords($op->product->nama_produk) }}</td>
                                        <td>Rp. {{ number_format($op->product->price,0,",",".") }}</td>
                                        <td>{{ $op->qty }}</td>
                                        <td>Rp. {{ number_format($op->total,0,",",".") }}</td>
                                    </tr>
                                @endforeach


                            </tbody>

                        </table>
                        </div>
                        <div class="row">
                        <div class="col-xl-12 mt-3">
                            <ul class="list-unstyled">
                            <li class="text-muted"><span class="text-black me-4">SubTotal</span>Rp. {{ number_format($order->total_sebelum_discount,0,",",".") }}</li>
                            @if ($order->discount == NULL)
                                <li class="text-muted mt-2"><span class="text-black me-4">Discount</span>-</li>
                            @else
                                <li class="text-muted mt-2"><span class="text-black me-4">Discount</span>Rp. {{ number_format($order->discount,0,",",".") }}</li>
                            @endif

                            </ul>
                            <p class="text-black"><span class="text-black me-3"> Total</span><span
                                style="font-size: 25px;">Rp. {{ number_format($order->total,0,",",".") }}</span></p>
                        </div>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col-xl-12">
                            <p>Thank you for your purchase</p>
                        </div>
                        </div>

                    </div>
                    </div>
                </div>
            </div>

        </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>

