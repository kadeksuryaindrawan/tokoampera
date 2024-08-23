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
    <h2 style="text-align: center">Daftar Semua Produk</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp
            @foreach ($products as $product)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ ucwords($product->nama_produk) }}</td>
                    <td>{{ ucwords($product->category->name) }}</td>
                    <td>Rp. {{ number_format($product->price,0,",",".") }}</td>
                    <td>{{ $product->stok }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
