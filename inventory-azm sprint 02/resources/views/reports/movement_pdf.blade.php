<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pergerakan Stok</title>
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
        .type-in {
            color: #059669;
        }
        .type-out {
            color: #dc2626;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Pergerakan Stok</h2>
        <p>Tanggal: {{ now()->format('d/m/Y H:i') }}</p>
        @if($start_date || $end_date)
            <p>Periode: {{ $start_date ?? '-' }} s/d {{ $end_date ?? '-' }}</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Produk</th>
                <th>Tipe</th>
                <th>Jumlah</th>
                <th>User</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($movements as $movement)
                <tr>
                    <td>{{ $movement->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $movement->product->name }}</td>
                    <td class="{{ $movement->type === 'in' ? 'type-in' : 'type-out' }}">
                        {{ $movement->type === 'in' ? 'Masuk' : 'Keluar' }}
                    </td>
                    <td class="text-right">{{ $movement->quantity }}</td>
                    <td>{{ $movement->user->name }}</td>
                    <td>{{ $movement->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        <p><strong>Total Transaksi:</strong> {{ $movements->count() }}</p>
        <p><strong>Total Masuk:</strong> {{ $movements->where('type', 'in')->sum('quantity') }}</p>
        <p><strong>Total Keluar:</strong> {{ $movements->where('type', 'out')->sum('quantity') }}</p>
    </div>
</body>
</html> 