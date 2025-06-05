@extends('templates/header')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Dashboard
        <small>Minimarket</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    @include('templates/feedback')
    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            <form method="GET" action="{{ url('dashboard') }}">
                <select name="filter" onchange="this.form.submit()">
                    <option value="today" {{ $filter == 'today' ? 'selected' : '' }}>Hari Ini</option>
                    <option value="week" {{ $filter == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                    <option value="month" {{ $filter == 'month' ? 'selected' : '' }}>Bulan Ini</option>
                </select>
            </form>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <section class="content">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{ $ordersCount}}</h3>

                                <p>Jumlah Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>{{ $productsCount}}</h3>

                                <p>Total Produk</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>{{ $usersCount }}</h3>

                                <p>Jumlah User</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>Rp {{ number_format($salesSum, 0, ',', '.') }}</h3>

                                <p>Jumlah Penjualan</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="nav-tabs-custom">
                            <!-- Tabs within a box -->
                            <ul class="nav nav-tabs pull-right">
                                <li class="active"><a href="#orders-chart" data-toggle="tab">Area</a></li>
                                <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                                <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
                            </ul>
                            <div class="tab-content no-padding">
                                <!-- Morris chart - Sales -->
                                <div class="chart tab-pane active" id="orders-chart" style="position: relative; height: 300px;"></div>
                                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                            </div>
                        </div>



                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>

                                <h3 class="box-title">Recent Orders</h3>

                                <div class="box-tools pull-right">
                                    <ul class="pagination pagination-sm inline">
                                        <li><a href="#">&laquo;</a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">&raquo;</a></li>
                                    </ul>
                                </div>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($recentOrders as $row)
                                        <tr>
                                            <td>{{ !empty($i) ? ++$i : $i = 1}}</td>
                                            <td>
                                                {{ $row->invoice}}
                                            </td>
                                            <td>
                                                {{ $row->id_user}}
                                            </td>
                                            <td>{{ number_format($row->total, 0, ',', '.') }}</td>
                                            <td>{{ $row->tanggal_transaksi}}</td>
                                            <td>{{ $row->customer->nama ?? 'Pelanggan'}}</td>
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
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix no-border">
                                <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
                            </div>
                        </div>

                    </section>
                    <section class="col-lg-5 connectedSortable">
                        <!-- Pindahkan box Stock Reminder ke sini -->
                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>

                                <h3 class="box-title">Stock reminder</h3>

                                <div class="box-tools pull-right">
                                    <ul class="pagination pagination-sm inline">
                                        <li><a href="#">&laquo;</a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">&raquo;</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Produk</th>
                                            <th>Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stockReminder as $row)
                                        <tr>
                                            <td>{{ !empty($i) ? ++$i : $i = 1}}</td>
                                            <td>
                                                {{ $row->nama_produk}}
                                            </td>
                                            <td>
                                                {{ $row->stock}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Produk</th>
                                            <th>Stock</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.box-body -->
                            <!-- <div class="box-footer clearfix no-border">
                                <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
                            </div> -->
                        </div>

                        <div class="box box-primary">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>

                                <h3 class="box-title">Top Selling</h3>

                                <div class="box-tools pull-right">
                                    <ul class="pagination pagination-sm inline">
                                        <li><a href="#">&laquo;</a></li>
                                        <li><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">&raquo;</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Produk</th>
                                            <th>Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stockReminder as $row)
                                        <tr>
                                            <td>{{ !empty($i) ? ++$i : $i = 1}}</td>
                                            <td>
                                                {{ $row->nama_produk}}
                                            </td>
                                            <td>
                                                {{ $row->stock}}
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Produk</th>
                                            <th>Stock</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.box-body -->
                            <!-- <div class="box-footer clearfix no-border">
                                <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
                            </div> -->
                        </div>
                    </section>
                </div>
                <!-- /.row (main row) -->


            </section>
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
<script>
    function loadChartData() {
        const filter = '{{ $filter }}';
        $.get('{{ url("dashboard/chart-data") }}?filter=' + filter, function(data) {
            Morris.Bar({
                element: 'orders-chart',
                data: data,
                xkey: 'label',
                ykeys: ['value'],
                labels: ['Jumlah Orders'],
                hideHover: 'auto',
                resize: true,
                barColors: ['#3c8dbc']
            });
        });
    }

    $(document).ready(function() {
        loadChartData();
    });
</script>