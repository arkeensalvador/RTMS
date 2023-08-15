@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">

        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ auth()->user()->role }} - Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">CPU Traffic</span>
                                <span class="info-box-number">
                                    10
                                    <small>%</small>

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
                                <span class="info-box-text">Likes</span>
                                <span class="info-box-number">41,410</span>
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
                                <span class="info-box-text">Sales</span>
                                <span class="info-box-number">760</span>
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
                                <span class="info-box-text">New Members</span>
                                <span class="info-box-number">2,000</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            {{-- <div class="card-header">
                                <h5 class="card-title">{{ auth()->user()->role }} - Dashboard</h5>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                            <i class="fas fa-wrench"></i>
                                        </button>

                                    </div>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div> --}}
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    {{-- <div class="col-md-8">
                                        Welcome to {{ auth()->user()->role }} - Dashboard
                                    </div> --}}
                                    <!-- /.col -->
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-success" >
                                            <div class="card-header" style="background-color: #74c023;">
                                                <h3 class="card-title">AIHRs</h3>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <div class="chart">
                                                        <canvas id="myChart"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card card-success" >
                                            <div class="card-header" style="background-color: #74c023;">
                                                <h3 class="card-title">AIHRs</h3>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <div class="chart">
                                                        <canvas id="myChart"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-success">
                                            <div class="card-header" style="background-color: #74c023;">
                                                <h3 class="card-title">AIHRs</h3>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <div class="chart">
                                                        <canvas id="myChart"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card card-success">
                                            <div class="card-header" style="background-color: #74c023;">
                                                <h3 class="card-title">AIHRs</h3>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <div class="chart">
                                                        <canvas id="myChart"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                </div>


                                <!-- /.row -->
                            </div>
                            <!-- ./card-body -->
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-sm-3 col-6">


                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3 col-6">

                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3 col-6">

                                        <!-- /.description-block -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-sm-3 col-6">
                                        {{-- <div class="description-block">
                                        <span class="description-percentage text-danger"><i
                                                class="fas fa-caret-down"></i> 18%</span>
                                        <h5 class="description-header">1200</h5>
                                        <span class="description-text">GOAL COMPLETIONS</span>
                                    </div> --}}
                                        <!-- /.description-block -->
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        const ctxx = document.getElementById('myChart2');

        // var agencyList = {{ json_encode($list) }};
        var totalNew = {{ json_encode($total_new) }};
        var totalOngoing = {{ json_encode($total_ongoing) }};
        var totalTerminated = {{ json_encode($total_terminated) }};
        var totalCompleted = {{ json_encode($total_completed) }};

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['New', 'Ongoing', 'Terminated', 'Completed'],
                datasets: [{
                    label: "Total",
                    data: [totalNew, totalOngoing, totalTerminated, totalCompleted],
                    backgroundColor: [
                        'rgba(255, 193, 7, 0.9)',
                        'rgba(23, 162, 184, 0.9)',
                        'rgba(179 , 0, 0, 0.9)',
                        'rgba(0, 128, 0, 0.9)'
                    ],
                    borderWidth: 1
                }],


            },

            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },

                plugins: {
                    legend: {
                        display: false
                    }

                }
            }
        });
    </script>
@endsection
