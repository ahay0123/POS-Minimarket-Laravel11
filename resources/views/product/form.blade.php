@extends('templates/header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ empty($result) ? 'Tambah' : 'Edit' }} Data Product <small>Minimarket</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{ empty($result) ? 'Tambah' : 'Edit' }} Data Product</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    @include('templates/feedback')
    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            <a href="{{ url('/') }}" class="btn btn-success">
                <i class="fa fa-chevron-left"></i>
                Kembali
            </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form action="{{ empty($result) ?  url('product/add') : url("product/$result->id_product/edit") }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                {{ csrf_field () }}

                @if (!empty($result))
                {{ method_field('patch') }}
                @endif
                <div class="form-group">
                    <label class="control-label col-sm-2">Nama Product</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_produk" class="form-control" placeholder="Masukkan Nama Product" value="{{ @$result->nama_produk }}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text" name="description" class="form-control" placeholder="Masukkan Description" value="{{ @$result->description}}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Stock</label>
                    <div class="col-sm-10">
                        <input type="text" name="stock" class="form-control" placeholder="Masukkan Jumlah Stock" value="{{ @$result->stock}}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Price</label>
                    <div class="col-sm-10">
                        <input type="text" name="price" class="form-control" placeholder="Masukkan Price" value="{{ @$result->price}}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Category</label>
                    <div class="col-sm-10">
                        <select name="id_categories" class="form-control">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach (\App\Models\Category::all() as $category)
                            <option value="{{ $category->id_categories }}" {{@$result->id_categories == $category->id_categories ? 'selected' : '' }}>{{ $category->nama_categories }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">SKU</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="sku" id="sku" placeholder="Masukkan nama SKU" value="{{ @$result->sku }}" />

                        <!-- Tombol Scan -->
                        <button type="button" class="btn btn-default" onclick="startScanner()" style="margin-top:10px;">
                            <i class="fa fa-camera"></i> Scan Barcode
                        </button>

                        <!-- Tempat tampilkan scanner -->
                        <div id="reader" style="width:300px; max-width:100%; margin-top:15px; display: none;"></div>
                    </div>
                </div>

                @if(!empty($result->sku))
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <a href="{{ url('product/' . $result->id_product . '/print-barcode') }}" target="_blank" class="btn btn-default">
                            <i class="fa fa-print"></i> Print Barcode
                        </a>
                        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($result->sku, 'C128') }}" alt="barcode" />
                    </div>
                </div>
                @endif


                <div class="form-group">
                    <label class="control-label col-sm-2">Foto</label>
                    <div class="col-sm-10">
                        <input type="file" name="foto" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <button type="submit" class="btn btn-primary"> <i class="fa fa-save"></i>
                            Simpan
                        </button>
                    </div>
                </div>




            </form>
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

<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
<script>
    let html5QrcodeScanner;
    let isScannerRunning = false;

    function startScanner() {
        const reader = document.getElementById('reader');

        if (isScannerRunning) return; // Jangan buka scanner 2x
        reader.style.display = 'block';

        if (!html5QrcodeScanner) {
            html5QrcodeScanner = new Html5Qrcode("reader");
        }

        const config = {
            fps: 10,
            qrbox: 250, // square, cukup fleksibel untuk barcode dan QR
            formatsToSupport: [
                Html5QrcodeSupportedFormats.EAN_13,
                Html5QrcodeSupportedFormats.CODE_128,
                Html5QrcodeSupportedFormats.CODE_39
            ]
        };

        html5QrcodeScanner.start({
                facingMode: "environment"
            },
            config,
            (decodedText, decodedResult) => {
                document.getElementById('sku').value = decodedText;
                html5QrcodeScanner.stop().then(() => {
                    isScannerRunning = false;
                    reader.style.display = 'none';
                }).catch(err => console.error("Stop error", err));
            },
            (errorMessage) => {
                // Tidak perlu tampilkan error tiap frame
            }
        ).then(() => {
            isScannerRunning = true;
        }).catch(err => {
            console.error("Start camera error", err);
        });
    }
</script>
@endsection