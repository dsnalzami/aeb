<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stok Menipis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .warning {
            color: #dc2626;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Stok Menipis</h2>
        <p>Tanggal: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    @if($lowStocks->isEmpty())
        <p>Tidak ada produk dengan stok menipis</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Stok Saat Ini</th>
                    <th>Minimum Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lowStocks as $product)
                    <tr>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td class="warning">{{ $product->stock->quantity }}</td>
                        <td>{{ $product->stock->minimum_stock }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html> 