@extends('templates/header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Details Orders
        <small>Minimarket</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Detail Orders</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    @include('templates/feedback')
    <!-- Default box -->
    <div class="box">
        <div class="box-header">

        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Id Order</th>
                        <th>Nama Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detail as $row)
                    <tr>
                        <td>{{ !empty($i) ? ++$i : $i = 1}}</td>
                        <td>
                            {{ $row->id_order}}
                        </td>
                        <td>
                            {{ $row->product->nama_produk}}
                        </td>
                        <td> {{ $row->quantity}}</td>
                        <td>{{ $row->price}}</td>
                        <td>
                            <a href="{{ url("order/$row->id_order/edit") }}" class="btn btn-warning">
                                <i class="fa fa-fw fa-pencil"></i>
                            </a>
                            <form method="POST" style="display: inline;" action="{{ url("detail/$row->id_order_detail/delete") }}">
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
                        <th>Id Order</th>
                        <th>Nama Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
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