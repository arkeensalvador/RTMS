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
                                <a href="{{ url('rdmc-projects') }}" class="small-box-footer">More info <i
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

                            {{-- ALL PROGRAMS, PROJECTS, SUB PROJECTS COUNT FUNDED BY AGENCIES --}}
                            <div class="col-md-12">
                                <div class="card card-success">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="chart">
                                                <div id="chart-container"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- ALL PROGRAMS, PROJECTS, SUB PROJECTS COUNT IMPLEMENTED BY AGENCIES --}}
                            <div class="col-md-12">
                                <div class="card card-success">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="chart">
                                                <div id="imp-chart-container"></div>
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
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var seriesData = [];
            var usedColors = [];

            @foreach ($fundedCounts as $abbrev => $counts)
                var randomColor = getRandomColor();
                usedColors.push(randomColor);

                seriesData.push({
                    name: '{{ $abbrev }}',
                    data: [{{ $counts['programs'] }}, {{ $counts['projects'] }},
                        {{ $counts['subProjects'] }}
                    ],
                    color: randomColor
                });
            @endforeach

            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';

                // Keep generating random colors until a unique one is found
                do {
                    color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                } while (usedColors.includes(color));

                return color;
            }

            var options = {
                chart: {
                    type: 'bar',
                    height: 470,
                },
                series: seriesData,
                title: {
                    text: 'Funded Programs, Projects, Sub-projects/Studies of Agencies',
                    align: 'center',
                    floating: true
                },

                xaxis: {
                    categories: ['Funded Programs', 'Funded Projects', 'Funded Sub-Projects/Studies']
                },
                yaxis: {
                    min: 0, // Set the minimum value for the y-axis
                    title: {
                        text: 'Total'
                    }
                },
                plotOptions: {
                    bar: {
                        columnWidth: '85    %', // Adjust the width of the bars (percentage or pixels)
                    }
                },
                labels: {
                    show: true
                }
            }

            var chart = new ApexCharts(document.querySelector("#chart-container"), options);
            chart.render();
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var seriesData = [];
            var usedColors = [];

            @foreach ($fundedCounts as $abbrev => $counts)
                var randomColor = getRandomColor();
                usedColors.push(randomColor);

                var data = [{{ $counts['programs'] }}, {{ $counts['projects'] }}, {{ $counts['subProjects'] }}];

                // Filter out zero values from the data array
                data = data.filter(function(value) {
                    return value !== 0;
                });

                if (data.length > 0) {
                    seriesData.push({
                        name: '{{ $abbrev }}',
                        data: data,
                        color: randomColor
                    });
                }
            @endforeach

            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';

                // Keep generating random colors until a unique one is found
                do {
                    color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                } while (usedColors.includes(color));

                return color;
            }

            var options = {
                chart: {
                    type: 'bar',
                    height: 470,
                },
                series: seriesData,
                title: {
                    text: 'Funded Programs, Projects, Sub-projects/Studies of Agencies',
                    align: 'center',
                    floating: true
                },

                xaxis: {
                    categories: ['Funded Programs', 'Funded Projects', 'Funded Sub-Projects/Studies']
                },
                yaxis: {
                    min: 0, // Set the minimum value for the y-axis
                    title: {
                        text: 'Total'
                    }
                },
                plotOptions: {
                    bar: {
                        columnWidth: '85%' // Adjust the width of the bars (percentage or pixels)
                    }
                },
                labels: {
                    show: true
                }
            }

            var chart = new ApexCharts(document.querySelector("#chart-container"), options);
            chart.render();
        });
    </script>

    {{-- total imp programs of agencies --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var seriesDataImp = [];
            var usedColorsImp = [];

            @foreach ($impCounts as $abbrev_imp => $counts)
                var randomColor = getRandomColor();
                usedColorsImp.push(randomColor);

                seriesDataImp.push({
                    name: '{{ $abbrev_imp }}',
                    data: [{{ $counts['programs'] }}, {{ $counts['projects'] }},
                        {{ $counts['subProjects'] }}
                    ],
                    color: randomColor
                });
            @endforeach

            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';

                // Keep generating random colors until a unique one is found
                do {
                    color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                } while (usedColorsImp.includes(color));

                return color;
            }

            var options = {
                chart: {
                    type: 'bar',
                    height: 470,
                },
                series: seriesDataImp,
                title: {
                    text: 'Implemented Program, Projects, Sub-projects/Studies of Agencies',
                    align: 'center',
                    floating: true
                },

                xaxis: {
                    categories: ['Implemented Programs', 'Implemented Projects',
                        'Implemented Sub-Projects/Studies'
                    ]
                },
                yaxis: {
                    min: 0, // Set the minimum value for the y-axis
                    title: {
                        text: 'Total'
                    }
                },
                plotOptions: {
                    bar: {
                        columnWidth: '100%', // Adjust the width of the bars (percentage or pixels)
                    }
                },
                labels: {
                    show: true
                }
            }

            var chart = new ApexCharts(document.querySelector("#imp-chart-container"), options);
            chart.render();
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var seriesDataImp = [];
            var usedColorsImp = [];

            @foreach ($impCounts as $abbrev_imp => $counts)
                var randomColor = getRandomColor();
                usedColorsImp.push(randomColor);

                var dataImp = [{{ $counts['programs'] }}, {{ $counts['projects'] }},
                    {{ $counts['subProjects'] }}
                ];

                // Filter out zero values from the data array
                dataImp = dataImp.filter(function(value) {
                    return value !== 0;
                });

                if (dataImp.length > 0) {
                    seriesDataImp.push({
                        name: '{{ $abbrev_imp }}',
                        data: dataImp,
                        color: randomColor
                    });
                }
            @endforeach

            function getRandomColor() {
                var letters = '0123456789ABCDEF';
                var color = '#';

                // Keep generating random colors until a unique one is found
                do {
                    color = '#';
                    for (var i = 0; i < 6; i++) {
                        color += letters[Math.floor(Math.random() * 16)];
                    }
                } while (usedColorsImp.includes(color));

                return color;
            }

            var options = {
                chart: {
                    type: 'bar',
                    height: 470,
                },
                series: seriesDataImp,
                title: {
                    text: 'Implemented Program, Projects, Sub-projects/Studies of Agencies',
                    align: 'center',
                    floating: true
                },
                xaxis: {
                    categories: ['Implemented Programs', 'Implemented Projects',
                        'Implemented Sub-Projects/Studies'
                    ]
                },
                yaxis: {
                    min: 0, // Set the minimum value for the y-axis
                    title: {
                        text: 'Total'
                    }
                },
                plotOptions: {
                    bar: {
                        columnWidth: '100%' // Adjust the width of the bars (percentage or pixels)
                    }
                },
                labels: {
                    show: true
                }
            }

            var chart = new ApexCharts(document.querySelector("#imp-chart-container"), options);
            chart.render();
        });
    </script>

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
                text: "No data available",
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
                name: 'PRC Count',
                data: @json($values_prc),
            }],
            xaxis: {
                categories: @json($labels_prc)
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

        var chartPRC = new ApexCharts(document.querySelector("#myChartPRC"), options);
        chartPRC.render();
    </script>

    <script>
        var totalNew = {{ $total_new }};
        var totalOngoing = {{ $total_ongoing }};
        var totalTerminated = {{ $total_terminated }};
        var totalCompleted = {{ $total_completed }};

        // Calculate total count
        var totalCount = totalNew + totalOngoing + totalTerminated + totalCompleted;

        // NEW CHARTS APEXCHARTs
        var options = {
            chart: {
                type: 'donut',
                height: 300
            },
            series: [totalNew, totalOngoing, totalTerminated, totalCompleted],
            labels: ['New', 'Ongoing', 'Terminated', 'Completed'],
            colors: ['#5653FE', '#FEB019', '#FF4560', '#00E396'],
            legend: {
                show: true,
                position: 'right',
                floating: false,
                formatter: function(seriesName, opts) {
                    return seriesName + ': ' + opts.w.globals.series[opts.seriesIndex] + ' (' + (opts.w.globals
                        .series[opts.seriesIndex] / totalCount * 100).toFixed(2) + '%)';
                }
            },
            title: {
                text: 'AIHRs',
                align: 'center',
                floating: false
            },
            subtitle: {
                text: 'Agency In-house Reviews',
                align: 'center',
            },
        };

        var chart2 = new ApexCharts(document.querySelector("#myChart2"), options);
        chart2.render();
    </script>



    <script>
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
    </script>
@endsection
