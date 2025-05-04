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
            <a href="{{ url('product/add') }}" class="btn btn-success">
                <i class="fa fa-fw fa-plus-circle"></i>
                Tambah
            </a>
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
                                    <p>
                                    <form action="{{ url('keranjang/add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_product" value="{{ $product->id_product }}">
                                        <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                                    </form>
                                    </p>
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
                        <strong><i class="glyphicon glyphicon-user"></i> Umum</strong>
                        <div class="pull-right">
                            <select class="form-control input-sm" style="display: inline-block; width: auto;">
                                <option>Agus Prawoto Hadi</option>
                            </select>
                            <input type="date" class="form-control input-sm" style="display: inline-block; width: auto;">
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


                    <p><strong>Sub Total:</strong> <span class=" pull-right">Rp 152.700</span></p>
                    <p>Diskon (5%) <span class="pull-right">Rp -7.635</span></p>
                    <p>Penyesuaian <span class="pull-right">Rp 0</span></p>
                    <p>Pajak (11%) <span class="pull-right">Rp 15.957</span></p>
                    <hr>
                    <h4><strong>Total:</strong> <span class="pull-right text-purple">Rp 161.022</span></h4>
                </div>

                <div class="panel-footer text-center">
                    <button class="btn btn-success btn-lg btn-block"><strong>Bayar Rp 161.022</strong></button>
                </div>
            </div>
        </div>
    </div>

    <!-- /.box-body -->
    <div class="box-footer">
        Footer
    </div>
    <!-- /.box-footer-->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
@endsection