<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stok</title>
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
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Stok</h2>
        <p>Tanggal: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Produk</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Total Masuk</th>
                <th>Total Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stocks as $stock)
                <tr>
                    <td>{{ $stock->code }}</td>
                    <td>{{ $stock->name }}</td>
                    <td>{{ $stock->category->name }}</td>
                    <td class="text-right">{{ $stock->stock->quantity }}</td>
                    <td class="text-right">{{ $stock->total_in }}</td>
                    <td class="text-right">{{ $stock->total_out }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        <p><strong>Total Produk:</strong> {{ $stocks->count() }}</p>
        <p><strong>Total Stok:</strong> {{ $stocks->sum('stock.quantity') }}</p>
    </div>
</body>
</html> 