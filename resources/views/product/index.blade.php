@extends('templates/header')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Data Product
        <small>Minimarket</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Data Product</li>
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

            <form action="{{ route('product.export') }}" method="GET" class="pull-right">
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
                        <th>Image</th>
                        <th>SKU</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($result as $row)
                    <tr>
                        <td>{{ !empty($i) ? ++$i : $i = 1}}</td>
                        <td>
                            <img src="{{ asset('uploads/'.@$row->foto) }}" width="80px" class="img">
                        </td>
                        <td>
                            {!! DNS1D::getBarcodeHTML($row->sku, 'C128') !!}
                            {{ $row->sku}}
                        </td>
                        <td> {{ $row->nama_produk}}</td>
                        <td>{{ $row->description}}</td>
                        <td>{{ $row->stock}}</td>
                        <td>{{ $row->price}}</td>
                        <td>{{ $row->categories->nama_categories}}</td>
                        <td>
                            <a href="{{ url("product/$row->id_product/edit") }}" class="btn btn-warning">
                                <i class="fa fa-fw fa-pencil"></i>
                            </a>
                            <form method="POST" style="display: inline;" action="{{ url("product/$row->id_product/delete") }}">
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
                        <th>Image</th>
                        <th>SKU</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Description</th>
                        <th>Category</th>
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