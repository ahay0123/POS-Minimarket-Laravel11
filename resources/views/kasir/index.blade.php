@extends('templates/header')

@section('content')
<!-- Content Header (Page header) -->
<style>
    .img-square-wrapper {
        width: 100%;
        padding-top: 100%;
        /* membuat rasio 1:1 */
        position: relative;
        overflow: hidden;
        background: #fff;
    }

    .img-square-wrapper img.img-square {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: contain;
        /* atau 'cover' jika ingin gambar penuh */
        background-color: #f5f5f5;
    }

    .btn-group {
        display: flex;
        justify-content: space-between;
        /* Membuat tombol tersebar rata */
        width: 100%;
        /* Menyesuaikan lebar agar tombol penuh */
    }
</style>
<section class="content-header">
    <h1>
        Orders
        <small>Minimarket</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> Orders </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    @include('templates/feedback')
    <!-- Default box -->
    <div class="box">
        <div class="box-header">


            <div class="form-group row mt-2">
                <form action="{{ url('keranjang/add-by-barcode') }}" method="POST" class="form-inline">
                    @csrf
                    <div class="form-group ">
                        <div class="col-sm-10">
                            <input type="text" name="sku" class="form-control" placeholder="Scan barcode di sini..." autofocus>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-fw fa-plus-circle"></i>
                        Confirm SKU
                    </button>

                </form>
                <div class="col-sm-10">
                    <!-- Tombol untuk membuka modal scan -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#scanModal">
                        <i class="fa fa-fw fa-camera"></i> Scan with Camera
                    </button>

                </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="row">
            <!-- Kolom Kiri: Daftar Produk -->
            <div class="col-md-8">
                <div class="box-body">
                    @foreach($result->chunk(4) as $chunk)
                    <div class="row">
                        @foreach($chunk as $product)
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                                <div class="img-square-wrapper">
                                    <img src="{{ asset('uploads/' . @$product->foto) }}" alt="Produk" class="img-square img-responsive">
                                </div>
                                <div class="caption text-center">
                                    <h4>{{ $product->nama_produk }}</h4>
                                    <p>{{ $product->description }}</p>
                                    <p><strong>Rp {{ number_format($product->price, 0, ',', '.') }}</strong></p>
                                    <p><i>Stock : {{ $product->stock }}</i></p>
                                    <div>
                                        <form action="{{ url('keranjang/add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                                            <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Kolom Kanan: Panel Transaksi -->
            <div class="col-md-4">
                <div class="panel panel-default" style="padding: 15px;">
                    <div class="panel-heading">
                        <strong><i class="glyphicon glyphicon-user"></i> Customer</strong>
                        <div class="pull-right">
                            <form action="{{ url('kasir/cek-member') }}" method="POST" class="mb-3">
                                @csrf
                                <input type="text" name="no_hp" placeholder="Masukkan No HP Member" class="form-control mb-2" required value="{{ session('no_hp') }}">
                                <button type="submit" class="btn btn-primary btn-block">Cek Member</button>
                            </form>

                            @if(session('diskon'))
                            <div class="alert alert-success">Diskon {{ session('diskon') }}% telah diterapkan</div>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-body">
                        @php
                        $keranjang = session('keranjang', []);
                        @endphp
                        @foreach($keranjang as $id => $item)
                        <div class="cart-item">
                            <strong>{{ $item['nama_produk'] }}</strong><br>
                            <small>Rp. {{ number_format($item['harga'], 0, ',', '.') }} &nbsp;&nbsp; Stok: {{ $item['stok'] }}</small>

                            <div class="row" style="margin-top: 5px;">
                                <div class="col-xs-7">
                                    <div class="form-inline">
                                        <div class="form-group">
                                            <form action="{{ url('keranjang/kurang/'.$id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">-</button>
                                            </form>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control input-sm text-center" value="{{ $item['jumlah'] }}" style="width: 50px;">
                                        </div>
                                        <div class="form-group">
                                            <form action="{{ url('keranjang/tambah/'.$id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">+</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-5 text-right">
                                    <strong>Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}</strong>
                                </div>
                            </div>
                            <hr>
                        </div>
                        @endforeach
                        <form action="{{ url('keranjang/hapus-semua') }}" method="POST" onsubmit="return confirm('Yakin hapus semua keranjang?');">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Hapus Semua</button>
                        </form>
                        <hr>

                    </div>

                    @php
                    $keranjang = session('keranjang', []);
                    $subtotal = 0;
                    foreach ($keranjang as $item) {
                    $subtotal += $item['harga'] * $item['jumlah'];
                    }
                    $pajakPersen = 2;
                    $pajak = $subtotal * ($pajakPersen / 100);
                    $total = $subtotal + $pajak;
                    @endphp

                    <input type="hidden" id="subtotal" value="{{ $subtotal }}">
                    <input type="hidden" id="pajakPersen" value="{{ $pajakPersen }}">

                    <p><strong>Sub Total:</strong> <span class="pull-right" id="subtotalText">Rp {{ number_format($subtotal, 0, ',', '.') }}</span></p>
                    <p>Pajak (<span id="pajakLabel">{{ $pajakPersen }}</span>%): <span class="pull-right" id="pajakText">Rp {{ number_format($pajak, 0, ',', '.') }}</span></p>
                    <hr>

                    <hr>
                    <h4><strong>Total:</strong> <span class="pull-right text-purple" id="totalText">Rp {{ number_format($total, 0, ',', '.') }}</span></h4>
                    <form action="{{ url('/transaksi/store') }}" method="POST" id="formBayar">
                        @csrf
                        <h4><strong>Bayar:</strong>
                            <span class="pull-right text-purple">
                                <input type="number" id="bayar" oninput="hitungKembalian()" style="width: 160px;" require>
                            </span>
                        </h4>

                        <h4><strong>Kembalian:</strong>
                            <span class="pull-right text-purple" id="kembalianFormatted">Rp 0</span>
                        </h4>
                        <input type="hidden" id="diskonPersen" value="{{ session('diskon', 0) }}">



                </div>

                <div class="panel-footer text-center">

                    <input type="hidden" name="paid_amount" id="inputBayar">
                    <input type="hidden" name="return_amount" id="inputKembalian">
                    <input type="hidden" name="no_hp" value="{{ session('no_hp') }}">
                    <button type="submit" class="btn btn-success btn-lg btn-block">
                        <strong id="bayarButtonText">Bayar Rp ...</strong>
                    </button>
                    </form>

                    <script>
                        function formatRupiah(angka) {
                            return angka.toLocaleString('id-ID', {
                                style: 'currency',
                                currency: 'IDR',
                                minimumFractionDigits: 0
                            });
                        }

                        function hitungTotal() {
                            const subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
                            const pajakPersen = parseFloat(document.getElementById('pajakPersen').value) || 0;
                            const diskonPersen = parseFloat(document.getElementById('diskonPersen').value) || 0;

                            const diskon = subtotal * (diskonPersen / 100);
                            const subtotalSetelahDiskon = subtotal - diskon;
                            const pajak = subtotalSetelahDiskon * (pajakPersen / 100);
                            const total = subtotalSetelahDiskon + pajak;

                            document.getElementById('subtotalText').textContent = formatRupiah(subtotal);
                            document.getElementById('pajakText').textContent = formatRupiah(pajak);
                            document.getElementById('totalText').textContent = formatRupiah(total);
                            document.getElementById('bayarButtonText').textContent = 'Bayar ' + formatRupiah(total);

                            return total;
                        }

                        function hitungKembalian() {
                            const bayar = parseInt(document.getElementById('bayar').value) || 0;
                            const total = hitungTotal();
                            const kembalian = bayar - total;

                            document.getElementById('kembalianFormatted').textContent = formatRupiah(kembalian >= 0 ? kembalian : 0);
                            document.getElementById('inputKembalian').value = kembalian >= 0 ? kembalian : 0;
                        }

                        document.addEventListener('DOMContentLoaded', function() {
                            hitungTotal();
                        });

                        document.getElementById('formBayar').addEventListener('submit', function(e) {
                            const bayar = parseInt(document.getElementById('bayar').value);

                            if (isNaN(bayar) || bayar <= 0) {
                                alert('Silakan isi nominal bayar terlebih dahulu.');
                                e.preventDefault(); // Batalkan submit
                                return;
                            }

                            document.getElementById('inputBayar').value = bayar;
                            hitungKembalian(); // pastikan inputKembalian juga diisi
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>

    <!-- /.box-body -->
    <div class="box-footer">
        Footer
    </div>
    <!-- /.box-footer-->

</section>
<!-- /.content -->

@endsection