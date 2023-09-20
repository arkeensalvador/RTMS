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
                            <a class="btn btn-primary float-right" href="{{ URL::to('/reports/pdf') }}">Export to PDF</a>
                        </div>

                        {{-- card body start --}}
                        <div class="card-body">
                            <h4>Programs</h4>
                            <table id="" class="table table-bordered table-striped mb-3">
                                <thead>
                                    <tr>
                                        <th>Program Title</th>
                                        <th>Description</th>
                                        <th>Duration</th>
                                        <th>Funding Agency</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_programs as $data)
                                        <tr>
                                            <td>{{ $data->program_title }}</td>
                                            <td>{{ $data->program_description }}</td>
                                            <td>
                                                {{ date('F, Y', strtotime($data->start_date)) ?: 'Not Set' }} -
                                                {{ date('F, Y', strtotime($data->end_date)) ?: 'Not Set' }}
                                            </td>
                                            <td>{{ $data->funding_agency }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h4>Projects</h4>
                            <table id="" class="table table-bordered table-striped mb-3">
                                <thead>
                                    <tr>
                                        <th>Program Title</th>
                                        <th>Description</th>
                                        <th>Duration</th>
                                        <th>Funding Agency</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_projects as $key => $row)
                                        <tr>
                                            <td>{{ $row->project_title }}</td>
                                            <td>{{ $row->project_description }}</td>
                                            <td>
                                                {{ date('F, Y', strtotime($row->project_start_date)) ?: 'Not Set' }} -
                                                {{ date('F, Y', strtotime($row->project_end_date)) ?: 'Not Set' }}
                                            </td>
                                            <td>{{ $row->project_agency }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h4>Sub-Projects</h4>
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sub-project Title</th>
                                        <th>Description</th>
                                        <th>Duration</th>
                                        <th>Funding Agency</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_sub_projects as $key => $row)
                                        <tr>
                                            <td>{{ $row->sub_project_title }}</td>
                                            <td>{{ $row->sub_project_description }}</td>
                                            <td>
                                                {{ date('F, Y', strtotime($row->sub_project_start_date)) ?: 'Not Set' }} -
                                                {{ date('F, Y', strtotime($row->sub_project_end_date)) ?: 'Not Set' }}
                                            </td>
                                            <td>{{ $row->sub_project_agency }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
        </section>
    </div>
@endsection

