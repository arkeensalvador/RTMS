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
                            <li class="breadcrumb-item active">Programs</li>
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
                                <form id="filterForm">
                                    @csrf
                                    <select name="duration" id="yearSelect">
                                        <option value="">Select Year</option>
                                        @for ($year = 2018; $year <= 2050; $year++)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                    <button type="submit">Filter</button>
                                </form>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="recordsTable" class="table table-bordered table-striped">
                                    <thead>
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
                                    <tbody>
                                        @if ($records->isEmpty())
                                            <tr>
                                                <td colspan="10">No data available</td>
                                            </tr>
                                        @else
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
                                                            <i class="fa-regular fa-square-plus"
                                                                style="color: #0dcaf0;"></i>
                                                        @elseif ($row->program_status == 'Ongoing')
                                                            {{ $row->program_status }}
                                                            <i class="fa-solid fa-spinner fa-spin"
                                                                style="color: #0d6efd"></i>
                                                        @elseif ($row->program_status == 'Terminated')
                                                            {{ $row->program_status }}
                                                            <i class="fa-regular fa-circle-xmark"
                                                                style="color: #ff0000;"></i>
                                                        @elseif ($row->program_status == 'Completed')
                                                            {{ $row->program_status }}
                                                            <i class="fa-regular fa-circle-check"
                                                                style="color: #28a745;"></i>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->

                            {{-- Projects --}}
                            {{-- <div class="card-body">
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="th-filtered">
                                            <th>Program</th>
                                            <th>Fund Code</th>
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
                                        @if ($p_records->isEmpty())
                                            <tr>
                                                <td colspan="11">No data available</td>
                                            </tr>
                                        @else
                                            @foreach ($p_records as $row)
                                                <tr class="td-filtered">
                                                    @php
                                                        $program = DB::table('programs')
                                                            ->select('program_title')
                                                            ->where('programID', '=', $row->programID)
                                                            ->first(); // Execute the query to fetch the result
                                                    @endphp
                                                    <td>
                                                        @if ($program)
                                                            {{ strtoupper($program->program_title) }}
                                                        @else
                                                            {{ 'N/A' }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if (!empty($row->project_fund_code))
                                                            {{ $row->project_fund_code }}
                                                        @else
                                                            {{ 'N/A' }}
                                                        @endif
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
                                                            <i class="fa-regular fa-square-plus"
                                                                style="color: #0dcaf0;"></i>
                                                        @elseif ($row->project_status == 'Ongoing')
                                                            {{ $row->project_status }}
                                                            <i class="fa-solid fa-spinner fa-spin"
                                                                style="color: #0d6efd"></i>
                                                        @elseif ($row->project_status == 'Terminated')
                                                            {{ $row->project_status }}
                                                            <i class="fa-regular fa-circle-xmark"
                                                                style="color: #ff0000;"></i>
                                                        @elseif ($row->project_status == 'Completed')
                                                            {{ $row->project_status }}
                                                            <i class="fa-regular fa-circle-check"
                                                                style="color: #28a745;"></i>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div> --}}

                            {{-- Sub Projects --}}
                            {{-- <div class="card-body">
                                <table id="" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="th-filtered">
                                            <th>Fund Code</th>
                                            <th>Project/Study Title</th>
                                            <th>Project/Study Leader</th>
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
                                        @if ($sp_records->isEmpty())
                                            <tr>
                                                <td colspan="10">No data available</td>
                                            </tr>
                                        @else
                                            @foreach ($sp_records as $row)
                                                <tr class="td-filtered">
                                                    <td>
                                                        @if (!empty($row->sub_project_fund_code))
                                                            {{ $row->sub_project_fund_code }}
                                                        @else
                                                            {{ 'N/A' }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        {{ strtoupper($row->sub_project_title) }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $leader = App\Models\Researchers::find($row->sub_project_leader);
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
                                                            <i class="fa-regular fa-square-plus"
                                                                style="color: #0dcaf0;"></i>
                                                        @elseif ($row->sub_project_status == 'Ongoing')
                                                            {{ $row->sub_project_status }}
                                                            <i class="fa-solid fa-spinner fa-spin"
                                                                style="color: #0d6efd"></i>
                                                        @elseif ($row->sub_project_status == 'Terminated')
                                                            {{ $row->sub_project_status }}
                                                            <i class="fa-regular fa-circle-xmark"
                                                                style="color: #ff0000;"></i>
                                                        @elseif ($row->sub_project_status == 'Completed')
                                                            {{ $row->sub_project_status }}
                                                            <i class="fa-regular fa-circle-check"
                                                                style="color: #28a745;"></i>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div> --}}
                            <!-- /.card-footer -->
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
                        // Update records table body
                        $('#recordsTable tbody').html(response.records_html);
                        // Update projects and sub-projects tables similarly if needed
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
