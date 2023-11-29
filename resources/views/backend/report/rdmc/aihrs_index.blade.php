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
                            <li class="breadcrumb-item"><a href="report-index">Reports</a></li>
                            <li class="breadcrumb-item"><a href="rdmc-index">RDMC</a></li>
                            <li class="breadcrumb-item"><a href="rdmc-monitoring-evaluation">Monitoring and Evaluation</a>
                            </li>
                            <li class="breadcrumb-item active">AIHRS</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Main content -->
        <section class="report">
            <div class="container-fluid">
                <div class="monitoring row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Agency In-House Reviews (AIHRs)</h2>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="col-sm-12">
                                            @if (auth()->user()->role == 'Admin')
                                                <table id="aihrs" class="table table-bordered table-striped">
                                                    <span>Number of Projects Presented:</span>
                                                    <thead>
                                                        <tr>
                                                            <th>New</th>
                                                            <th>On-going</th>
                                                            <th>Completed</th>
                                                            <th>Terminated</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th>{{ $new + $new_proj + $new_subproj }}</th>
                                                            <th>{{ $ongoing + $ongoing_proj + $ongoing_subproj }}</th>
                                                            <th>{{ $completed + $completed_proj + $completed_subproj }}</th>
                                                            <th>{{ $terminated + $terminated_proj + $terminated_subproj }}
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            @else
                                                <table id="aihrs" class="table table-bordered table-striped">
                                                    <span>Number of Projects Presented:</span>
                                                    <thead>
                                                        <tr>
                                                            <th>New</th>
                                                            <th>On-going</th>
                                                            <th>Completed</th>
                                                            <th>Terminated</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th>{{ $cmi_new + $cmi_new_proj + $cmi_new_subproj }}</th>
                                                            <th>{{ $cmi_ongoing + $cmi_ongoing_proj + $cmi_ongoing_subproj }}
                                                            </th>
                                                            <th>{{ $cmi_completed + $cmi_completed_proj + $cmi_completed_subproj }}
                                                            </th>
                                                            <th>{{ $cmi_terminated + $cmi_terminated_proj + $cmi_terminated_subproj }}
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            @endif

                                            {{-- <a href="{{ url('rdmc-monitoring-evaluation') }}"
                                                class="btn btn-default">Back</a> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        {{-- Best paper table --}}
        <section class="report">
            <div class="container-fluid">
                <div class="monitoring row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Best Paper</h2>
                                @if (auth()->user()->role == 'Admin')
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#addBestPaper">
                                            <i class="fa-solid fa-plus"></i> Add best paper
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="col-sm-12">
                                            <table id="datatable" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th hidden>ID</th>
                                                        <th>Title</th>
                                                        @if (auth()->user()->role == 'Admin')
                                                            <th>Action</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($best_paper as $item)
                                                        <tr>
                                                            <td hidden>{{ $item->id }}</td>
                                                            <td>{{ $item->best_paper }}</td>
                                                            @if (auth()->user()->role == 'Admin')
                                                                <td class="action btns">
                                                                    <a class="btn btn-primary editBestPaper"
                                                                        data-toggle="modal" data-id="'.$item->id.'"
                                                                        data-target="#editBestPaper"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: white;"></i></a>
                                                                    <a href="{{ url('delete-best-paper/' . Crypt::encryptString($item->id)) }}"
                                                                        class="btn btn-danger" id="delete"><i
                                                                            class="fa-solid fa-trash"></i></a>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <a href="{{ url('rdmc-monitoring-evaluation') }}"
                                                class="btn btn-default">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- /.container-fluid -->
        </section>
    </div>

    <div class="modal fade" id="addBestPaper" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="createContributionModalLabel" aria-hidden="true">
        <!-- Your modal content for creating a new contribution -->

        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <form id="techForm" method="POST" action="{{ url('add-best-paper') }}"
                        class="row g-3 needs-validation" novalidate>
                        @csrf
                        <div class="form-title col-12">
                            <h2 class="font-weight-bold">Best Paper</h2>
                            <h5 class="mt-0">Kindly fill-out the fields needed.</h5>
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="con_name" class=" font-weight-bold">Title<span class="text-danger">*</span></label>

                            <input type="text" name="best_paper" class="form-control" placeholder="Enter title" required>
                            <div class="invalid-feedback">Missing title</div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="submit" class="btn btn-primary btn-m ">Submit</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editBestPaper" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="editContributionModalLabel" aria-hidden="true">
        <!-- Your modal content for editing an existing contribution -->
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <form id="editForm" method="POST" action="{{ url('update-best-paper') }}"
                        class="row g-3 needs-validation" novalidate>
                        @csrf
                        <div class="form-title col-12">
                            <h2 class="font-weight-bold">Best Paper</h2>
                            <h5 class="mt-0">Kindly fill-out the fields needed.</h5>
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="con_name" class=" font-weight-bold">Title<span
                                    class="text-danger">*</span></label>

                            <input type="text" name="best_paper" id="e_best_paper" class="form-control"
                                placeholder="Enter title" required>
                            <div class="invalid-feedback">Missing title</div>
                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="submit" class="btn btn-primary btn-m ">Submit</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#datatable').DataTable();

            table.on('click', '.editBestPaper', function() {
                $tr = $(this).closest('tr');
                if ($($tr).hasClass('child')) {
                    $tr = $tr.prev('.parent');
                }
                var data = table.row($tr).data();
                console.log(data);

                $('#e_best_paper').val(data[1]);

                $('#editForm').attr('action', '/update-best-paper/' + data[0]);
                // $('#editContributionModal').modal('show');
            })

        })
    </script>
    <script>
        $(document).ready(function() {
            $('#con_name, #con_amount')
                .on('input', function() {
                    const inputField = $(this);
                    if (inputField[0].checkValidity()) {
                        inputField.addClass('is-valid').removeClass('is-invalid');
                    } else {
                        inputField.addClass('is-invalid').removeClass('is-valid');
                    }
                });
        });


        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                            Swal.fire({
                                icon: 'info',
                                title: 'All fields are required',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            });
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        document.getElementById('techForm').addEventListener('submit', function(event) {
            const startDate = document.getElementById('awards_date').value;
            const endDate = document.getElementById('awards_recipients').value;
            if (!endDate) {
                event.preventDefault();
                document.getElementById('awards_recipients').classList.add('is-invalid');
            }
            if (!startDate) {
                event.preventDefault();
                document.getElementById('awards_date').classList.add('is-invalid');
            }
            if (!startDate && !endDate) {
                event.preventDefault();
                document.getElementById('awards_date').classList.add('is-invalid');
                document.getElementById('awards_recipients').classList.add('is-invalid');
            }
        });
    </script>
@endsection
