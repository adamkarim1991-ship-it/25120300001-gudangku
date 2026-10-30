<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Laporan Transaksi Gudangku</h2>
    <p>Tanggal Cetak: {{ date('d-m-Y H:i') }}</p>
    <table>
        <thead><tr><th>No</th><th>Tanggal</th><th>Produk</th><th>Tipe</th><th>Jumlah</th></tr></thead>
        <tbody>
            @foreach($transactions as $trx)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $trx->created_at->format('d M Y - H:i') }}</td>
                <td>{{ $trx->product->name }}</td>
                <td>{{ $trx->type == 'in' ? 'Masuk' : 'Keluar' }}</td>
                <td>{{ $trx->quantity }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>