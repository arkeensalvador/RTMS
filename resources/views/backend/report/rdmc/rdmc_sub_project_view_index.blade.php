@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{-- <h1 class="m-0">{{ auth()->user()->role }} - Manage Accounts</h1> --}}
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('report-index') }}">Reports</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('rdmc-index') }}">RDMC</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('rdmc-monitoring-evaluation') }}">Monitoring and
                                    Evaluation</a>
                            </li>
                            <li class="breadcrumb-item "><a href="{{ url('rdmc-projects') }}">Projects</a></li>
                            <li class="breadcrumb-item active">Sub Projects / Study</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Main content -->
        <section class="report">
            <div class="container-fluid">
                <div class="monitoring row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">{{ $project_title->project_title }} (Sub-projects / Study)</h2>
                                <div class="card-tools">
                                    {{-- <a href="{{ url('view-subprojects') }}" class="btn btn-primary">Sub-projects</a> --}}

                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                        Import
                                    </button>


                                    <a href="{{ url('sub-projects-add/' . $project_title->id) }}" class="btn btn-success">
                                        <i class="fa-solid fa-plus"></i> Create</span></a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="programs" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th hidden>Sub Project ID</th>
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
                                            <th hidden>Keyword(s)</th>
                                            <th>Action</th>
                                        </tr>

                                    </thead>
                                    @if (auth()->user()->role == 'Admin')
                                        <tbody>
                                            @foreach ($sub_projects as $row)
                                                <tr>
                                                    <td class="subproj_id" hidden>{{ $row->id }}</td>
                                                    <td><span class="hashtag text-bg-primary">#</span>
                                                        {{ $row->sub_project_fund_code }} </td>
                                                    <td>
                                                        {{ $row->sub_project_title }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $leader = App\Models\Researchers::find($row->sub_project_leader);
                                                        @endphp
                                                        {{ $leader->first_name . ' ' . $leader->middle_name . ' ' . $leader->last_name }}
                                                    </td>
                                                    <td>
                                                        {{ $row->sub_project_duration }}
                                                    </td>
                                                    @php
                                                        if (!empty($row->sub_project_implementing_agency)) {
                                                            $imp = json_decode($row->sub_project_implementing_agency);
                                                            $imp = implode(', ', $imp);
                                                        }

                                                        if (!empty($row->sub_project_collaborating_agency)) {
                                                            $collab = json_decode($row->sub_project_collaborating_agency);
                                                            $collab = implode(', ', $collab);
                                                        }

                                                        if (!empty($row->sub_project_agency)) {
                                                            $funding = json_decode($row->sub_project_agency);
                                                            $funding = implode(', ', $funding);
                                                        }

                                                        $rc = $row->sub_project_research_center;
                                                        $rc = str_replace(['[', '"', ']'], '', $rc);
                                                        $rc = str_replace(',', ', ', $rc);
                                                    @endphp
                                                    <td>{{ $funding }}</td>

                                                    <td>{{ $imp }} </td>
                                                    <td>{{ $collab }}</td>
                                                    <td>{{ $rc }}</td>
                                                    <td>{{ $row->sub_project_description }}</td>
                                                    <td>
                                                        @if ($row->sub_project_status == 'New')
                                                            {{ $row->sub_project_status }}
                                                            <i class="fa-solid fa-database fa-xl"
                                                                style="color: #28a745;"></i>
                                                        @elseif ($row->sub_project_status == 'Ongoing')
                                                            {{ $row->sub_project_status }}
                                                            <i class="fa-solid fa-magnifying-glass-chart fa-xl"
                                                                style="color: #2a6cdf;"></i>
                                                        @elseif ($row->sub_project_status == 'Terminated')
                                                            {{ $row->sub_project_status }}
                                                            <i class="fa-solid fa-triangle-exclamation fa-xl"
                                                                style="color: #ff0000;"></i>
                                                        @elseif ($row->sub_project_status == 'Completed')
                                                            {{ $row->sub_project_status }}
                                                            <i class="fa-solid fa-circle-check fa-xl"
                                                                style="color: #28a745;"></i>
                                                        @endif
                                                    </td>
                                                    <td hidden>
                                                        {{ $row->keywords }}
                                                    </td>
                                                    <td class="action">
                                                        <span title="View">
                                                            <a class="btn btn-info"
                                                                href="{{ url("view-subprojects/$row->projectID/$row->id") }}"><i
                                                                    class="fa-solid fa-eye" style="color: white;"></i></a>
                                                        </span>


                                                        <span title="Edit">
                                                            <a class="btn btn-primary"
                                                                href="{{ url("edit-sub-project/$row->projectID/$row->id") }}"><i
                                                                    class="fa-solid fa-pen-to-square"
                                                                    style="color: white;"></i></a>
                                                        </span>


                                                        <span title="Upload">
                                                            <a class="btn btn-secondary uploadFiles" data-toggle="modal"
                                                                data-target='#uploadfiles' data-id="{{ $row->id }}"><i
                                                                    class="fa-solid fa-file-circle-plus"></i></a>
                                                        </span>


                                                        <span title="Staffs">
                                                            <a class="btn btn-warning addPersonnel" data-toggle="modal"
                                                                data-target='#add-personnel'
                                                                data-id="{{ $row->id }}"><i
                                                                    class="fa-solid fa-user-plus"></i></a>
                                                        </span>

                                                        <a href="{{ URL::to('/delete-sub-project/' . $row->id) }}"
                                                            class="btn btn-danger" id="delete"><i
                                                                class="fa-solid fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @else
                                        <tbody>
                                            @foreach ($all_filter as $row)
                                                <tr>
                                                    <td class="subproj_id" hidden>{{ $row->id }}</td>
                                                    <td><span class="hashtag text-bg-primary">#</span>
                                                        {{ $row->sub_project_fund_code }} </td>
                                                    <td>
                                                        {{ $row->sub_project_title }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $leader = App\Models\Researchers::find($row->sub_project_leader);
                                                        @endphp
                                                        {{ $leader->first_name . ' ' . $leader->middle_name . ' ' . $leader->last_name }}
                                                    </td>
                                                    <td>
                                                        {{ $row->sub_project_duration }}
                                                    </td>
                                                    @php
                                                        if (!empty($row->sub_project_implementing_agency)) {
                                                            $imp = json_decode($row->sub_project_implementing_agency);
                                                            $imp = implode(', ', $imp);
                                                        }

                                                        if (!empty($row->sub_project_collaborating_agency)) {
                                                            $collab = json_decode($row->sub_project_collaborating_agency);
                                                            $collab = implode(', ', $collab);
                                                        }

                                                        if (!empty($row->sub_project_agency)) {
                                                            $funding = json_decode($row->sub_project_agency);
                                                            $funding = implode(', ', $funding);
                                                        }

                                                        $rc = $row->sub_project_research_center;
                                                        $rc = str_replace(['[', '"', ']'], '', $rc);
                                                        $rc = str_replace(',', ', ', $rc);
                                                    @endphp
                                                    <td>{{ $funding }}</td>

                                                    <td>{{ $imp }} </td>
                                                    <td>{{ $collab }}</td>
                                                    <td>{{ $rc }}</td>
                                                    <td>{{ $row->sub_project_description }}</td>
                                                    <td>
                                                        @if ($row->sub_project_status == 'New')
                                                            {{ $row->sub_project_status }}
                                                            <i class="fa-solid fa-database fa-xl"
                                                                style="color: #28a745;"></i>
                                                        @elseif ($row->sub_project_status == 'Ongoing')
                                                            {{ $row->sub_project_status }}
                                                            <i class="fa-solid fa-magnifying-glass-chart fa-xl"
                                                                style="color: #2a6cdf;"></i>
                                                        @elseif ($row->sub_project_status == 'Terminated')
                                                            {{ $row->sub_project_status }}
                                                            <i class="fa-solid fa-triangle-exclamation fa-xl"
                                                                style="color: #ff0000;"></i>
                                                        @elseif ($row->sub_project_status == 'Completed')
                                                            {{ $row->sub_project_status }}
                                                            <i class="fa-solid fa-circle-check fa-xl"
                                                                style="color: #28a745;"></i>
                                                        @endif
                                                    </td>
                                                    <td hidden>
                                                        {{ $row->keywords }}
                                                    </td>
                                                    <td class="action">
                                                        <span title="View">
                                                            <a class="btn btn-info"
                                                                href="{{ url("view-subprojects/$row->projectID/$row->id") }}"><i
                                                                    class="fa-solid fa-eye" style="color: white;"></i></a>
                                                        </span>


                                                        <span title="Edit">
                                                            <a class="btn btn-primary"
                                                                href="{{ url("edit-sub-project/$row->projectID/$row->id") }}"><i
                                                                    class="fa-solid fa-pen-to-square"
                                                                    style="color: white;"></i></a>
                                                        </span>


                                                        <span title="Upload">
                                                            <a class="btn btn-secondary uploadFiles" data-toggle="modal"
                                                                data-target='#uploadfiles' data-id="{{ $row->id }}"><i
                                                                    class="fa-solid fa-file-circle-plus"></i></a>
                                                        </span>


                                                        <span title="Staffs">
                                                            <a class="btn btn-warning addPersonnel" data-toggle="modal"
                                                                data-target='#add-personnel'
                                                                data-id="{{ $row->id }}"><i
                                                                    class="fa-solid fa-user-plus"></i></a>
                                                        </span>

                                                        <a href="{{ URL::to('/delete-sub-project/' . $row->id) }}"
                                                            class="btn btn-danger" id="delete"><i
                                                                class="fa-solid fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @endif
                                </table>
                                <a href="{{ url('rdmc-projects') }}" class="btn btn-default">Back</a>
                            </div>
                            <!-- /.card-body -->
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

    <div class="modal fade" id="add-personnel" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Personnels</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" id="regiration_form" action="{{ url('add-sub-project-personnel') }}"
                        method="POST">
                        @csrf
                        {{-- EMPLOYEE FORM WORKING --}}
                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Sub-project Staff(s)</label>
                                        <table class="table table-append" id="dynamicAddRemove">
                                            <tr>
                                                <td class="append">
                                                    {{-- <input type="text" class="form-control"
                                                        name="moreFields[0][programID]" id="programID" value=""
                                                        placeholder="Program ID" hidden readonly required autocomplete="false"> --}}

                                                    {{-- <input type="text" class="form-control"
                                                        name="moreFields[0][projectID]" id="projectID" value=""
                                                        placeholder="Project ID" hidden readonly required
                                                        autocomplete="false"> --}}

                                                    <input type="text" class="form-control"
                                                        name="moreFields[0][subprojectID]" id="subprojectID"
                                                        value="" placeholder="Sub Project ID" hidden readonly
                                                        required autocomplete="false">

                                                    <input type="text" class="form-control" placeholder="Staff"
                                                        name="moreFields[0][staff_name]" autocomplete="false">
                                                </td>

                                                <td class="append">
                                                    <i class="fa-solid fa-user-plus fa-lg" style="color: #28a745;"
                                                        name="add" id="add-btn"></i>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="card-footer"> --}}
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="submit" class="next btn btn-success">Submit</button>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add FIles Modal -->
    <div class="modal fade" id="uploadfiles" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Sub Project Files</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body row files">
                    <div class="col-lg-12">
                        <form id="multi-file-upload-ajax" method="POST" action="javascript:void(0)"
                            accept-charset="utf-8" enctype="multipart/form-data">

                            @csrf

                            <div class="row">
                                <div class="form-group row">
                                    {{-- <input type="text" class="form-control" name="programID" placeholder=""
                                        id="upload_programID" hidden readonly required autocomplete="false">

                                    <input type="text" class="form-control" name="projectID" placeholder=""
                                        id="upload_projectID" hidden readonly required autocomplete="false"> --}}

                                    <input type="text" class="form-control" hidden name="subprojectID" placeholder=""
                                        id="upload_subprojectID" readonly required autocomplete="false">

                                    <input type="text" class="form-control" name="uploader_agency"
                                        placeholder="Agency" hidden value="{{ auth()->user()->agencyID }}" readonly
                                        required autocomplete="false">
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="file" class="form-control" name="files[]" id="files"
                                            placeholder="Choose files" multiple>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                        aria-label="Close">Close</button>
                                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Import to Database
                        <span title="Click to download format">
                            <a href="{{ url('download-template-subprojects') }}" class="" download><i
                                    class="fa-solid fa-file-circle-question"></i></a>
                        </span>
                    </h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('import-file') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="file" name="import_excel_sub_projects" accept="application/vnd.ms-excel"
                            class="form-control" id="import_excel_sub_projects">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(e) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('#multi-file-upload-ajax').submit(function(e) {

                e.preventDefault();

                var formData = new FormData(this);

                let TotalFiles = $('#files')[0].files.length; //Total files
                let files = $('#files')[0];
                for (let i = 0; i < TotalFiles; i++) {
                    formData.append('files' + i, files.files[i]);
                }
                formData.append('TotalFiles', TotalFiles);

                $.ajax({
                    type: 'POST',
                    url: "{{ url('store-multi-file-ajax') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        // this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'File Uploaded Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        });

                        $("#uploadfiles").modal().hide();
                        $('.modal-backdrop').remove();

                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'warning',
                            title: data.responseJSON.message,
                            timerProgressBar: false,
                            showConfirmButton: true,
                        });
                    }
                });
            });
        });
    </script>
    <script type="text/javascript">
        var i = 0;
        $("#add-btn").click(function() {

            ++i;

            $("#dynamicAddRemove").append(`
            <tr>
                <td class="append">
                    <input type="text" class="form-control" name="moreFields[` + i +
                `][subprojectID]" id="moreFields[` +
                i + `][subproj]" value=""placeholder="Project ID" hidden readonly required autocomplete="false">
                    <input type="text" class="form-control" placeholder="Staff" name="moreFields[` + i + `][staff_name]">
                </td>

                <td class="append">
                    <i class="fa-solid fa-user-minus fa-lg remove-input" style="color: #dc3545;"></i>
                </td>
            </tr>`);

            // let text1 = document.getElementById('programID').value;
            // let text2 = document.getElementById('projectID').value;
            let text3 = document.getElementById('subprojectID').value;
            // document.getElementById(`moreFields[` + i + `][prog]`).value = text1;
            // document.getElementById(`moreFields[` + i + `][proj]`).value = text2;
            document.getElementById(`moreFields[` + i + `][subproj]`).value = text3;
        });
        $(document).on('click', '.remove-input', function() {
            $(this).parents('tr').remove();
        });

        $('input.number-to-text').keydown(function(event) {
            if ([38, 40].indexOf(event.keyCode) > -1) {
                event.preventDefault();
            }
        });


        $(document).on('click', '.addPersonnel', function() {
            var _this = $(this).parents('tr');
            // $('#program_id').val(_this.find('.prog_id').text());
            // $('#programID').val(_this.find('.prog_id').text());
            // $('#projectID').val(_this.find('.proj_id').text());
            $('#subprojectID').val(_this.find('.subproj_id').text());
        });

        $(document).on('click', '.uploadFiles', function() {
            var _this = $(this).parents('tr');
            // $('#program_id').val(_this.find('.prog_id').text());
            // $('#upload_programID').val(_this.find('.prog_id').text());
            // $('#upload_projectID').val(_this.find('.proj_id').text());
            $('#upload_subprojectID').val(_this.find('.subproj_id').text());
        });
    </script>
@endsection
