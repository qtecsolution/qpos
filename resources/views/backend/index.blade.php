@extends('backend.master')

@section('title', 'Dashboard')

@section('content')
<section class="content">
    @can('dashboard_view')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Sale SubTotal</span>
                        <span class="info-box-number">
                            {{currency()->symbol??''}} {{number_format($sub_total,2,'.',',')}}
                            <small></small>
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Sale Discount</span>
                        <span class="info-box-number">{{currency()->symbol??''}} {{number_format($discount,2,'.',',')}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Sale</span>
                        <span class="info-box-number">{{currency()->symbol??''}} {{number_format($total,2,'.',',')}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Sale Due </span>
                        <span class="info-box-number">{{currency()->symbol??''}} {{number_format($due,2,'.',',')}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$total_customer}}</h3>
                        <p>Customers</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{route('backend.admin.customers.index')}}" class="small-box-footer">
                        More info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$total_product}}</h3>
                        <p>Products</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{route('backend.admin.products.index')}}" class="small-box-footer">
                        More info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$total_order}}</h3>
                        <p>Sale</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{route('backend.admin.orders.index')}}" class="small-box-footer">
                        More info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$total_sale_item}}</h3>
                        <p>Sale Item</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{route('backend.admin.orders.index')}}" class="small-box-footer">
                        More info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->


        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daily Total Sales <small>{{ $dateRange }}</small></h5>
                        <div class="input-group w-auto">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="reservation" style="width: 180px;">
                        </div>
                    </div>

                    <div class="card-body">
                        <canvas id="dailySaleLineChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Monthly Total Sales <small>for {{ $currentYear }}</small></h5>
                    </div>
                    <div class="card-body">
                        <canvas id="barChartYear"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
    <!-- /.container-fluid -->
</section>
@endsection
@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const dailySaleChart = document.getElementById('dailySaleLineChart');
    const barChartYear = document.getElementById('barChartYear');

    new Chart(dailySaleChart, {
        type: 'line',
        data: {
            labels: @json($dates),
            datasets: [{
                label: 'Sales',
                data: @json($totalAmounts),
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    new Chart(barChartYear, {
        type: 'bar',
        data: {
            labels: @json($months),
            datasets: [{
                label: 'Sales',
                data: @json($totalAmountMonth),
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
<script>
    $(function() {
        //Date range picker
        $('#reservation').daterangepicker().on('apply.daterangepicker', function(e, picker) {
            let selectedDateRange = picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD');

            // Update URL with daterange query parameter
            let url = new URL(window.location.href);
            url.searchParams.set('daterange', selectedDateRange);
            window.location.href = url.toString();
        });

    })
</script>
@endpush