<!DOCTYPE html>
<html>

<head>
    <title>Print Barcode</title>
    <style>
        body {
            text-align: center;
            margin-top: 50px;
        }

        img {
            margin: 10px auto;
            display: block;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <h2>{{ $product->nama_produk }}</h2>
    <p>SKU: {{ $product->sku }}</p>

    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($product->sku, 'EAN13') }}" alt="barcode" />

    <button onclick="window.print()">Print Barcode</button>
</body>

</html>