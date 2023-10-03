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
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>
                                    {{ $total_programs }}
                                </h3>

                                <p>Total Programs</p>
                            </div>
                            <div class="icon">
                                <i class="fa-regular fa-circle"></i>
                            </div>
                            <a href="{{ url('rdmc-programs') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>
                                    {{ $total_projects }}
                                </h3>
                                <p>Total Projects</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-diagram-project"></i>
                            </div>
                            <a href="{{ url('rdmc-projects') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>
                                    {{ $total_sub_projects }}
                                </h3>

                                <p>Total Sub-projects</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-list-check"></i>
                            </div>
                            <a href="{{ url('rdmc-projects') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>
                                    {{ $total_researchers }}
                                </h3>

                                <p>Total Researchers</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-book-open-reader"></i>
                            </div>
                            <a href="{{ url('researcher-index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">

                        <div class="row">

                        </div>
                        {{-- Programs --}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card card-success">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="chart">
                                                <div id="myChart1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- AIHRS --}}
                            <div class="col-md-6">
                                <div class="card card-success">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="chart">
                                                <div id="myChart2"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Awards --}}
                            <div class="col-md-12">
                                <div class="card card-success">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="chart">
                                                <div id="myChart3"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Researcher --}}
                            <div class="col-md-5">
                                <div class="card card-success">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="chart">
                                                <div id="myChart4"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ./card-body -->
                    </div>

                </div>
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->


    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    <script>
        // const ctxx = document.getElementById('myChart2');
        var totalNew = {{ json_encode($total_new) }};
        var totalOngoing = {{ json_encode($total_ongoing) }};
        var totalTerminated = {{ json_encode($total_terminated) }};
        var totalCompleted = {{ json_encode($total_completed) }};

        var options = {
            chart: {
                type: 'bar'
            },

            series: [{

                name: 'total',
                data: {{ json_encode($count_p) }}
            }],
            xaxis: {
                categories: [
                    @php
                        foreach ($progs as $p) {
                            echo "'" . $p->program_agency . "',";
                        }
                    @endphp
                ],
            },
            legend: {
                show: true,
                position: 'top'
            },
            title: {
                text: 'Programs',
                align: 'center',
                floating: true
            },
            subtitle: {
                text: 'Total # of programs per consortium',
                align: 'center',
            }
        }

        var chart1 = new ApexCharts(document.querySelector("#myChart1"), options);

        chart1.render();

        // NEW CHARTS APEXCHARTs
        var options = {
            chart: {
                type: 'bar'
            },

            series: [{
                name: 'total',
                data: [totalNew, totalOngoing, totalTerminated, totalCompleted],

            }],
            colors: ['#2b908f'],
            xaxis: {
                categories: ['New', 'Ongoing', 'Terminated', 'Completed']
            },
            legend: {
                show: true,
                position: 'top'
            },
            title: {
                text: 'AIHRs',
                align: 'center',
                floating: true
            },
            subtitle: {
                text: 'Agency In-house Reviews',
                align: 'center',
            },
        }

        var chart2 = new ApexCharts(document.querySelector("#myChart2"), options);

        chart2.render();

        // AWARDS

        var options = {
            series: [{
                data: {{ json_encode($count) }}
            }],
            chart: {
                type: 'bar',
                height: 380
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    barHeight: '100%',
                    distributed: true,
                    horizontal: true,
                    dataLabels: {
                        position: 'bottom'
                    },
                }
            },
            colors: ['#546E7A', '#33b2df', '#d4526e', '#13d8aa', '#A5978B', '#2b908f', '#f9a3a4', '#90ee7e',
                '#f48024', '#69d2e7', '#A300D6', '#7D02EB', '#5653FE', '#2983FF', '#00B1F2'
            ],
            dataLabels: {
                enabled: true,
                textAnchor: 'start',
                style: {
                    colors: ['#fff']
                },
                formatter: function(val, opt) {
                    return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
                },
                offsetX: 0,
                dropShadow: {
                    enabled: true
                }
            },
            stroke: {
                width: 1,
                colors: ['#fff']
            },
            xaxis: {
                categories: [

                    @php
                        foreach ($datas as $d) {
                            echo "'" . $d->agency_awards . "',";
                            // echo json_encode($agency_awards);
                        }
                    @endphp
                ],
            },
            yaxis: {
                labels: {
                    show: false
                }
            },
            title: {
                text: 'Awards',
                align: 'center',
                floating: true
            },
            subtitle: {
                text: 'Total awards count',
                align: 'center',
            },
            tooltip: {
                theme: 'dark',
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function() {
                            return ''
                        }
                    }
                }
            }
        };

        var chart3 = new ApexCharts(document.querySelector("#myChart3"), options);
        chart3.render();

        // Researchers
        var options = {
            chart: {
                type: 'bar'
            },

            series: [{
                name: 'total',
                data: {{ json_encode($count_res) }},

            }],
            colors: ['#2b908f'],
            xaxis: {
                categories: [
                    @php
                        foreach ($researchers as $res) {
                            echo "'" . $res->abbrev . "',";
                            // echo json_encode($agency_awards);
                        }
                    @endphp
                ]
            },
            legend: {
                show: true,
                position: 'top'
            },
            title: {
                text: 'Researchers',
                align: 'center',
                floating: true
            },
            subtitle: {
                text: 'Total # of researchers per consortium',
                align: 'center',
            },
        }

        var chart4 = new ApexCharts(document.querySelector("#myChart4"), options);

        chart4.render();
    </script>
@endsection
