<!DOCTYPE html>
<html>


<head>
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            font-size: 14px;
            width: 80mm;
            margin: auto;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            vertical-align: top;
        }

        hr {
            border: none;
            border-top: 1px dashed #000;
            margin: 8px 0;
        }

        .btn {
            padding: 6px 12px;
            background: #007bff;
            color: white;
            border: none;
            margin: 5px 0;
            cursor: pointer;
        }

        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>
    <div class="text-center">
        <h4>TOKO MINIMARKET</h4>
        <p>Jl. Halteu Maleber Bojong No.05<br>Telp: 0812-3456-7890</p>
        <hr>
        <p>Invoice: {{ $orders->invoice }}<br>
            Tanggal: {{ \Carbon\Carbon::parse($orders->tanggal)->format('d-m-Y H:i') }}</p>
    </div>

    <hr>

    <table>
        @foreach($orders->details as $item)
        <tr>
            <td colspan="2"><strong>{{ $item->product->nama_produk ?? 'Produk' }}</strong></td>
        </tr>
        <tr>
            <td>{{ $item->quantity }} x {{ number_format($item->price, 0, ',', '.') }}</td>
            <td class="text-right">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </table>

    <hr>

    <table>
        <tr>
            <td>Subtotal</td>
            <td class="text-right">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
        </tr>
        @if($diskon > 0)
        <tr>
            <td>Diskon ({{ $diskon }}%)</td>
            <td class="text-right">- Rp {{ number_format($subtotal * ($diskon / 100), 0, ',', '.') }}</td>
        </tr>
        @endif
        @if($pajak > 0)
        <tr>
            <td>Pajak ({{ $pajak }}%)</td>
            <td class="text-right">Rp {{ number_format(($subtotal - $subtotal * ($diskon / 100)) * ($pajak / 100), 0, ',', '.') }}</td>
        </tr>
        @endif
        <tr>
            <td><strong>Total</strong></td>
            <td class="text-right"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
        </tr>
        <tr>
            <td>Bayar</td>
            <td class="text-right">Rp {{ number_format($bayar, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Kembalian</td>
            <td class="text-right">Rp {{ number_format($kembalian, 0, ',', '.') }}</td>
        </tr>
    </table>

    <hr>

    <p class="text-center">Terima kasih atas kunjungan Anda!</p>

    <div class="text-center">
        <button class="btn" onclick="window.print()">Cetak</button>
        <a href="{{ url('/kasir') }}" class="btn" style="background-color: #28a745;">Kembali</a>
    </div>
</body>

</html>