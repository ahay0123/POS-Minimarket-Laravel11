@extends('templates/header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Orders
        <small>Minimarket</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Orders</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    @include('templates/feedback')
    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            <form action="{{ route('order.export') }}" method="GET" >
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-download"></i> Download Excel
                </button>
            </form>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>User</th>
                        <th>Total</th>
                        <th>Tanggal Order</th>
                        <th>Customer</th>
                        <th>Uang Bayar</th>
                        <th>Kembalian</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $row)
                    <tr>
                        <td>{{ !empty($i) ? ++$i : $i = 1}}</td>
                        <td>
                            {{ $row->invoice}}
                        </td>
                        <td>
                            {{ $row->users->username}}
                        </td>
                        <td>{{ number_format($row->total, 0, ',', '.') }}</td>
                        <td>{{ $row->tanggal_transaksi}}</td>
                        <td>{{ $row->customer->nama ?? 'Pelanggan'}}</td>
                        <td>{{ number_format($row->paid_amount, 0, ',', '.')}}</td>
                        <td>{{ number_format($row->return_amount, 0, ',', '.')}}</td>
                        <td>
                            <a href="{{ url("order/$row->id_order/edit") }}" class="btn btn-warning">
                                <i class="fa fa-fw fa-pencil"></i>
                            </a>
                            <form method="POST" style="display: inline;" action="{{ url("order/$row->id_order/delete") }}">
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
                        <th>Invoice</th>
                        <th>User</th>
                        <th>Total</th>
                        <th>Tanggal Order</th>
                        <th>Customer</th>
                        <th>Uang Bayar</th>
                        <th>Kembalian</th>
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