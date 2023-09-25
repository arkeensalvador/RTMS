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
                                <h3 class="card-title">List of Programs</h3>
                                <div class="card-tools">

                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                        Import
                                    </button>

                                    @if ($agency->isEmpty())
                                        <a href="{{ url('rdmc-create-program') }}"
                                            class="btn btn-success {{ Route::current()->getName() == 'rdmc-create-program' ? 'active' : '' }}"
                                            hidden>Add
                                            Program</a>
                                    @else
                                        <a href="{{ url('rdmc-create-program') }}"
                                            class="btn btn-success {{ Route::current()->getName() == 'rdmc-create-program' ? 'active' : '' }}">Add
                                            Program</a>
                                    @endif

                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="programs" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th hidden>Program ID</th>
                                            <th>Fund Code</th>
                                            <th>Program Title</th>
                                            <th>Duration</th>
                                            <th>Funding Agency</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        @foreach ($all as $key => $row)
                                            <tr>
                                                <td class="prog_id" hidden>{{ $row->programID }}</td>
                                                <td>{{ $row->fund_code }}</td>
                                                <td>{{ $row->program_title }}</td>
                                                <td>
                                                    @empty($row->extend_date)
                                                        {{ date('F, Y', strtotime($row->start_date)) ?: 'Not Set' }} -
                                                        {{ date('F, Y', strtotime($row->end_date)) ?: 'Not Set' }}
                                                    @else
                                                        {{ date('F, Y', strtotime($row->start_date)) ?: 'Not Set' }} -
                                                        {{ date('F, Y', strtotime($row->extend_date)) ?: 'Not Set' }}
                                                        <span class="badge text-bg-info">Extended</span>
                                                    @endempty
                                                </td>
                                                <td>{{ $row->funding_agency }}</td>
                                                <td>{{ $row->program_description }}</td>
                                                <td>
                                                    @if ($row->program_status == 'New')
                                                        {{ $row->program_status }}
                                                        <i class="fa-solid fa-database fa-xl" style="color: #28a745;"></i>
                                                    @elseif ($row->program_status == 'On-going')
                                                        {{ $row->program_status }}
                                                        <i class="fa-solid fa-magnifying-glass-chart fa-xl"
                                                            style="color: #2a6cdf;"></i>
                                                    @elseif ($row->program_status == 'Terminated')
                                                        {{ $row->program_status }}
                                                        <i class="fa-solid fa-triangle-exclamation fa-xl"
                                                            style="color: #ff0000;"></i>
                                                    @elseif ($row->program_status == 'Completed')
                                                        {{ $row->program_status }}
                                                        <i class="fa-solid fa-circle-check fa-xl" style="color: #28a745;"></i>
                                                    @endif


                                                </td>
                                                <td class="action">
                                                    <span title="View Program">
                                                        <a class="btn btn-info"
                                                            href="{{ url("view-program-index/$row->programID") }}"><i
                                                                class="fa-solid fa-eye" style="color: white;"></i></a>
                                                    </span>

                                                    <span title="Edit Program">
                                                        <a class="btn btn-primary"
                                                            href="{{ url("edit-program-index/$row->programID") }}"><i
                                                                class="fa-solid fa-pen-to-square"
                                                                style="color: white;"></i></a>
                                                    </span>

                                                    <span title="Upload Program Files">
                                                        <a class="btn btn-secondary"
                                                            href="{{ url("upload-file/$row->programID") }}"><i
                                                                class="fa-solid fa-file-circle-plus"></i></a>
                                                    </span>

                                                    <span title="Add Program Staffs">
                                                        <!-- Button trigger modal -->
                                                        <a class="btn btn-warning addPersonnel" data-toggle="modal"
                                                            data-target='#add-personnel' data-id="{{ $row->programID }}"><i
                                                                class="fa-solid fa-user-plus"></i></a>

                                                        {{-- <a class="btn btn-warning"
                                                            href="{{ URL::to('/add-program-personnel-index/' . $row->programID) }}">
                                                            <i class="fa-solid fa-user-plus"></i>
                                                        </a> --}}
                                                    </span>

                                                    <a href="{{ URL::to('/delete-program/' . $row->id) }}"
                                                        class="btn btn-danger" id="delete"><i
                                                            class="fa-solid fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->

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
    <!-- Modal Personnel-->
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
                    <form role="form" id="regiration_form" action="{{ url('add-program-personnel') }}" method="POST">
                        @csrf
                        {{-- EMPLOYEE FORM WORKING --}}
                        <fieldset>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Program Staff(s)</label>
                                        <table class="table table-append" id="dynamicAddRemove">
                                            <tr>
                                                <td class="append">
                                                    <input type="text" class="form-control"
                                                        name="moreFields[0][programID]" id="programID" value=""
                                                        placeholder="Program ID" hidden readonly required
                                                        autocomplete="false">

                                                    <input type="text" class="form-control" placeholder="Staff"
                                                        name="moreFields[0][staff_name]" required autocomplete="false">
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
                                <button type="submit" name="submit" class="next btn btn-info">Submit</button>
                            </div>
                        </fieldset>
                    </form>
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
                            <a href="{{ url('download-template-programs') }}" class="" download><i
                                    class="fa-solid fa-file-circle-question"></i></a>
                        </span>
                    </h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('import-file') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="file" name="import_excel_programs" accept="application/vnd.ms-excel"
                            class="form-control" id="import_excel">
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
        var i = 0;
        $("#add-btn").click(function() {

            ++i;

            $("#dynamicAddRemove").append(`
            <tr>
                <td class="append">
                    <input type="text" class="form-control" name="moreFields[` + i + `][programID]" id="moreFields[` +
                i + `][prog]" value="" 
                    placeholder="Program ID" hidden readonly required autocomplete="false">
                    <input type="text" class="form-control" placeholder="Staff" name="moreFields[` + i + `][staff_name]">
                </td>

                <td class="append">
                    <i class="fa-solid fa-user-minus fa-lg remove-input" style="color: #dc3545;"></i>
                </td>
            </tr>`);

            let text1 = document.getElementById('programID').value;
            document.getElementById(`moreFields[` + i + `][prog]`).value = text1;
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
            $('#programID').val(_this.find('.prog_id').text());
        });
    </script>
@endsection
