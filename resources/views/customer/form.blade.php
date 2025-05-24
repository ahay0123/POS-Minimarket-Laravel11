@extends('templates/header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ empty($result) ? 'Tambah' : 'Edit' }} Data Customers <small>Minimarket</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{ empty($result) ? 'Tambah' : 'Edit' }} Data Customers</li>
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
            <form action="{{ empty($result) ?  url('customer/add') : url("customer/$result->id_customers/edit") }}" class="form-horizontal" method="POST">
                {{ csrf_field () }}

                @if (!empty($result))
                {{ method_field('patch') }}
                @endif
                <div class="form-group">
                    <label class="control-label col-sm-2">Nama Customer</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Customer" value="{{ @$result->nama }}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">No Hp</label>
                    <div class="col-sm-10">
                        <input type="text" name="no_hp" class="form-control" placeholder="Masukkan No Hp " value="{{ @$result->no_hp}}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Alamat</label>
                    <div class="col-sm-10">
                        <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat" value="{{ @$result->alamat}}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Tanggal Daftar</label>
                    <div class="col-sm-10">
                        <input type="date" name="tanggal_daftar" class="form-control" placeholder="Masukkan Tanggal Daftar" value="{{ @$result->tanggal_daftar}}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Poin</label>
                    <div class="col-sm-10">
                        <input type="number" name="poin" class="form-control" placeholder="Masukkan Poin" value="{{ @$result->poin}}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Status</label>
                    <div class="col-sm-10">
                        <select name="status" class="form-control">
                            <option value="">-- Pilih Status --</option>
                            <option value="nonaktif" >Non-Aktif</option>
                            <option value="aktif" >Aktif</option>
                        </select>
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
@endsection

@extends('templates/header')

@section('content')
<section class="content-header">
    <h1>Form Tambah Customer</h1>
</section>

<section class="content">
    <form action="{{ url('customers') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="form-group">
            <label>No HP</label>
            <input type="text" name="no_hp" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label>Tanggal Daftar</label>
            <input type="date" name="tanggal_daftar" class="form-control">
        </div>

        <div class="form-group">
            <label>Poin</label>
            <input type="number" name="poin" class="form-control" value="0" required>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="aktif">Aktif</option>
                <option value="non-aktif">Non-Aktif</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</section>
@endsection