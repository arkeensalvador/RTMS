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
                                            <option value="{{ $year }}" {{ $duration == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endfor
                                    </select>
                                    <button type="submit" class="btn btn-success">Filter Data</button>
                                </form>
                                <!-- /.card-tools -->
                            </div>

                            {{-- Summary of the AIHRS --}}
                            <div class="card-body">
                                <h5>Summary of the AIHR's conducted by the CMI's</h5>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="th-filtered">
                                            <th rowspan="2">Agency</th>
                                            <th colspan="5" style="text-align: center">Number of Project Presented</td>
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
                                        {!! $funded_counts_html !!}
                                    </tbody>
                                </table>
                            </div>

                            <div class="card-body">
                                <!-- Programs Table -->
                                <h5>Programs</h5>
                                <table id="programsTable" class="table table-bordered table-striped">
                                    <!-- Table headers -->
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
                                    <!-- Table body to be filled by AJAX response -->
                                    <tbody>
                                        <!-- Data will be filled dynamically -->
                                        {!! $programs_html !!}
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->

                            {{-- Projects --}}
                            <div class="card-body">
                                <h5>Projects</h5>
                                <table id="projectsTable" class="table table-bordered table-striped">
                                    <thead>
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
                                        {!! $projects_html !!}
                                    </tbody>
                                </table>
                            </div>

                            {{-- Sub Projects --}}
                            <div class="card-body">
                                <h5>Sub Projects/Studies</h5>
                                <table id="subProjectsTable" class="table table-bordered table-striped">
                                    <thead>
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
                                        {!! $sub_projects_html !!}
                                    </tbody>
                                </table>
                            </div>

                            {{-- RDMC LINKAGES --}}
                            <div class="card-body">
                                <h5>Linkages forged and maintained</h5>
                                <table id="subProjectsTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="th-filtered">
                                            <th>Agency/Institutions</th>
                                            <th>Address</th>
                                            <th>Year</th>
                                            <th>Nature of Assistance / Linkages / Projects</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {!! $linkages_table_html !!}
                                    </tbody>
                                </table>
                            </div>

                            {{-- DBIS --}}
                            <div class="card-body">
                                <h5>Database and Information System</h5>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="th-filtered">
                                            <th>Title</th>
                                            <th>Type of Database/Information System</th>
                                            <th>Date Created</th>
                                            <th>Purpose / Use</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {!! $dbis_table_html !!}
                                    </tbody>
                                </table>
                            </div>

                            {{-- STRATEGIC PROGRAM LIST --}}
                            <div class="card-body">
                                <h5>Research & Development Programs/Projects Packaged, Approved and Implemented</h5>
                                <table class="table-bordered table table-striped">
                                    <thead>
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
                                        {!! $strat_proglist_table_html !!}
                                    </tbody>
                                </table>
                            </div>

                            {{-- STRATEGIC COLLABORATIVE --}}
                            <div class="card-body">
                                <h5>Collaborative Research & Development Programs/Projects Implemented by the Consortium and
                                    Member-Agencies in support of regional priorities</h5>
                                <table class="table-bordered table table-striped">
                                    <thead>
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
                                        {!! $strat_collab_table_html !!}
                                    </tbody>
                                </table>
                            </div>

                            {{-- RDRU TTP --}}
                            <div class="card-body">
                                <h5>Technology Transfer Program/Projects Packaged, Approved and Implemented</h5>
                                <table class="table-bordered table table-striped">
                                    <thead>
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
                                        {!! $rdru_techlist_table_html !!}
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
