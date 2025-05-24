@extends('templates/header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Customer / Member
        <small>Minimarket</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Customer / Member</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    @include('templates/feedback')
    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            <a href="{{ url('customer/add') }}" class="btn btn-success">
                <i class="fa fa-fw fa-plus-circle"></i>
                Tambah
            </a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No Hp</th>
                        <th>Alamat</th>
                        <th>Tanggal Daftar</th>
                        <th>Poin</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result as $row)
                    <tr>
                        <td>{{ !empty($i) ? ++$i : $i = 1}}</td>
                        <td>
                            {{ $row->nama}}
                        </td>
                        <td>
                            {{ $row->no_hp}}
                        </td>
                        <td> {{ $row->alamat}}</td>
                        <td>{{ $row->tanggal_daftar}}</td>
                        <td>{{ $row->poin}}</td>
                        <td>{{ $row->status}}</td>
                        <td>
                            <a href="{{ url("customer/$row->id_customers/edit") }}" class="btn btn-warning">
                                <i class="fa fa-fw fa-pencil"></i>
                            </a>
                            <form method="POST" style="display: inline;" action="{{ url("customer/$row->id_customers/delete") }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn  btn-danger">
                                    <i class="fa fa-fw fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>No Hp</th>
                        <th>Alamat</th>
                        <th>Tanggal Daftar</th>
                        <th>Poin</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
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