<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk POST Cafe</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            padding: 40px;
        }

        .receipt {
            background: white;
            width: 300px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logo {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .logo img {
            width: 80px;
            height: auto;
        }

        .store-info {
            font-size: 12px;
            margin-bottom: 10px;
        }

        .meta {
            font-size: 12px;
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .section-title {
            font-weight: bold;
            margin: 10px 0;
            font-size: 13px;
        }

        .item {
            display: flex;
            justify-content: space-between;
            margin: 4px 0;
            font-size: 13px;
        }

        .total {
            border-top: 1px dashed #aaa;
            margin: 10px 0;
            padding-top: 10px;
        }

        .thankyou {
            margin-top: 15px;
            font-size: 12px;
        }

        .thankyou hr {
            margin: 10px 0 5px;
            border: none;
            border-top: 1px dashed #aaa;
        }
    </style>
</head>

<body>
    <div class="receipt">
        <div class="logo">
            <img src="{{ asset('Admin/img/testimonial-1.jpg') }}" alt="Logo">
            <div>Caffe</div>
            <div style="font-size: 10px;">PREMIUM TASTE</div>
        </div>
        <div class="store-info">
            Mendalo Asri 123<br>
            Tlp 0823 8712 0434
        </div>
        <div class="meta">
            <div>
                Tanggal<br>
                ID Pesanan
            </div>
            <div style="text-align: right;">
                {{ date('d-m-Y', strtotime($order->created_at)) }}<br>
                {{ $order->id }}
            </div>
        </div>
        <div class="section-title">Tipe Pesanan</div>
        <div class="item"><span>Nama menu</span><span>{{ $order->product->nama }}</span></div>
        <div class="item"><span>{{ $order->jumlah . ' x ' . $order->product->harga }}
            </span><span>{{ $order->total_harga }}</span></div>
        <div class="item total"><strong>Total</strong><strong>{{ $order->total_harga }}</strong></div>
        <div class="thankyou">
            <hr>
            ----Terima kasih----<br>
            atas kunjungan anda di Cafe
        </div>
    </div>
</body>

</html>
