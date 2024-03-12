@extends('backend.layouts.app')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{-- <h1 class="m-0">{{ auth()->user()->role }} - Manage Accounts</h1> --}}
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Home</a></li>
                            <li class="breadcrumb-item active">Filtered Report</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <form action="{{ route('records.filter') }}" method="POST">
                                    @csrf
                                    <select name="duration" id="yearSelect" style="width: 150px">
                                        <option value="">Select Year</option>
                                        @for ($year = 2018; $year <= 2050; $year++)
                                            <option value="{{ $year }}"
                                                {{ old('duration') == $year ? 'selected' : '' }}>{{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                    <button type="submit" class="btn btn-success">Filter</button>
                                    <a href="{{ url('records') }}" class="btn btn-primary">Clear</a>
                                </form>
                                <!-- /.card-tools -->
                            </div>

                            {{-- Summary AIHRS --}}
                            <div class="card-body">
                                <h5>Summary of the AIHR's conducted by the CMI's</h5>
                                <table class="table table-bordered table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th rowspan="2">Agency</th>
                                            <th colspan="5" style="text-align: center">Number of Projects Presented</th>
                                        </tr>
                                        <tr class="th-filtered">
                                            <th style="">New</th>
                                            <th>Ongoing</th>
                                            <th>Terminated</th>
                                            <th>Completed</th>
                                            <th>Total Projects Reviewed</th>
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
                                                <tr class="td-filtered">
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

                            <!-- /.card-header -->
                            <div class="card-body">
                                <!-- Programs Table -->
                                <h5>Programs</h5>
                                <table id="programsTable" class="table table-bordered table-striped">
                                    <!-- Table headers -->
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th>Fund Code</th>
                                            <th>Program Title</th>
                                            <th>Program Leader</th>
                                            <th>Duration</th>
                                            <th>Funding Agency</th>
                                            <th>Implementing Agency</th>
                                            <th>Collaborating Agency</th>
                                            <th>R & D Center</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <!-- Table body to be filled by AJAX response -->
                                    <tbody>
                                        <!-- Data will be filled dynamically -->
                                        @foreach ($records as $key => $row)
                                            <tr class="td-filtered">
                                                @php
                                                    if (!empty($row->implementing_agency)) {
                                                        $imp = json_decode($row->implementing_agency);
                                                        $imp = implode(', ', $imp);
                                                    }

                                                    if ($row->collaborating_agency == 'null') {
                                                        $collab = 'N/A';
                                                    } else {
                                                        $collab = json_decode($row->collaborating_agency);
                                                        $collab = implode(', ', $collab);
                                                    }

                                                    if (!empty($row->funding_agency)) {
                                                        $funding = json_decode($row->funding_agency);
                                                        $funding = implode(', ', $funding);
                                                    }

                                                    $rc = $row->research_center;
                                                    // Check if $rc is [null]
                                                    if ($rc === '[null]') {
                                                        $rc = 'N/A';
                                                    } else {
                                                        // If $rc is not [null], perform the replacements
                                                        $rc = str_replace(['[', '"', ']'], '', $rc);
                                                        $rc = str_replace(',', ', ', $rc);
                                                    }
                                                @endphp
                                                <td>
                                                    @if (!empty($row->fund_code))
                                                        {{ $row->fund_code }}
                                                    @else
                                                        {{ 'N/A' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ strtoupper($row->program_title) }}
                                                </td>
                                                <td>
                                                    @php
                                                        $leader = App\Models\Researchers::find($row->program_leader);
                                                    @endphp
                                                    {{ $leader->first_name . ' ' . $leader->last_name }}
                                                </td>
                                                <td>
                                                    {{ $row->duration }}
                                                </td>
                                                <td>{{ $funding }}</td>

                                                <td>{{ $imp }} </td>
                                                <td>{{ $collab }}</td>
                                                <td>{{ $rc }}</td>
                                                <td>
                                                    {{ $row->program_description }}
                                                </td>
                                                <td>
                                                    @if ($row->program_status == 'New')
                                                        {{ $row->program_status }}
                                                        <i class="fa-regular fa-square-plus" style="color: #0dcaf0;"></i>
                                                    @elseif ($row->program_status == 'Ongoing')
                                                        {{ $row->program_status }}
                                                        <i class="fa-solid fa-spinner fa-spin" style="color: #0d6efd"></i>
                                                    @elseif ($row->program_status == 'Terminated')
                                                        {{ $row->program_status }}
                                                        <i class="fa-regular fa-circle-xmark" style="color: #ff0000;"></i>
                                                    @elseif ($row->program_status == 'Completed')
                                                        {{ $row->program_status }}
                                                        <i class="fa-regular fa-circle-check" style="color: #28a745;"></i>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Projects --}}
                            <div class="card-body">
                                <h5>Projects</h5>
                                <table id="projectsTable" class="table table-bordered table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th>Fund Code</th>
                                            <th>Program</th>
                                            <th>Project Title</th>
                                            <th>Project Leader</th>
                                            <th>Duration</th>
                                            <th>Funding Agency</th>
                                            <th>Implementing Agency</th>
                                            <th>Collaborating Agency</th>
                                            <th>R & D Center</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($p_records as $row)
                                            <tr class="td-filtered">
                                                @php
                                                    $program = DB::table('programs')
                                                        ->select('program_title')
                                                        ->where('programID', '=', $row->programID)
                                                        ->first(); // Execute the query to fetch the result
                                                @endphp

                                                <td>
                                                    @if (!empty($row->project_fund_code))
                                                        {{ $row->project_fund_code }}
                                                    @else
                                                        {{ 'N/A' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($program)
                                                        {{ strtoupper($program->program_title) }}
                                                    @else
                                                        {{ 'N/A' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ strtoupper($row->project_title) }}
                                                </td>
                                                <td>
                                                    @php
                                                        $leader = App\Models\Researchers::find($row->project_leader);
                                                    @endphp
                                                    {{ $leader->first_name . ' ' . $leader->last_name }}
                                                </td>
                                                <td>
                                                    {{ $row->project_duration }}
                                                </td>
                                                @php
                                                    if (!empty($row->project_implementing_agency)) {
                                                        $imp = json_decode($row->project_implementing_agency);
                                                        $imp = implode(', ', $imp);
                                                    }

                                                    if ($row->project_collaborating_agency == 'null') {
                                                        $collab = 'N/A';
                                                    } else {
                                                        $collab = json_decode($row->project_collaborating_agency);
                                                        $collab = implode(', ', $collab);
                                                    }

                                                    if (!empty($row->project_agency)) {
                                                        $funding = json_decode($row->project_agency);
                                                        $funding = implode(', ', $funding);
                                                    }
                                                    $rc = $row->project_research_center;

                                                    // Check if $rc is [null]
                                                    if ($rc === '[null]') {
                                                        $rc = 'N/A';
                                                    } else {
                                                        // If $rc is not [null], perform the replacements
                                                        $rc = str_replace(['[', '"', ']'], '', $rc);
                                                        $rc = str_replace(',', ', ', $rc);
                                                    }
                                                @endphp

                                                <td>{{ $funding }}</td>

                                                <td>{{ $imp }} </td>
                                                <td>{{ $collab }}</td>
                                                <td>{{ $rc }}</td>

                                                <td>{{ $row->project_description }}
                                                </td>
                                                <td>
                                                    @if ($row->project_status == 'New')
                                                        {{ $row->project_status }}
                                                        <i class="fa-regular fa-square-plus" style="color: #0dcaf0;"></i>
                                                    @elseif ($row->project_status == 'Ongoing')
                                                        {{ $row->project_status }}
                                                        <i class="fa-solid fa-spinner fa-spin" style="color: #0d6efd"></i>
                                                    @elseif ($row->project_status == 'Terminated')
                                                        {{ $row->project_status }}
                                                        <i class="fa-regular fa-circle-xmark" style="color: #ff0000;"></i>
                                                    @elseif ($row->project_status == 'Completed')
                                                        {{ $row->project_status }}
                                                        <i class="fa-regular fa-circle-check" style="color: #28a745;"></i>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Sub Projects --}}
                            <div class="card-body">
                                <h5>Sub Projects/Studies</h5>
                                <table id="subProjectsTable" class="table table-bordered table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th>Fund Code</th>
                                            <th>Project</th>
                                            <th>Sub Project/Study Title</th>
                                            <th>Sub Project/Study Leader</th>
                                            <th>Duration</th>
                                            <th>Funding Agency</th>
                                            <th>Implementing Agency</th>
                                            <th>Collaborating Agency</th>
                                            <th>R & D Center</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sp_records as $row)
                                            <tr class="td-filtered">
                                                @php
                                                    $project = DB::table('projects')
                                                        ->select('project_title')
                                                        ->where('id', '=', $row->projectID)
                                                        ->first(); // Execute the query to fetch the result
                                                @endphp
                                                <td>
                                                    @if (!empty($row->sub_project_fund_code))
                                                        {{ $row->sub_project_fund_code }}
                                                    @else
                                                        {{ 'N/A' }}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ strtoupper($project->project_title) }}
                                                </td>
                                                <td>
                                                    {{ strtoupper($row->sub_project_title) }}
                                                </td>
                                                <td>
                                                    @php
                                                        $leader = App\Models\Researchers::find(
                                                            $row->sub_project_leader,
                                                        );
                                                    @endphp
                                                    {{ $leader->first_name . ' ' . $leader->last_name }}
                                                </td>
                                                <td>
                                                    {{ $row->sub_project_duration }}
                                                </td>
                                                @php
                                                    if (!empty($row->sub_project_implementing_agency)) {
                                                        $imp = json_decode($row->sub_project_implementing_agency);
                                                        $imp = implode(', ', $imp);
                                                    }

                                                    if ($row->sub_project_collaborating_agency == 'null') {
                                                        $collab = 'N/A';
                                                    } else {
                                                        $collab = json_decode($row->sub_project_collaborating_agency);
                                                        $collab = implode(', ', $collab);
                                                    }

                                                    if (!empty($row->sub_project_agency)) {
                                                        $funding = json_decode($row->sub_project_agency);
                                                        $funding = implode(', ', $funding);
                                                    }

                                                    $rc = $row->sub_project_research_center;
                                                    if ($rc === '[null]') {
                                                        $rc = 'N/A';
                                                    } else {
                                                        // If $rc is not [null], perform the replacements
                                                        $rc = str_replace(['[', '"', ']'], '', $rc);
                                                        $rc = str_replace(',', ', ', $rc);
                                                    }
                                                @endphp
                                                <td>{{ $funding }}</td>

                                                <td>{{ $imp }} </td>
                                                <td>{{ $collab }}</td>
                                                <td>{{ $rc }}</td>
                                                <td>{{ $row->sub_project_description }}
                                                </td>
                                                <td>
                                                    @if ($row->sub_project_status == 'New')
                                                        {{ $row->sub_project_status }}
                                                        <i class="fa-regular fa-square-plus" style="color: #0dcaf0;"></i>
                                                    @elseif ($row->sub_project_status == 'Ongoing')
                                                        {{ $row->sub_project_status }}
                                                        <i class="fa-solid fa-spinner fa-spin" style="color: #0d6efd"></i>
                                                    @elseif ($row->sub_project_status == 'Terminated')
                                                        {{ $row->sub_project_status }}
                                                        <i class="fa-regular fa-circle-xmark" style="color: #ff0000;"></i>
                                                    @elseif ($row->sub_project_status == 'Completed')
                                                        {{ $row->sub_project_status }}
                                                        <i class="fa-regular fa-circle-check" style="color: #28a745;"></i>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- RDMC LINKAGES --}}
                            <div class="card-body">
                                <h5>Linkages forged and maintained</h5>
                                <table id="subProjectsTable" class="table table-bordered table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th>Agency/Institutions</th>
                                            <th>Address</th>
                                            <th>Year</th>
                                            <th>Nature of Assistance / Linkages / Projects</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="td-filtered">
                                            <td colspan="4"
                                                style="background: #d3ffd1; color: black; text-align: center;"
                                                class="font-weight-bold">
                                                DEVELOPED/NEW
                                            </td>
                                        </tr>
                                        @foreach ($linkages_developed as $ld)
                                            <tr class="td-filtered">
                                                <td>{{ $ld->form_of_development }}</td>
                                                <td>{{ $ld->address }}</td>
                                                <td>{{ $ld->year }}</td>
                                                <td>
                                                    {{ $ld->nature_of_assistance }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="td-filtered">
                                            <td colspan="4"
                                                style="background: #d3ffd1; color: black; text-align: center;"
                                                class="font-weight-bold">
                                                MAINTAINED/SUSTAINED</td>
                                        </tr>

                                        @foreach ($linkages_maintained as $lm)
                                            <tr class="td-filtered">
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

                            {{-- DBIS --}}
                            <div class="card-body">
                                <h5>Database and Information System</h5>
                                <table class="table table-bordered table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th>Title</th>
                                            <th>Type of Database/Information System</th>
                                            <th>Date Created</th>
                                            <th>Purpose / Use</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="td-filtered">
                                            <td colspan="4"
                                                style="background: #d3ffd1; color: black; text-align: center;"
                                                class="font-weight-bold">
                                                DATABASE DEVELOPED/ENHANCED AND MAINTAINED
                                            </td>
                                        </tr>
                                        @foreach ($db as $db)
                                            <tr class="td-filtered">
                                                <td>{{ $db->dbinfosys_title }}</td>
                                                <td>{{ $db->dbinfosys_type }}</td>
                                                <td>{{ date('m/d/Y', strtotime($db->dbinfosys_date_created)) }}
                                                </td>
                                                <td>{{ $db->dbinfosys_purpose }}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="td-filtered">
                                            <td colspan="4"
                                                style="background: #d3ffd1; color: black; text-align: center;"
                                                class="font-weight-bold">
                                                INFORMATION SYSTEM DEVELOPED/ENHANCED AND MAINTAINED
                                            </td>
                                        </tr>
                                        @foreach ($is as $is)
                                            <tr class="td-filtered">
                                                <td>{{ $is->dbinfosys_title }}</td>
                                                <td>{{ $is->dbinfosys_type }}</td>

                                                <td>{{ date('m/d/Y', strtotime($is->dbinfosys_date_created)) }}
                                                </td>
                                                <td>{{ $is->dbinfosys_purpose }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- STRATEGIC PROGRAM LIST --}}
                            <div class="card-body">
                                <h5>Research & Development Programs/Projects Packaged, Approved and Implemented</h5>
                                <table class="table-bordered table table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th>Program / Project Title</th>
                                            <th>Implementing Agency</td>
                                            <th>Duration</th>
                                            <th>Source of Funds</th>
                                            <th>Budget</th>
                                            <th>Regional Priority / Commodity Addressed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="td-filtered">
                                            <td colspan="6"
                                                style="background: #ddffff; color: black; text-align: center;"
                                                class="font-weight-bold">PROPOSALS PACKAGED</td>
                                        </tr>
                                        @foreach ($stratProgramListProposal as $splp)
                                            <tr class="td-filtered">
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
                                                <td>₱{{ number_format($splp->str_p_budget, 2) }}</td>
                                                <td>{{ $splp->str_p_regional }}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="td-filtered">
                                            <td colspan="6"
                                                style="background: #ddffff; color: black; text-align: center;"
                                                class="font-weight-bold">PROJECTS APPROVED AND IMPLEMENTED</td>
                                        </tr>
                                        @foreach ($stratProgramListApproved as $spla)
                                            <tr class="td-filtered">
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
                                                <td>₱{{ number_format($spla->str_p_budget, 2) }}</td>
                                                <td>{{ $spla->str_p_regional }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- STRATEGIC COLLABORATIVE --}}
                            <div class="card-body">
                                <h5>Collaborative Research & Development Programs/Projects Implemented by the Consortium and
                                    Member-Agencies in support of regional priorities</h5>
                                <table class="table-bordered table table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th>Program Title</th>
                                            <th>Project Title</th>
                                            <th>Implementing Agency</th>
                                            <th>Collaborating Agency</th>
                                            <th>Duration</th>
                                            <th>Budget</th>
                                            <th>Source(s) of Fund</th>
                                            <th>Role of Consortium</th>
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

                                                [$startDateString, $endDateString] = explode(
                                                    ' to ',
                                                    $item->str_collab_date,
                                                );
                                                $startDate = \Carbon\Carbon::createFromFormat(
                                                    'm/d/Y',
                                                    trim($startDateString),
                                                );
                                                $endDate = \Carbon\Carbon::createFromFormat(
                                                    'm/d/Y',
                                                    trim($endDateString),
                                                );

                                            @endphp
                                            <tr class="td-filtered">
                                                <td>{{ $item->str_collab_program }}</td>
                                                <td>{{ $item->str_collab_project }}</td>
                                                <td>
                                                    {{ $imp }}
                                                </td>
                                                <td>
                                                    {{ $collab }}
                                                </td>
                                                <td>
                                                    @if ($startDate == $endDate)
                                                        {{ $startDate }}
                                                    @else
                                                        {{ $startDate->format('F Y') }} to
                                                        {{ $endDate->format('F Y') }}
                                                    @endif
                                                </td>
                                                <td>₱{{ number_format($item->str_collab_budget, 2) }}</td>
                                                <td>{{ $sof }}</td>
                                                <td>{{ $item->str_collab_roc }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- STRATEGIC List of Technologies / Information Generated from Research and Development --}}
                            <div class="card-body">
                                <h5>List of Technologies / Information Generated from Research and Development</h5>
                                <table class="table-bordered table table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th>Title of Technology</th>
                                            <th>Agency</th>
                                            <th>Researcher(s)</th>
                                            <th>Duration</th>
                                            <th>Potential Impact or Contribution</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="td-filtered">
                                            <td colspan="6"
                                                style="background: #ddffff; color: black; text-align:center;"
                                                class="font-weight-bold">RESEARCH</td>
                                        </tr>
                                        @foreach ($strat_tech_research as $item)
                                            @php
                                                $res = json_decode($item->tech_researchers);
                                                $res = implode(', ', $res);
                                            @endphp
                                            <tr class="td-filtered">
                                                <td>{{ $item->tech_title }}</td>
                                                <td>{{ $item->tech_agency }}</td>
                                                <td>{{ $res }}</td>
                                                <td>{{ $item->tech_duration }}</td>
                                                <td>{{ $item->tech_impact }}</td>
                                            </tr>
                                        @endforeach

                                        <tr class="td-filtered">
                                            <td colspan="6"
                                                style="background: #ddffff; color: black; text-align: center;"
                                                class="font-weight-bold">DEVELOPMENT</td>
                                        </tr>
                                        @foreach ($strat_tech_dev as $item)
                                            @php
                                                $res = json_decode($item->tech_researchers);
                                                $res = implode(', ', $res);
                                            @endphp
                                            <tr class="td-filtered">
                                                <td>{{ $item->tech_title }}</td>
                                                <td>{{ $item->tech_agency }}</td>
                                                <td>{{ $res }}</td>
                                                <td>{{ $item->tech_duration }}</td>
                                                <td>{{ $item->tech_impact }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- RDRU TTP --}}
                            <div class="card-body">
                                <h5>Technology Transfer Program/Projects Packaged, Approved and Implemented</h5>
                                <table class="table-bordered table table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th>Program / Project Title</th>
                                            <th>Proponent</th>
                                            <th>Implementing Agency</th>
                                            <th>Duration</th>
                                            <th>Source of Funds</th>
                                            <th>Budget</th>
                                            <th>Regional Priority/ Commodities Addressed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="td-filtered">
                                            <td colspan="7"
                                                style="background: #b8b8ff; color: black; text-align: center;"
                                                class="font-weight-bold">
                                                PROPOSALS PACKAGED</td>
                                        </tr>
                                        @foreach ($ttp_proposal as $item)
                                            @php
                                                $prop = json_decode($item->ttp_proponent);
                                                $prop = implode(', ', $prop);

                                                $rs = json_decode($item->ttp_researchers);
                                                $rs = implode(', ', $rs);

                                                $imp = json_decode($item->ttp_implementing_agency);
                                                $imp = implode(', ', $imp);

                                                $sof = json_decode($item->ttp_sof);
                                                $sof = implode(', ', $sof);
                                            @endphp
                                            <tr class="td-filtered">
                                                <td>{{ $item->ttp_title }}</td>
                                                <td>{{ $prop . ' / ' . $rs }}</td>
                                                <td>{{ $imp }}</td>
                                                <td>{{ $item->ttp_date }}</td>
                                                <td>{{ $sof }}</td>
                                                <td>₱{{ number_format($item->ttp_budget, 2) }}</td>
                                                <td>{{ $item->ttp_priorities }}</td>
                                            </tr>
                                        @endforeach
                                        <tr class="td-filtered">
                                            <td colspan="7"
                                                style="background: #b8b8ff; color: black; text-align: center;"
                                                class="font-weight-bold">PROJECTS APPROVED AND IMPLEMENTED
                                            </td>
                                        </tr>

                                        @foreach ($ttp_approved as $item)
                                            @php
                                                $prop = json_decode($item->ttp_proponent);
                                                $prop = implode(', ', $prop);

                                                $rs = json_decode($item->ttp_researchers);
                                                $rs = implode(', ', $rs);

                                                $imp = json_decode($item->ttp_implementing_agency);
                                                $imp = implode(', ', $imp);

                                                $sof = json_decode($item->ttp_sof);
                                                $sof = implode(', ', $sof);
                                            @endphp
                                            <tr class="td-filtered">
                                                <td>{{ $item->ttp_title }}</td>
                                                <td>{{ $prop . ' / ' . $rs }}</td>
                                                <td>{{ $imp }}</td>
                                                <td>{{ $item->ttp_date }}</td>
                                                <td>{{ $sof }}</td>
                                                <td>₱{{ number_format($item->ttp_budget, 2) }}</td>
                                                <td>{{ $item->ttp_priorities }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- RDRU TTM --}}
                            <div class="card-body">
                                <h5>Technologies Commercialized or Pre-Commercialization Initiatives</h5>
                                <table class="table-bordered table table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th>Type of IPR Applies</th>
                                            <th>Technologies</th>
                                            <th>Agency</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tech_commercialized as $item)
                                            <tr class="td-filtered">
                                                <td>{{ $item->ttm_type }}</td>
                                                <td>{{ $item->ttm_title }}</td>
                                                <td>{{ $item->ttm_agency }}</td>
                                                <td>{{ ucwords($item->ttm_status) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- RDRU TPA --}}
                            <div class="card-body">
                                <h5>Technology Promotion Approaches</h5>
                                <table class="table-bordered table table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th>Technology Promotion Approaches </th>
                                            <th>Title</th>
                                            <th>Remarks</th>
                                            <th>Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tpa as $item)
                                            @php
                                                $approaches = json_decode($item->tpa_approaches);
                                                $approaches = implode(', ', $approaches);
                                            @endphp
                                            <tr class="td-filtered">
                                                <td>{{ $approaches }}</td>
                                                <td>{{ $item->tpa_title }}</td>
                                                <td>{{ $item->tpa_agency }}</td>
                                                <td>{{ $item->tpa_details }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Trainings/Workshop --}}
                            <div class="card-body">
                                <h5>Non-degree trainings conducted/facilitated
                                </h5>
                                <table class="table-bordered table table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th>Title of Activity</th>
                                            <th>Date</th>
                                            <th>Venue</th>
                                            <th>Number of Participants</th>
                                            <th>Expenditures</th>
                                            <th>Source(s) of Funds</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($trainings as $item)
                                            @php
                                                $sof = json_decode($item->trainings_sof);
                                                $sof = implode(', ', $sof);

                                                $participants = DB::table('training_participants')
                                                    ->select('type_of_participants', 'no_of_participants')
                                                    ->where('training_id', '=', $item->id)
                                                    ->get();
                                            @endphp
                                            <tr class="td-filtered">
                                                <td>{{ $item->trainings_title }}</td>
                                                <td>{{ $item->trainings_start }}</td>
                                                <td>{{ $item->trainings_venue }}</td>
                                                <td>
                                                    @foreach ($participants as $participant)
                                                        <li>{{ $participant->type_of_participants }}
                                                            ({{ $participant->no_of_participants }})
                                                        </li>
                                                    @endforeach
                                                </td>
                                                <td>₱{{ number_format($item->trainings_expenditures, 2) }}</td>
                                                <td>{{ $sof }}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Equipment and Facilities Established/Installed/Acquired/Funded --}}
                            <div class="card-body">
                                <h5>Equipment and Facilities Established/Installed/Acquired/Funded
                                </h5>
                                <table class="table-bordered table table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th class="text-center">Equipment/ <br>Facilities
                                                Established<br>/Upgraded/<br>Approved
                                            </th>
                                            <th>Name of Equipment/Facilities</th>
                                            <th>Agency</th>
                                            <th>Expenditures</th>
                                            <th>Source(s) of Funds</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($equipments as $item)
                                            @php
                                                $sof = json_decode($item->equipments_sof);
                                                $sof = implode(', ', $sof);
                                            @endphp
                                            <tr class="td-filtered">
                                                <td>{{ $item->equipments_type }}</td>
                                                <td>{{ $item->equipments_name }}</td>
                                                <td>{{ $item->equipments_agency }}</td>
                                                <td>₱{{ number_format($item->equipments_total, 2) }}</td>
                                                <td>{{ $sof }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Awards --}}
                            <div class="card-body">
                                <h5>Awards Received by the consortium or member-agencies
                                </h5>
                                <table class="table-bordered table table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th class="text-center">Type of Award</th>
                                            <th>Title</th>
                                            <th>Recipient/Agency</th>
                                            <th>Sponsor</th>
                                            <th>Event/Activity</th>
                                            <th>Place of Award</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($awards as $item)
                                            <tr class="td-filtered">
                                                <td>{{ $item->awards_type }}</td>
                                                <td>{{ $item->awards_title }}</td>
                                                <td>{{ $item->awards_recipients . '/' . $item->awards_agency }}
                                                </td>
                                                <td>{{ $item->awards_sponsor }}</td>
                                                <td>{{ $item->awards_event }}</td>
                                                <td>{{ $item->awards_place }}</td>
                                                <td>{{ date('F d, Y', strtotime($item->awards_date)) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- Meetings --}}
                            <div class="card-body">
                                <h5>Schedule, Venue, Host Agencies of Regular Meetings
                                </h5>
                                <table class="table-bordered table table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th class="text-center">Type of Meeting/Activity</th>
                                            <th>Venue</th>
                                            <th>Date</th>
                                            <th>Host Agency</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($meetings->isEmpty())
                                            <tr class="td-filtered">
                                                <td colspan="4">No data available</td>
                                            </tr>
                                        @else
                                            @foreach ($meetings as $item)
                                                <tr class="td-filtered">
                                                    <td>{{ $item->meeting_type }}</td>
                                                    <td>{{ $item->meeting_venue }}</td>
                                                    <td>{{ date('F d, Y', strtotime($item->meeting_date)) }}</td>
                                                    <td>{{ $item->meeting_host }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            {{-- CMI Contribution --}}
                            <div class="card-body">
                                <h5>CMI Contribution
                                </h5>
                                <table class="table-bordered table table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th class="text-center">Contributor</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($contributions->isEmpty())
                                            <tr class="td-filtered">
                                                <td colspan="2">No data available</td>
                                            </tr>
                                        @else
                                            @foreach ($contributions as $item)
                                                <tr class="td-filtered">
                                                    <td>{{ $item->con_name }}</td>
                                                    <td>₱{{ number_format($item->con_amount, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>

                            {{-- New Initiatives on Governance --}}
                            <div class="card-body">
                                <h5>New Initiatives on Governance
                                </h5>
                                <table class="table-bordered table table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th class="text-center">New Initiates</th>
                                            <th>Date Conducted/Implemented</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($initiatives->isEmpty())
                                            <tr class="td-filtered">
                                                <td colspan="2">No data available</td>
                                            </tr>
                                        @else
                                            @foreach ($initiatives as $item)
                                                <tr class="td-filtered">
                                                    <td>{{ $item->ini_initiates }}</td>
                                                    <td>{{ date('F d, Y', strtotime($item->ini_date)) }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            {{-- Policy Researches Conducted --}}
                            <div class="card-body">
                                <h5>Policy Researches Conducted
                                </h5>
                                <table class="table-bordered table table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th>Title</th>
                                            <th>Agency</th>
                                            <th>Author</th>
                                            <th>Issues Addressed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($issues->isEmpty())
                                            <tr class="td-filtered">
                                                <td colspan="4">No data available</td>
                                            </tr>
                                        @else
                                            @foreach ($issues as $item)
                                                <tr class="td-filtered">
                                                    <td>{{ $item->prc_title }}</td>
                                                    <td>{{ $item->prc_agency }}</td>
                                                    <td>{{ $item->prc_author }}</td>
                                                    <td>{{ $item->prc_issues }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            {{-- Policies Formulated, Advocated, Implemented Institutional and Institutionalized --}}
                            <div class="card-body">
                                <h5>Policies Formulated, Advocated, Implemented Institutional and Institutionalized
                                </h5>
                                <table class="table-bordered table table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th>Type</th>
                                            <th>Title</th>
                                            <th>Agency</th>
                                            <th>Author</th>
                                            <th>Co-author</th>
                                            <th>Beneficiary</th>
                                            <th>Implementer</th>
                                            <th>Issues Addressed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($formulated->isEmpty())
                                            <tr class="td-filtered">
                                                <td colspan="8">No data available</td>
                                            </tr>
                                        @else
                                            @foreach ($formulated as $item)
                                                <tr class="td-filtered">
                                                    <td>{{ $item->policy_type }}</td>
                                                    <td>{{ $item->policy_title }}</td>
                                                    <td>{{ $item->policy_agency }}</td>
                                                    <td>{{ $item->policy_author }}</td>
                                                    <td>{{ $item->policy_co_author }}</td>
                                                    <td>{{ $item->policy_beneficiary }}</td>
                                                    <td>{{ $item->policy_implementer }}</td>
                                                    <td>{{ $item->policy_issues }}</td>
                                                </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#filterForm').submit(function(event) {
                event.preventDefault(); // Prevent form submission

                var formData = $(this).serialize(); // Serialize form data

                // Send AJAX request
                $.ajax({
                    url: "{{ route('records.filter') }}",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                        // Update programs table body
                        $('#programsTable tbody').html(response.programs_html);
                        // Update projects table body
                        $('#projectsTable tbody').html(response.projects_html);
                        // Update sub-projects table body
                        $('#subProjectsTable tbody').html(response.sub_projects_html);
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#yearSelect').select2();
        });
    </script>
@endsection
