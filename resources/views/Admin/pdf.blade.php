<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        .info {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        table th {
            background: #f2f2f2;
        }

        .summary {
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <h2>LAPORAN PENJUALAN</h2>
    <div class="info">
        @if ($tanggalAwal && $tanggalAkhir)
            Periode: {{ date('d m Y', strtotime($tanggalAwal)) }} s/d {{ date('d m Y', strtotime($tanggalAkhir)) }}
        @else
            Semua Data
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pembeli</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>{{ $order->product->nama }}</td>
                    <td>{{ $order->jumlah }}</td>
                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <p><strong>Total Order:</strong> {{ $totalOrder }}</p>
        <p><strong>Total Pendapatan:</strong> Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
    </div>

</body>

</html>
