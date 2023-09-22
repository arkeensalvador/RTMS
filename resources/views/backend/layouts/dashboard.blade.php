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
        <div class="container col-md-12 text-start">
            <div class="row align-items-start mx-0">
                <div class="col-3">
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
                </div>
                <div class="col-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Likes</span>
                            <span class="info-box-number">41,410</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Sales</span>
                            <span class="info-box-number">760</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
                <div class="col-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">New Members</span>
                            <span class="info-box-number">2,000</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    {{-- <div class="col-md-8">
                                        Welcome to {{ auth()->user()->role }} - Dashboard
                                    </div> --}}
                                    <!-- /.col -->
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card card-success">
                                            <div class="card-header" style="background-color: #43a615;">
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
                                            <div class="card-header" style="background-color: #43a615;">
                                                <h3 class="card-title">Users</h3>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <div class="chart">
                                                        <div id="data" style="height: 350px;"></div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                        </div>

                                        <!-- /.row -->
                                    </div>

                                    <div class="col-md-8">
                                        <div class="card card-success">
                                            <div class="card-header" style="background-color: #43a615;">
                                                <h3 class="card-title">Awards</h3>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <div class="chart">
                                                        <div id="datas" style="width: 900px"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="card card-success">
                                            <div class="card-header" style="background-color: #43a615;">
                                                <h3 class="card-title">Programs</h3>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card-body">
                                                    <div class="chart">
                                                        <div id="progs" style="width: 100%"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>

                                </div>
                                <!-- ./card-body -->
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
        // const ctxx = document.getElementById('myChart2');

        // var agencyList = {{ json_encode($list) }};
        var totalNew = {{ json_encode($total_new) }};
        var totalOngoing = {{ json_encode($total_ongoing) }};
        var totalTerminated = {{ json_encode($total_terminated) }};
        var totalCompleted = {{ json_encode($total_completed) }};

        new Chart(ctx, {
            type: 'bar',
            labels: ['New', 'Ongoing', 'Terminated', 'Completed'],
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

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Month Name', 'Registered User Count'],

                @php
                    foreach ($data as $d) {
                        echo "['" . $d->month_name . "', " . $d->count . '],';
                    }
                @endphp

            ]);

            var options = {
                title: 'No. of users created',
                is3D: false,
            };



            var chart = new google.visualization.PieChart(document.getElementById('data'));

            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Agency Name', 'Total no. of Awards Received'],

                @php
                    foreach ($datas as $d) {
                        echo "['" . $d->agency . "', " . $d->count . '],';
                    }
                @endphp

            ]);

            var options = {
                title: 'Total Awards Received by Agency',
                is3D: false,
                height: 600
            };



            var chart = new google.visualization.ColumnChart(document.getElementById('datas'));

            chart.draw(data, options);
        }
    </script>

    // programs

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Agency Name', 'Programs'],

                @php
                    foreach ($progs as $d) {
                        echo "['" . $d->agency . "', " . $d->count . '],';
                    }
                @endphp

            ]);

            var options = {
                title: 'Programs of Fuding Agencies',
                is3D: true,
                height: 600
            };



            var chart = new google.visualization.ColumnChart(document.getElementById('progs'));

            chart.draw(data, options);
        }
    </script>
@endsection
