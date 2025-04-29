@extends('templates/header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        {{ empty($result) ? 'Tambah' : 'Edit' }} Data Category            <small>SMK Negeri 1 Cianjur</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{ empty($result) ? 'Tambah' : 'Edit' }} Data Category</li>
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
            <form action="{{ empty($result) ?  url('categories/add') : url("categories/$result->id_categories/edit") }}" class="form-horizontal" method="POST">
                {{ csrf_field () }}

                @if (!empty($result))
                    {{ method_field('patch') }}
                @endif
                <div class="form-group">
                    <label class="control-label col-sm-2">Nama Category</label>
                    <div class="col-sm-10">
                        <input type="text" name="nama_categories" class="form-control" placeholder="Masukkan Nama Category" value="{{ @$result->nama_categories }}" />
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text" name="description" class="form-control" placeholder="Masukkan Description" value="{{ @$result->description}}" />
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