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
                                    <button type="submit" class="btn btn-success">Filter</button>
                                    <a href="{{ url('records') }}" class="btn btn-primary">Clear</a>

                                    <a class="btn btn-primary float-right" target="_blank"
                                        href="{{ URL::to('/reports/pdf/filtered_report') }}">Export
                                        to PDF</a>
                                </form>
                                <!-- /.card-tools -->
                            </div>

                            {{-- Summary of the AIHRS --}}
                            <div class="card-body">
                                <h5>Summary of the AIHR's conducted by the CMI's</h5>
                                <table class="table table-bordered table-striped">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
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
                                        {!! $programs_html !!}
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->

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
                                        {!! $projects_html !!}
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
                                        {!! $sub_projects_html !!}
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
                                        {!! $linkages_table_html !!}
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
                                        {!! $dbis_table_html !!}
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
                                        {!! $strat_proglist_table_html !!}
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
                                        {!! $strat_collab_table_html !!}
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
                                        {!! $strat_tech_table_html !!}
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
                                        {!! $rdru_techlist_table_html !!}
                                    </tbody>
                                </table>
                            </div>

                            {{-- RDRU TTM --}}
                            <div class="card-body">
                                <h5>Technologies Commercialized or Pre-Commercialization Initiatives
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
                                            {!! $results_tech_com_table_html !!}
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
                                        {!! $results_tpa_table_html !!}
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
                                        {!! $cbg_trainings_table_html !!}
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
                                        {!! $cbg_equip_table_html !!}
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
                                        {!! $cbg_awards_table_html !!}
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
                                        {!! $cbg_meeting_table_html !!}
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
                                        {!! $cbg_cmi_table_html !!}
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
                                        {!! $cbg_initiative_table_html !!}
                                    </tbody>
                                </table>
                            </div>

                            {{-- Policy Researches Conducted --}}
                            <div class="card-body">
                                <h5>Policy Researches Conducted
                                </h5>
                                <table class="table-bordered table table-hover">
                                    <thead style="background: #267b03; color: #F7F7F7; text-align:center;">
                                        <tr class="th-filtered">
                                            <th>Title</th>
                                            <th>Agency</th>
                                            <th>Author</th>
                                            <th>Issues Addressed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {!! $policy_prc_table_html !!}
                                    </tbody>
                                </table>
                            </div>

                            {{-- Policies Formulated, Advocated, Implemented Institutional and Institutionalized --}}
                            <div class="card-body">
                                <h5>Policies Formulated, Advocated, Implemented Institutional and Institutionalized
                                </h5>
                                <table class="table-bordered table table-hover">
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
                                        {!! $policy_formulated_table_html !!}
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
