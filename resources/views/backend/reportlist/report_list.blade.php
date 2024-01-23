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

        @import url('https://fonts.googleapis.com/css?family=Poppins');

        body {
            font-family: 'Poppins', sans-serif;
        }

        .table-area .notices {
            padding-left: 6px;
            padding: 10px;
        }

        thead {
            color: #fff;
            font-weight: 200;
            font-size: 20px;
        }

        .table td,
        .table th {
            text-align: center;
            vertical-align: middle;
            font-size: 14px;
        }

        .report-footer {
            border-top: 1px solid #ddd;
            padding-top: 10px;
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
                                Report List (In Progress)
                            </h5>
                            <a class="btn btn-primary float-right" href="{{ URL::to('/reports/pdf') }}">Export to PDF</a>
                        </div>

                        {{-- card body start --}}
                        <div class="card-body">
                            <div class="my-1 ">
                                <div class="p-1">
                                    <!-- R&D Management and Coordination -->
                                    <section class="table-area mt-1 page-break">
                                        <div class="table-title col-12 py-1"
                                            style="background-image: url('https://i.ibb.co/Jp0tJxt/sec1.webp'); background-size:cover;;">
                                            <h1 class="text-center text-capitalized font-weight-bold"
                                                style="color: #fff; text-shadow: 1px 1px 2px #1b1b1b; letter-spacing: -1px; ">
                                                RESEARCH AND
                                                DEVELOPMENT<br>MANAGEMENT AND COORDINATION</h1>
                                        </div>


                                        <!-- Summary of the AIHR's conducted by the CMI's -->
                                        <div class="category my-5">
                                            <div class="notices mb-1 " style="border-left: 6px solid #0DA603;">
                                                <h5>Summary of the <span class="font-weight-bold"
                                                        style=" color: #0DA603;">AIHR's conducted by
                                                        the CMI's</span></h5>
                                            </div>

                                            <table class="table-bordered table table-hover">
                                                <thead style="background-color: #0DA603;">
                                                    <tr>
                                                        <td rowspan="2">Agency</td>
                                                        <td colspan="5">Number of Project Presented</td>
                                                    </tr>
                                                    <tr>
                                                        <td style="">New</td>
                                                        <td>Ongoing</td>
                                                        <td>Terminated</td>
                                                        <td>Completed</td>
                                                        <td>Total Projects Reviewed</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($fundedCounts as $abbrev => $counts)
                                                        @if (
                                                            $counts['new'] > 0 ||
                                                                $counts['ongoing'] > 0 ||
                                                                $counts['terminated'] > 0 ||
                                                                $counts['completed'] > 0 ||
                                                                $counts['totalCount'] > 0)
                                                            <tr>
                                                                <td>{{ $abbrev }}</td>
                                                                <td>{{ $counts['new'] }}</td>
                                                                <td>{{ $counts['ongoing'] }}</td>
                                                                <td>{{ $counts['terminated'] }}</td>
                                                                <td>{{ $counts['completed'] }}</td>
                                                                <td>{{ $counts['totalCount'] }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- PROJECTS -->
                                        <div class="category my-5">
                                            <div class="notices mb-1 " style="border-left: 6px solid #0DA603;">
                                                <h5>List of <span class="font-weight-bold"
                                                        style=" color: #0DA603;">Project</span></h5>
                                            </div>
                                            <table class="table-bordered table table-hover">
                                                <thead style="background-color: #0DA603;">
                                                    <tr>
                                                        <td>Project Title</td>
                                                        <td>Description</td>
                                                        <td>Duration</td>
                                                        <td>Funding Agency</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($plist as $pl)
                                                        <tr>
                                                            <td>{{ $pl->project_title }}</td>
                                                            <td>{{ $pl->project_description }}</td>
                                                            <td>
                                                                {{ $pl->project_duration }}
                                                            </td>
                                                            @php
                                                                $fa = json_decode($pl->project_agency);
                                                                $fa = implode(', ', $fa);
                                                            @endphp
                                                            <td>{{ $fa }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- PROGRAMS -->
                                        <div class="category my-5">
                                            <div class="notices mb-1 " style="border-left: 6px solid #0DA603;">
                                                <h5>List of <span class="font-weight-bold"
                                                        style=" color: #0DA603;">Program</span></h5>
                                            </div>
                                            <table class="table-bordered table table-hover">
                                                <thead style="background-color: #0DA603;">
                                                    <tr>
                                                        <td>Program Title </td>
                                                        <td>Description</td>
                                                        <td>Duration</td>
                                                        <td>Funding Agency</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($list as $data)
                                                        <tr>
                                                            <td>{{ $data->program_title }}</td>
                                                            <td>{{ $data->program_description }}</td>
                                                            <td>
                                                                {{ $data->duration }}
                                                            </td>
                                                            @php
                                                                $fa = json_decode($data->funding_agency);
                                                                $fa = implode(', ', $fa);
                                                            @endphp
                                                            <td>{{ $fa }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- SUB-PROJECTS -->
                                        <div class="category my-5">
                                            <div class="notices mb-1 " style="border-left: 6px solid #0DA603;">
                                                <h5>List of <span class="font-weight-bold"
                                                        style=" color: #0DA603;">Sub-Project</span></h5>
                                            </div>
                                            <table class="table-bordered table table-hover">
                                                <thead style="background-color: #0DA603;">
                                                    <tr>
                                                        <td>Sub-Project Title </td>
                                                        <td>Description</td>
                                                        <td>Duration</td>
                                                        <td>Funding Agency</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($splist as $spl)
                                                        <tr>
                                                            <td>{{ $spl->sub_project_title }}</td>
                                                            <td>{{ $spl->sub_project_description }}</td>
                                                            <td>
                                                                {{ $spl->sub_project_duration }}
                                                            </td>
                                                            @php
                                                                $fa = json_decode($spl->sub_project_agency);
                                                                $fa = implode(', ', $fa);
                                                            @endphp
                                                            <td>{{ $fa }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Linkages forged and maintained -->
                                        <div class="category my-5">
                                            <div class="notices mb-1 " style="border-left: 6px solid #0DA603;">
                                                <h5><span class="font-weight-bold" style=" color: #0DA603;">Linkages
                                                        forged</span> and <span class="font-weight-bold"
                                                        style=" color: #0DA603;">maintained</span> </h5>
                                            </div>
                                            <table class="table-bordered table table-hover">
                                                <thead style="background-color: #0DA603;">
                                                    <tr>
                                                        <td>Agency/Institutions</td>
                                                        <td>Address</td>
                                                        <td>Year</td>
                                                        <td>Nature of Assistance / Linkages / Projects</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="4" style="background: #d3ffd1;"
                                                            class="font-weight-bold">DEVELOPED/NEW
                                                        </td>
                                                    </tr>
                                                    @foreach ($linkages_developed as $ld)
                                                        <tr>
                                                            <td>{{ $ld->form_of_development }}</td>
                                                            <td>{{ $ld->address }}</td>
                                                            <td>{{ $ld->year }}</td>
                                                            <td>
                                                                {{ $ld->nature_of_assistance }}
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    <tr>
                                                        <td colspan="4" style="background: #d3ffd1;"
                                                            class="font-weight-bold">
                                                            MAINTAINED/SUSTAINED</td>
                                                    </tr>

                                                    @foreach ($linkages_maintained as $lm)
                                                        <tr>
                                                            <td>{{ $lm->form_of_development }}</td>
                                                            <td>{{ $lm->address }}</td>
                                                            <td>{{ $lm->year }}</td>
                                                            <td>
                                                                {{ $lm->nature_of_assistance }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- List of database developed/enhanced and maintained.-->
                                        <div class="category my-5">
                                            <div class="notices mb-1 " style="border-left: 6px solid #0DA603;">
                                                <h5>List of<span class="font-weight-bold" style=" color: #0DA603;"> Database
                                                        developed/enhanced</span> and <span class="font-weight-bold"
                                                        style=" color: #0DA603;">maintained</span> </h5>
                                            </div>
                                            <table class="table-bordered table table-hover">
                                                <thead style="background-color: #0DA603;">
                                                    <tr>
                                                        <td>Title</td>
                                                        <td>Type of Database</td>
                                                        <td>Database Created</td>
                                                        <td>Purpose / Use</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($db as $db)
                                                        <tr>
                                                            <td>{{ $db->dbinfosys_title }}</td>
                                                            <td>{{ $db->dbinfosys_category }}</td>
                                                            <td>{{ date('m/d/Y', strtotime($db->dbinfosys_date_created)) }}
                                                            </td>
                                                            <td>{{ $db->dbinfosys_purpose }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- List of information system developed/enhanced and maintained.-->
                                        <div class="category my-5">
                                            <div class="notices mb-1 " style="border-left: 6px solid #0DA603;">
                                                <h5>List of<span class="font-weight-bold" style=" color: #0DA603;">
                                                        Information System
                                                        developed/enhanced</span> and <span class="font-weight-bold"
                                                        style=" color: #0DA603;">maintained</span> </h5>
                                            </div>
                                            <table class="table-bordered table table-hover">
                                                <thead style="background-color: #0DA603;">
                                                    <tr>
                                                        <td>Title</td>
                                                        <td>Type of Database</td>
                                                        <td>Database Created</td>
                                                        <td>Purpose / Use</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($is as $is)
                                                        <tr>
                                                            <td>{{ $is->dbinfosys_title }}</td>
                                                            <td>{{ $is->dbinfosys_category }}</td>

                                                            <td>{{ date('m/d/Y', strtotime($is->dbinfosys_date_created)) }}
                                                            </td>
                                                            <td>{{ $is->dbinfosys_purpose }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </section>

                                    <!-- Strategic Research & Development Activities -->
                                    <section class="table-area mt-4 page-break">
                                        <div class="table-title col-12 py-1"
                                            style="background-image: url('https://i.ibb.co/MpcC8d4/sec2.webp'); background-size:cover;">
                                            <h1 class="text-center text-capitalized font-weight-bold"
                                                style="color: #fff; text-shadow: 1px 1px 2px #1b1b1b; letter-spacing: -1px; ">
                                                STRATEGIC
                                                RESEARCH AND <br>DEVELOPMENT ACTIVITIES</h1>
                                        </div><br>

                                        <!-- List of R&D Programs/Projects Packaged, Approved and Implemented,CY 2022 -->
                                        <div class="category my-5">
                                            <div class="notices mb-1 " style="border-left: 6px solid #002E94;">
                                                <h5>List of <span class="font-weight-bold" style="color:#002E94;">Research
                                                        & Development
                                                        Programs/Projects Packaged, Approved </span>and <span
                                                        class="font-weight-bold" style="color:#002E94;">Implemented</span>
                                                </h5>
                                            </div>
                                            <table class="table-bordered table table-hover">
                                                <thead style="background-color: #002E94;">
                                                    <tr>
                                                        <td>Program / Project Title</td>
                                                        <td>Implementing Agency</td>
                                                        <td>Duration</td>
                                                        <td>Source of Funds</td>
                                                        <td>Budget</td>
                                                        <td>Regional Priority / Commodity Addressed</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="6" style="background: #ddffff; color: black;"
                                                            class="font-weight-bold">PROPOSALS PACKAGED</td>
                                                    </tr>
                                                    @foreach ($stratProgramListProposal as $splp)
                                                        <tr>
                                                            <td>{{ $splp->str_p_title }}</td>
                                                            @php
                                                                $imp = json_decode($splp->str_p_imp_agency);
                                                                $imp = implode(', ', $imp);

                                                                $sof = json_decode($splp->str_p_sof);
                                                                $sof = implode(', ', $sof);
                                                            @endphp
                                                            <td>{{ $imp }}</td>
                                                            <td>{{ $splp->str_p_date }}</td>
                                                            <td>{{ $sof }}</td>
                                                            <td>{{ number_format($splp->str_p_budget, 2) }}</td>
                                                            <td>{{ $splp->str_p_regional }}</td>
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="6" style="background: #ddffff; color: black;"
                                                            class="font-weight-bold">PROJECTS APPROVED AND IMPLEMENTED</td>
                                                    </tr>
                                                    @foreach ($stratProgramListApproved as $spla)
                                                        <tr>
                                                            <td>{{ $spla->str_p_title }}</td>
                                                            @php
                                                                $imp = json_decode($spla->str_p_imp_agency);
                                                                $imp = implode(', ', $imp);

                                                                $sof = json_decode($spla->str_p_sof);
                                                                $sof = implode(', ', $sof);
                                                            @endphp
                                                            <td>{{ $imp }}</td>
                                                            <td>{{ $spla->str_p_date }}</td>
                                                            <td>{{ $sof }}</td>
                                                            <td>{{ number_format($spla->str_p_budget, 2) }}</td>
                                                            <td>{{ $spla->str_p_regional }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <!-- Collaborative R&D Programs/Projects Implemented by the Consortium and Member-Agencies in support of regional priorities. -->
                                        <div class="category my-5">
                                            <div class="notices mb-1 " style="border-left: 6px solid #002E94;">
                                                <h5 class=" text-left">Collaborative <span class="font-weight-bold"
                                                        style="color:#002E94;">Research & Development Programs/Projects
                                                        Implemented </span> by
                                                    the <span class="font-weight-bold" style="color:#002E94;"> Consortium
                                                    </span> and <span class="font-weight-bold"
                                                        style="color:#002E94;">Member-Agencies in
                                                        support of regional priorities</span></h5>
                                            </div>

                                            <table class="table-bordered table table-hover" style="font-size: 5px;">
                                                <thead style="background-color: #002E94;">
                                                    <tr>
                                                        <td>Program Title</td>
                                                        <td>Project Title</td>
                                                        <td>Implementing Agency</td>
                                                        <td>Collaborating Agency</td>
                                                        <td>Duration</td>
                                                        <td>Budget</td>
                                                        <td>Source(s) of Fund</td>
                                                        <td>Role of Consortium</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($strat_collaborative as $item)
                                                        @php
                                                            if (!empty($item->str_collab_imp_agency)) {
                                                                $imp = json_decode($item->str_collab_imp_agency);
                                                                $imp = implode(', ', $imp);
                                                            }

                                                            if (!empty($item->str_collab_agency)) {
                                                                $collab = json_decode($item->str_collab_agency);
                                                                $collab = implode(', ', $collab);
                                                            }

                                                            if (!empty($item->str_collab_sof)) {
                                                                $sof = json_decode($item->str_collab_sof);
                                                                $sof = implode(', ', $sof);
                                                            }

                                                            [$startDateString, $endDateString] = explode(' to ', $item->str_collab_date);
                                                            $startDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($startDateString));
                                                            $endDate = \Carbon\Carbon::createFromFormat('m/d/Y', trim($endDateString));
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $item->str_collab_program }}</td>
                                                            <td>{{ $item->str_collab_project }}</td>
                                                            <td>
                                                                {{ $imp }}
                                                            </td>
                                                            <td>
                                                                {{ $collab }}
                                                            </td>
                                                            <td>
                                                                {{ $startDate->format('F Y') }} to
                                                                {{ $endDate->format('F Y') }}
                                                            </td>
                                                            <td>{{ number_format($item->str_collab_budget) }}</td>
                                                            <td>{{ $sof }}</td>
                                                            <td>{{ $item->str_collab_roc }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- 9. List of Technologies/ Information Generated from R&D, CY 2022 -->
                                        <div class="category my-5">
                                            <div class="notices mb-1 " style="border-left: 6px solid #002E94;">
                                                <h5 class=" text-left">List of <span class="font-weight-bold"
                                                        style="color:#002E94;">Technologies / Information </span> Generated
                                                    from <span class="font-weight-bold" style="color:#002E94;"> Research
                                                        and Development
                                                    </span></h5>
                                            </div>

                                            <table class="table-bordered table table-hover" style="font-size: 5px;">
                                                <thead style="background-color: #002E94;">
                                                    <tr>
                                                        <td>Title of Technology</td>
                                                        <td>Agency</td>
                                                        <td>Researcher(s)</td>
                                                        <td>Potential Impact or Contribution</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="6" style="background: #ddffff; color: black;"
                                                            class="font-weight-bold">RESEARCH</td>
                                                    </tr>
                                                    @foreach ($strat_tech_research as $item)
                                                        @php
                                                            $res = json_decode($item->tech_researchers);
                                                            $res = implode(', ', $res);
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $item->tech_title }}</td>
                                                            <td>{{ $item->tech_agency }}</td>
                                                            <td>{{ $res }}</td>
                                                            <td>{{ $item->tech_impact }}</td>
                                                        </tr>
                                                    @endforeach

                                                    <tr>
                                                        <td colspan="6" style="background: #ddffff; color: black;"
                                                            class="font-weight-bold">DEVELOPMENT</td>
                                                    </tr>
                                                    @foreach ($strat_tech_dev as $item)
                                                        @php
                                                            $res = json_decode($item->tech_researchers);
                                                            $res = implode(', ', $res);
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $item->tech_title }}</td>
                                                            <td>{{ $item->tech_agency }}</td>
                                                            <td>{{ $res }}</td>
                                                            <td>{{ $item->tech_impact }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </section>

                                    <!-- R & D Results Utilization-->
                                    <section class="table-area mt-4 page-break">

                                        <div class="table-title col-12 py-1"
                                            style="background-image: url('https://i.ibb.co/0Z2VpgB/sec3.webp'); background-size:cover;;">
                                            <h1 class="text-center text-capitalized font-weight-bold"
                                                style="color: #fff; text-shadow: 1px 1px 2px #1b1b1b; letter-spacing: -1px; ">
                                                RESEARCH AND
                                                DEVELOPMENT<br>RESULTS UTILIZATION</h1>
                                        </div>

                                        <!-- Data from "Technology Transfer Proposals -->
                                        <div class="category my-5">
                                            <div class="notices mb-1 " style="border-left: 6px solid #3D30A2;">
                                                <h5>List of <span class="font-weight-bold" style="color:#3D30A2;">
                                                        Technology Transfer
                                                        Program/Projects Packaged, Approved </span>and <span
                                                        class="font-weight-bold" style="color:#002E94;">Implemented</span>
                                                </h5>
                                            </div>

                                            <table class="table-bordered table table-hover">
                                                <thead style="background-color: #3D30A2;">
                                                    <tr>
                                                        <td>Program / Project Title</td>
                                                        <td>Proponent</td>
                                                        <td>Implementing Agency</td>
                                                        <td>Durataion</td>
                                                        <td>Source of Funds</td>
                                                        <td>Budget</td>
                                                        <td>Regional <br>Priority/ <br> Commodities <br> Addressed</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="7" style="background: #DFCCFB; color: black;"
                                                            class="font-weight-bold">PROPOSALS PACKAGED</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Native Animals Fair</td>
                                                        <td>PCAARRD</td>
                                                        <td>
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item">TAU</li>
                                                                <li class="list-group-item">CLSU</li>
                                                                <li class="list-group-item">PRMSU</li>
                                                            </ul>
                                                        </td>
                                                        <td>01/02/2020 - 09/20/2023</td>
                                                        <td>PCAARRD</td>
                                                        <td>4,690,222</td>
                                                        <td>Livestock - Itik Pinas</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="7" style="background: #DFCCFB; color: black;"
                                                            class="font-weight-bold">PROJECTS APPROVED AND IMPLEMENTED</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Let’s Doe Business: A Livelihood Opportunity in Response to
                                                            COVID 19 Pandemic for
                                                            Small hold Farms through Production of Dairy Goats</td>
                                                        <td>
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item">Mark Nell Corpuz</li>
                                                                <li class="list-group-item">MF Damaso, Marz</li>
                                                                <li class="list-group-item">Linnaeous L.</li>
                                                            </ul>
                                                        </td>
                                                        <td>CLSU</td>
                                                        <td>01/02/2020 - 09/20/2023</td>
                                                        <td>PCAARRD</td>
                                                        <td>4,690,222</td>
                                                        <td>Goat</td>
                                                    </tr>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!--  Data from "Technology Transfer Modalities-->
                                        <div class="category my-5">
                                            <div class="notices mb-1 " style="border-left: 6px solid #3D30A2;">
                                                <h5>List of <span class="font-weight-bold" style="color:#3D30A2;">
                                                        Technologies Commercialized
                                                    </span>or <span class="font-weight-bold"
                                                        style="color:#002E94;">Pre-Commercialization
                                                        Initiatives</span></h5>
                                            </div>

                                            <table class="table-bordered table table-hover">
                                                <thead style="background-color: #3D30A2;">
                                                    <tr>
                                                        <td>Type of IPR Applies</td>
                                                        <td>Technologies</td>
                                                        <td>Agency</td>
                                                        <td>Status</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Copyright</td>
                                                        <td>CLSU Special Purpose Rice </td>
                                                        <td>CLSU</td>
                                                        <td>Application No. O2022-66 / March 2, 2022</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <!--  Data from "Technology Promotion Approches-->
                                        <div class="category my-5">
                                            <div class="notices mb-1 " style="border-left: 6px solid #3D30A2;">
                                                <h5>List of <span class="font-weight-bold"
                                                        style="color:#3D30A2;">Technology Promotion
                                                        Approaches </span></h5>
                                            </div>
                                            <table class="table-bordered table table-hover">
                                                <thead style="background-color: #3D30A2;">
                                                    <tr>
                                                        <td>Technology Promotion Approaches </td>
                                                        <td>Title</td>
                                                        <td>Remarks</td>
                                                        <td>Details</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Regional FIESTA</td>
                                                        <td>Smart Farming was presented during the Veggie FIESTA on
                                                            technology pitching</td>
                                                        <td>CLSU</td>
                                                        <td>Lorem Ipsum </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </section>

                                    <!-- Capability Building and Governance-->
                                    {{-- <section class="table-area mt-4 page-break">
                        
                                        <div class="table-title col-12 py-1"
                                            style="background-image: url('https://i.ibb.co/NCMBtB8/sec4.webp'); background-size:cover;;">
                                            <h1 class="text-center text-capitalized font-weight-bold"
                                                style="color: #fff; text-shadow: 1px 1px 2px #1b1b1b; letter-spacing: -1px; ">CAPABILITY
                                                BUILDING<br>AND GOVERNANCE</h1>
                                        </div>
                        
                                        <!-- Data from "Trainings-Workshop" -->
                                        <div class="category my-5">
                                            <div class="notices mb-1 " style="border-left: 6px solid #FF8400;">
                                                <h5>List of <span class="font-weight-bold" style="color:#FF8400;"> non-degree trainings
                                                        conducted/facilitated </span></h5>
                                            </div>
                                            <table class="table-bordered table table-hover">
                                                <thead style="background-color: #FF8400;">
                                                    <tr>
                                                        <td>Title of Activity</td>
                                                        <td>Date</td>
                                                        <td>Venue</td>
                                                        <td>Number of Participants</td>
                                                        <td>Expenditures</td>
                                                        <td>Source(s) of Funds</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Training Workshop on Social Media (SocMed) Management and Content Development</td>
                                                        <td>March 17 - 18, 2022</td>
                                                        <td>CLSU</td>
                                                        <td>30</td>
                                                        <td>N/A</td>
                                                        <td>
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item">PCAARRD</li>
                                                                <li class="list-group-item">CLAARRDEC</li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                        
                                        <!-- Equipments and Facilities" -->
                                        <div class="category my-5">
                                            <div class="notices mb-1 " style="border-left: 6px solid #FF8400;">
                                                <h5><span class="font-weight-bold" style="color:#FF8400;">Equipment</span> and <span
                                                        class="font-weight-bold" style="color:#FF8400;">Facilities
                                                        Established/Installed/Acquired/Funded</span></h5>
                                            </div>
                                            <table class="table-bordered table table-hover">
                                                <thead style="background-color: #FF8400;">
                                                    <tr>
                                                        <td class="text-center">Equipment/ <br>Facilities Established<br>/Upgraded/<br>Approved
                                                        </td>
                                                        <td>Name of Equipment</td>
                                                        <td>Agency</td>
                                                        <td>Expenditures</td>
                                                        <td>Source(s) of Funds</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Facilities Established</td>
                                                        <td>Construction of BASC Swine Multiplier & Technodemo Farm</td>
                                                        <td>BSAC</td>
                                                        <td>126, 950.00</td>
                                                        <td>DA-BAYANIHAN 2</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                        
                                        <!-- Awards Received" -->
                                        <div class="category my-5">
                                            <div class="notices mb-1 " style="border-left: 6px solid #FF8400;">
                                                <h5><span class="font-weight-bold" style="color:#FF8400;">Awards Received</span> by the<span
                                                        class="font-weight-bold" style="color:#FF8400;"> consortium </span> or <span
                                                        class="font-weight-bold" style="color:#FF8400;"> member-agencies</span></h5>
                                            </div>
                                            <table class="table-bordered table table-hover">
                                                <thead style="background-color: #FF8400;">
                                                    <tr>
                                                        <td class="text-center">Type of Award</td>
                                                        <td>Title</td>
                                                        <td>Recipient/Agency</td>
                                                        <td>Sponsor</td>
                                                        <td>Event/Activity</td>
                                                        <td>Place of Award</td>
                                                        <td>Date</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>REGIONAL</td>
                                                        <td>Awards Title Sample</td>
                                                        <td>Health Beyond Bars and Community-Based Rice Mushroom Production/BPSU</td>
                                                        <td>Civil Service Commission</td>
                                                        <td>CSC 2022 Honor Awards Programs</td>
                                                        <td>San Fernando, Pampanga</td>
                                                        <td>September 6, 2022</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                        
                                    </section> --}}

                                    {{-- <div class="report-footer mt-5">
                                        <p class="text-center">
                                            This is generated report from <span class="text-success">CLAARDEC Real-Time Monitoring
                                                System</span><br>
                                            <span class="mx-1 sm"><i class="fas fa-mobile-alt mx-1 text-success"></i>0945 498 6941</span>
                                            <span class="mx-1 sm"><i class="fas fa-envelope mx-1 text-success"></i>claardec@clsu.edu.ph</span>
                                            <span class="mx-1 sm"><i
                                                    class="fas fa-globe mx-1 text-success"></i></i>www.rtms.claarrdec.gov.ph</span>
                                        </p>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
        </section>
    </div>
@endsection
