@extends('backend.layouts.app')
@section('content')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <style>
        .radio-input input {
            display: none;
        }

        .radio-input {
            --container_width: 200px;
            position: relative;
            display: flex;
            height: 2.76rem;
            align-items: center;
            border-radius: 10px;
            background-color: #fff;
            color: #000000;
            width: var(--container_width);
            overflow: hidden;
            border: 1px solid rgba(53, 52, 52, 0.226);
        }


        .radio-input label.upl {
            width: 100%;
            padding: 10px;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1;
            font-weight: 600;
            letter-spacing: 1.5px;
            font-size: 14px;
        }

        label.upl {
            margin: 0 auto;
        }

        span.sel {
            display: none;
            position: absolute;
            height: 100%;
            width: calc(var(--container_width) / 2);
            z-index: 0;
            left: 0;
            top: 0;
            transition: .15s ease;
        }

        input#file-upload1,
        input#file-upload2,
        input#file-upload3,
        input#file-upload4 {
            height: auto !important;
        }

        .radio-input label.upl:has(input:checked) {
            color: #fff;
            /* color: #28a745; */
        }

        .radio-input label.upl:has(input:checked)~.sel {
            /* background-color: rgb(11 117 223); */
            background-color: #17a2b8;
            display: inline-block;
        }

        .radio-input label.upl:nth-child(1):has(input:checked)~.sel {
            transform: translateX(calc(var(--container_width) * 0/2));
        }

        .radio-input label.upl:nth-child(2):has(input:checked)~.sel {
            transform: translateX(calc(var(--container_width) * 1/2));
        }
    </style>


    <div class="content-wrapper">
        <section class="content">

            <div class="strategic row">

                <div class="col-md-12">

                    {{-- card start --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Report List
                            </h5>
                        </div>

                        {{-- card body start --}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="col-sm-7">
                                        {{-- {{$agency}} --}}
                                        <div>
                                            <canvas id="myChart"></canvas>
                                        </div>
                                        <div>
                                            <canvas id="myChart2"></canvas>
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
                                    </div>{{-- card end --}}

                                </div>
                                <div class="col-lg-1">
                                </div>
                            </div>
        </section>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

    <script>
        var selectBox = document.getElementById("year");
        selectBox.onchange = function() {
            var textbox = document.getElementById("textYear");
            textbox.value = this.value;
        };
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
        var i = 0;
        $("#add-btn").click(function() {
            ++i;
            $("#dynamicAddRemove").append(`
            <tr>
                <td class="append">
                    <input type="text" class="form-control" name="moreFields[` + i + `][programID]" value="{{ Route::input('programID') }}" 
                    placeholder="Program ID" hidden readonly required autocomplete="false">
                    <input type="text" class="form-control" placeholder="Staff" name="moreFields[` + i + `][staff_name]">
                </td>

                <td class="append">
                    <i class="fa-solid fa-user-minus fa-lg remove-input" style="color: #dc3545;"></i>
                </td>
            </tr>`);
        });
        $(document).on('click', '.remove-input', function() {
            $(this).parents('tr').remove();
        });

        $('input.number-to-text').keydown(function(event) {
            if ([38, 40].indexOf(event.keyCode) > -1) {
                event.preventDefault();
            }
        });
    </script>
@endsection

{{-- 
{{ $total_new }}
{{ $total_ongoing }}
{{ $total_terminated }}
{{ $total_completed }}

<div id="highchart"></div>
<script>
    $(function() {
        var totalNew = {{ json_encode($total_new) }};
        var totalOngoing = {{ json_encode($total_ongoing) }};
        var totalTerminated = {{ json_encode($total_terminated) }};
        var totalCompleted = {{ json_encode($total_completed) }};

        $('#highchart').highchart({
            chart: {
                type: "column"
            },
            title: {
                text: "Agency In-House Reviews"
            },
            xAxis: {
                categories: ['New', 'Ongoing', 'Terminated', 'Completed']
            },
            series: [{
                name: 'New',
                data: totalNew
            }, {
                name: 'Ongoing',
                data: totalOngoing
            }, {
                name: 'Terminated',
                data: totalTerminated
            }, {
                name: 'Completed',
                data: totalCompleted
            }]
        });
    });
</script> --}}