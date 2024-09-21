<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .badge-warning {
            color: #856404;
            background-color: #fff3cd;
            padding: 3px 7px;
            border-radius: 5px;
        }
        .badge-success {
            color: #155724;
            background-color: #d4edda;
            padding: 3px 7px;
            border-radius: 5px;
        }
        .badge-danger {
            color: #721c24;
            background-color: #f8d7da;
            padding: 3px 7px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center">Daftar Order</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kostomer</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ ucwords($order->customer->nama_lengkap) }}</td>
                    <td>{{"Rp. ". number_format($order->total,0,",",".") }}</td>
                    <td>{{ ucwords($order->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
