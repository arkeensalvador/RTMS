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
                                    @if (auth()->user()->role == 'Admin')
                                        {{ $total_programs_count }}
                                    @else
                                        {{ $total_programs_count_filter }}
                                    @endif
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
                                    @if (auth()->user()->role == 'Admin')
                                        {{ $total_projects }}
                                    @else
                                        {{ $total_projects_filter }}
                                    @endif

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
                                    @if (auth()->user()->role == 'Admin')
                                        {{ $total_sub_projects }}
                                    @else
                                        {{ $total_sub_projects_filter }}
                                    @endif

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
                                    @if (auth()->user()->role == 'Admin')
                                        {{ $total_researchers }}
                                    @else
                                        {{ $total_researchers_filter }}
                                    @endif

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
        <?php if(auth()->user()->role == "Admin") { ?>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        {{-- CHARTS --}}
                        <div class="row">
                            {{-- Programs --}}
                            <div class="col-md-4">
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
                            {{-- Projects --}}
                            <div class="col-md-4">
                                <div class="card card-success">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="chart">
                                                <div id="myChart6"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Sub Projects --}}
                            <div class="col-md-4">
                                <div class="card card-success">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="chart">
                                                <div id="myChart9"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ALL PROGRAMS, PROJECTS, SUB PROJECTS --}}
                            <div class="col-md-12">
                                <div class="card card-success">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="chart">
                                                <div id="myChart7"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- AIHRS --}}
                            <div class="col-md-4">
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
                            {{-- Researcher --}}
                            <div class="col-md-4">
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
                            {{-- Awards --}}
                            <div class="col-md-4">
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


                            {{-- Budget per Consortium --}}
                            <div class="col-md-12">
                                <div class="card card-success">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="chart">
                                                <div id="myChart5"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
        <!-- /.content -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    <script>
        var totalNew = {{ json_encode($total_new) }};
        var totalOngoing = {{ json_encode($total_ongoing) }};
        var totalTerminated = {{ json_encode($total_terminated) }};
        var totalCompleted = {{ json_encode($total_completed) }};

        // total programs per consortium
        var options = {
            chart: {
                type: 'bar'
            },

            series: [{

                name: 'total',
                data: [
                    @php
                        foreach ($total_programs as $tp) {
                            echo "'" . $tp->total_programs_count . "',";
                        }
                    @endphp
                ]
            }],
            xaxis: {
                categories: [
                    @php
                        foreach ($total_programs as $tp) {
                            echo "'" . $tp->total_program_agency . "',";
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
            colors: ['#5653FE'],
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

        // Researchers
        var options = {
            series: {{ json_encode($count_res) }},
            chart: {
                height: 300,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    offsetY: 0,
                    offsetX: 0,
                    startAngle: 0,
                    endAngle: 270,
                    hollow: {
                        margin: 5,
                        size: '30%',
                        background: 'transparent',
                        image: undefined,
                    },
                    dataLabels: {
                        name: {
                            show: false,
                        },
                        value: {
                            show: false,
                        }
                    }
                }
            },
            colors: ['#1ab7ea', '#0084ff', '#39539E', '#0077B5'],
            labels: [
                @php
                    foreach ($researchers as $res) {
                        echo "'" . $res->abbrev . "',";
                    }
                @endphp
            ],
            legend: {
                show: true,
                floating: true,
                fontSize: '12px',
                position: 'left',
                offsetX: -35,
                offsetY: -15,
                labels: {
                    useSeriesColors: true,
                },
                markers: {
                    size: 0
                },
                formatter: function(seriesName, opts) {
                    return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
                },
                itemMargin: {
                    vertical: -5
                }
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
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        show: false
                    }
                }
            }]
        };
        // var options = {
        //     chart: {
        //         type: 'bar'
        //     },

        //     series: [{
        //         name: 'total',
        //         data: {{ json_encode($count_res) }},

        //     }],
        //     colors: ['#5653FE'],
        //     xaxis: {
        //         categories: [
        //             @php
            //                 foreach ($researchers as $res) {
            //                     echo "'" . $res->abbrev . "',";
            //                 }
            //
        @endphp
        //         ]
        //     },
        //     legend: {
        //         show: true,
        //         position: 'top'
        //     },
        //     title: {
        //         text: 'Researchers',
        //         align: 'center',
        //         floating: true
        //     },
        //     subtitle: {
        //         text: 'Total # of researchers per consortium',
        //         align: 'center',
        //     },
        // }

        var chart3 = new ApexCharts(document.querySelector("#myChart3"), options);

        chart3.render();

        // AWARDS

        var options = {
            series: [{
                data: {{ json_encode($count) }}
            }],
            chart: {
                type: 'bar',
                height: 285
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
            // dataLabels: {
            //     enabled: true,
            //     textAnchor: 'start',
            //     style: {
            //         colors: ['#fff']
            //     },
            //     formatter: function(val, opt) {
            //         return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val
            //     },
            //     offsetX: 0,
            //     dropShadow: {
            //         enabled: true
            //     }
            // },
            stroke: {
                width: 1,
                colors: ['#fff']
            },
            xaxis: {
                categories: [

                    @php
                        foreach ($datas as $d) {
                            echo "'" . $d->agency_awards . "',";
                        }
                    @endphp
                ],
            },
            yaxis: {
                labels: {
                    show: true
                }
            },
            title: {
                text: 'Awards',
                align: 'center',
                floating: true
            },
            subtitle: {
                text: 'Total awards count per consortium',
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

        var chart4 = new ApexCharts(document.querySelector("#myChart4"), options);
        chart4.render();

        // BUDGET
        var options = {
            series: [{
                name: "Budget",
                data: [
                    @php
                        foreach ($progs as $p) {
                            $budget = str_replace(',', '', $p->budget);
                            echo "'" . $budget . "',";
                        }
                    @endphp
                ]
            }],
            chart: {
                height: 350,
                type: 'area',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            title: {
                text: 'Budgets',
                align: 'center'
            },
            subtitle: {
                text: 'Approved program budgets per consortium',
                align: 'center'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: [
                    @php
                        foreach ($progs as $p) {
                            echo "'" . $p->title . '(' . $p->abbrev . ")',";
                        }
                    @endphp
                ],
            },

        };

        var chart5 = new ApexCharts(document.querySelector("#myChart5"), options);
        chart5.render();


        // PROJECTS
        var options = {
            chart: {
                type: 'bar'
            },

            series: [{
                name: 'total',
                data: [
                    @php
                        foreach ($total_projs as $proj) {
                            echo "'" . $proj->total_count_proj . "',";
                        }
                    @endphp
                ],

            }],
            colors: ['#2b908f'],
            xaxis: {
                categories: [
                    @php
                        foreach ($total_projs as $proj) {
                            echo "'" . $proj->total_project_agency . "',";
                        }
                    @endphp
                ]
            },
            legend: {
                show: true,
                position: 'top'
            },
            title: {
                text: 'Projects',
                align: 'center',
                floating: true
            },
            subtitle: {
                text: 'Total # of projects per consortium',
                align: 'center',
            },
        }

        var chart6 = new ApexCharts(document.querySelector("#myChart6"), options);

        chart6.render();


        // PROGRAMS, PROJECTS, SUB_PROJECT
        // Prepare the data for ApexCharts
        let agencyData = @json($agencyData);

        // Extract data for chart labels and series
        let labels = [];
        let programsData = [];
        let projectsData = [];
        let subProjectsData = [];

        agencyData.forEach((item) => {
            labels.push(item.agency_abbreviation);
            programsData.push(item.total_programs);
            projectsData.push(item.total_projects);
            subProjectsData.push(item.total_sub_projects);
        });

        // Create the ApexCharts instance
        var options = {
            chart: {
                type: 'bar',
                height: 350,
            },
            xaxis: {
                categories: labels,
            },

            series: [{
                    name: 'Programs',
                    data: programsData,
                },
                {
                    name: 'Projects',
                    data: projectsData,
                },
                {
                    name: 'Sub-Projects',
                    data: subProjectsData,
                },
            ],
            yaxis: {
                title: {
                    text: 'Total #'
                }
            },
            title: {
                text: 'Programs, Projects, and Sub-projects per consortium',
                align: 'center',
                floating: true
            },
            subtitle: {
                text: 'Total # of Programs, Projects, and Sub-projects per consortium',
                align: 'center',
            },
        };

        var chart7 = new ApexCharts(document.querySelector("#myChart7"), options);
        chart7.render();

        // Sub PROJECTS
        var options = {
            chart: {
                type: 'bar'
            },

            series: [{
                name: 'total',
                data: [
                    @php
                        foreach ($total_sub_projs as $sub_proj) {
                            echo "'" . $sub_proj->total_count_sub_proj . "',";
                        }
                    @endphp
                ],

            }],
            colors: ['#90ee7e'],
            xaxis: {
                categories: [
                    @php
                        foreach ($total_sub_projs as $sub_proj) {
                            echo "'" . $sub_proj->total_sub_project_agency . "',";
                        }
                    @endphp
                ]
            },
            legend: {
                show: true,
                position: 'top'
            },
            title: {
                text: 'Sub-Projects',
                align: 'center',
                floating: true
            },
            subtitle: {
                text: 'Total # of Sub-projects per consortium',
                align: 'center',
            },
        }

        var chart9 = new ApexCharts(document.querySelector("#myChart9"), options);

        chart9.render();
    </script>
@endsection
