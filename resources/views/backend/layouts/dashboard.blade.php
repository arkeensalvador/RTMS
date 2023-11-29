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
                        <div class="small-box bg-custom-researchers">
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

                    @if (auth()->user()->role == 'Admin')
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-custom-programs">
                                <div class="inner">
                                    <h3>
                                        {{ $total_programs_count_ongoing }} / {{ $total_programs_count_completed }}
                                    </h3>
                                    <p>Ongoing / Completed Programs</p>
                                </div>
                                <div class="icon">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <a href="{{ url('rdmc-programs') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-custom-projects">
                                <div class="inner">
                                    <h3>
                                        {{ $total_projects_count_ongoing }} / {{ $total_projects_count_completed }}
                                    </h3>
                                    <p>Ongoing / Completed Projects</p>
                                </div>
                                <div class="icon">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <a href="{{ url('rdmc-programs') }}" class="small-box-footer">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif
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
                            <div class="col-md-6">
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
                            {{-- CMI Initiatives --}}
                            <div class="col-md-6">
                                <div class="card card-success">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="chart">
                                                <div id="myChartIni"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Policy Research Conducted --}}
                            <div class="col-md-6">
                                <div class="card card-success">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="chart">
                                                <div id="myChartPRC"></div>
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

    {{-- Initiatives --}}
    <script>
        // Initialize ApexCharts
        var options = {
            chart: {
                type: 'bar',
                height: 285
            },
            series: [{
                name: 'Initiatives Count',
                data: @json($values_ini)
            }],
            xaxis: {
                categories: @json($labels_ini)
            },
            noData: {
                text: "Loading...",
            },
            title: {
                text: 'Policy Researches Conducted',
                align: 'center',
                floating: true
            },
            subtitle: {
                text: 'Total # of PRC',
                align: 'center',
            }
        };

        var chartIni = new ApexCharts(document.querySelector("#myChartIni"), options);
        chartIni.render();
    </script>


    {{-- Policy research conducted --}}
    {{-- Initiatives --}}
    <script>
        // Initialize ApexCharts
        var options = {
            chart: {
                type: 'bar',
                height: 285
            },
            series: [{
                name: 'Initiatives Count',
                data: @json($values_prc)
            }],
            xaxis: {
                categories: @json($labels_prc)
            },
            noData: {
                text: "Loading...",
            },
            title: {
                text: 'New Initiatives on Governance',
                align: 'center',
                floating: true
            },
            subtitle: {
                text: 'Total # of initiatives',
                align: 'center',
            }
        };

        var chartPRC = new ApexCharts(document.querySelector("#myChartPRC"), options);
        chartPRC.render();
    </script>

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
            noData: {
                text: "Loading...",
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
                type: 'bar',
                height: 285
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
            noData: {
                text: "Loading...",
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

        let awardData = @json($datas);
        var categories = awardData.map(function(item) {
            return item.agency;
        });

        var awardsCount = awardData.map(function(item) {
            return item.awards_count;
        });

        var options = {
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
            dataLabels: {
                enabled: false,
            },
            series: [{
                name: 'Awards Count',
                data: awardsCount,
            }],
            xaxis: {
                categories: categories,
            },
            yaxis: {
                title: {
                    text: 'Agency',
                },
            },
            fill: {
                opacity: 1,
            },
            colors: ['#546E7A', '#33b2df', '#d4526e', '#13d8aa', '#A5978B', '#2b908f', '#f9a3a4', '#90ee7e',
                '#f48024', '#69d2e7', '#A300D6', '#7D02EB', '#5653FE', '#2983FF', '#00B1F2'
            ],
            stroke: {
                width: 1,
                colors: ['#fff']
            },
            noData: {
                text: "Loading...",
            },
            title: {
                text: 'Awards',
                align: 'center',
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

        // PROGRAMS, PROJECTS, SUB_PROJECT
        // Prepare the data for ApexCharts
        let agencyData = @json($agencyData);
        let minValueAgencyData = @json($minValueAgencyData);

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
                height: 450,
            },
            xaxis: {
                categories: labels,
            },
            plotOptions: {
                bar: {
                    borderRadius: 1,
                    columnWidth: '100%',
                    dataLabels: {
                        position: 'bottom'
                    },
                }
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
            noData: {
                text: "Loading...",
            },
            yaxis: {
                title: {
                    text: 'Total #'
                },
                min: minValueAgencyData,
            },
            title: {
                text: 'Funded Research',
                align: 'center',
                floating: true
            },
            subtitle: {
                text: 'Total # of Programs, Projects, and Sub-projects funded per consortium',
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


        // Researchers Involvement

        var options = {
            chart: {
                type: 'donut',
            },
            labels: [
                @foreach ($researcherCounts as $researcher)
                    '{{ $researcher->name }}',
                @endforeach
            ],
            series: [
                @foreach ($researcherCounts as $researcher)
                    {{ $researcher->programs_count + $researcher->projects_count + $researcher->sub_projects_count }},
                @endforeach
            ],

            title: {
                text: 'Researchers Involvement',
                align: 'center',
                floating: false
            },
        }

        var chart13 = new ApexCharts(document.querySelector('#myChart13'), options);
        chart13.render();
    </script>
@endsection
