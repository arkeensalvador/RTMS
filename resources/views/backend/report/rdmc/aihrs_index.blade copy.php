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
                                                    {{-- <span>Number of Projects Presented:</span> --}}
                                                    <thead>
                                                        <tr>
                                                            <th>New</th>
                                                            <th>On-going</th>
                                                            <th>Completed</th>
                                                            <th>Terminated</th>
                                                            <th>Research Category</th>
                                                            <th>Development Category</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th>{{ $new + $new_proj + $new_subproj }}</th>
                                                            <th>{{ $ongoing + $ongoing_proj + $ongoing_subproj }}</th>
                                                            <th>{{ $completed + $completed_proj + $completed_subproj }}</th>
                                                            <th>{{ $terminated + $terminated_proj + $terminated_subproj }}
                                                            </th>
                                                            <th>{{ $prog_research }}</th>
                                                            <th>{{ $prog_dev }}</th>
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
                                                        <th>Evaluator(s)</th>
                                                        <th>Year</th>
                                                        <th>Agency</th>
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
                                                            <td>
                                                                @foreach ($item->evaluators as $key => $evaluator)
                                                                    <li>{{ $evaluator->evaluator_name }}</li>
                                                                @endforeach
                                                            </td>
                                                            <td>{{ $item->best_paper_year }}</td>
                                                            <td>{{ $item->best_paper_fa }}</td>
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

        {{-- Best Poster --}}
        <section class="report">
            <div class="container-fluid">
                <div class="monitoring row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Best Poster</h2>
                                @if (auth()->user()->role == 'Admin')
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#addBestPoster">
                                            <i class="fa-solid fa-plus"></i> Add best poster
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="col-sm-12">
                                            <table id="datatable2" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th hidden>ID</th>
                                                        <th>Image</th>
                                                        <th>Agency</th>
                                                        <th>Year</th>
                                                        @if (auth()->user()->role == 'Admin')
                                                            <th>Action</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($best_poster as $item)
                                                        <tr>
                                                            <td hidden>{{ $item->id }}</td>
                                                            <td>
                                                                <img id="" class="poster"
                                                                    src="{{ asset($item->file_path) }}"
                                                                    alt="Current Poster"
                                                                    style="max-width: 50px; max-height: 50px;">
                                                            </td>
                                                            <td>{{ $item->agency }}</td>
                                                            <td>{{ $item->date }}</td>
                                                            @if (auth()->user()->role == 'Admin')
                                                                <td class="action btns">
                                                                    <a href="{{ url('delete-best-poster/' . Crypt::encryptString($item->id)) }}"
                                                                        class="btn btn-danger" id="delete"><i
                                                                            class="fa-solid fa-trash"></i></a>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
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
    </div>

    <div class="modal fade" id="addBestPoster" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="createContributionModalLabel" aria-hidden="true">
        <!-- Your modal content for creating a new contribution -->

        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <form id="techForm" method="POST" action="{{ url('add-best-poster') }}"
                        class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
                        @csrf

                        <div class="form-title col-12">
                            <h2 class="font-weight-bold">Best Poster</h2>
                            <h5 class="mt-0">Kindly fill-out the fields needed.</h5>
                        </div>

                        <div class="col-md-12 form-group">
                            <img id="preview" class="" src=""
                                style="max-width: 300px; max-height: 300px;">
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="con_name" class=" font-weight-bold">Poster<span
                                    class="text-danger">*</span></label>

                            <input type="file" name="poster" id="poster" accept="image/*" class="form-control"
                                placeholder="Enter file" required>
                            <div class="invalid-feedback">Missing image</div>
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="con_name" class=" font-weight-bold">Agency<span
                                    class="text-danger">*</span></label>

                            <input type="text" name="agency" class="form-control" placeholder="Enter agency"
                                required>
                            <div class="invalid-feedback">Missing agency</div>
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="con_name" class="font-weight-bold">Year<span class="text-danger">*</span></label>

                            <input type="text" name="date" id="date" class="form-control year"
                                placeholder="Enter year" required>
                            <div class="invalid-feedback">Missing year</div>
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

    <div class="modal fade" id="addBestPaper" data-keyboard="false" data-backdrop="static" tabindex="-1"
        role="dialog" aria-labelledby="createContributionModalLabel" aria-hidden="true">
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
                            <label for="con_name" class=" font-weight-bold">Poster<span
                                    class="text-danger">*</span></label>

                            <input type="text" name="best_paper" class="form-control" placeholder="Enter title"
                                required>
                            <div class="invalid-feedback">Missing title</div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label for="con_name" class="font-weight-bold">Year<span class="text-danger">*</span></label>

                            <input type="text" name="best_paper_year" id="best_paper_year" class="form-control year"
                                placeholder="Enter year" required>
                            <div class="invalid-feedback">Missing year</div>
                        </div>


                        <div class="col-md-12 form-group">
                            <label for="con_name" class="font-weight-bold">Agency<span
                                    class="text-danger">*</span></label>

                            <input type="text" name="best_paper_fa" id="best_paper_fa" class="form-control"
                                placeholder="Enter agency" required>
                            <div class="invalid-feedback">Missing agency</div>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Evaluator(s)</label>
                            <table class="table table-append" id="dynamicAddRemove">
                                <tr>
                                    <td class="append">
                                        <input type="text" class="form-control" placeholder="Evaluator"
                                            name="moreFields[0][evaluator_name]" required autocomplete="false">
                                    </td>

                                    <td class="append">
                                        <i class="fa-solid fa-user-plus fa-lg" style="color: #28a745;" name="add"
                                            id="add-btn"></i>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        {{-- <div class="col-md-12 form-group">
                            <label for="con_name" class="font-weight-bold">Evaluators<span
                                    class="text-danger">*</span></label>

                            <input type="text" name="best_paper_evaluators[]" id=""
                                class="form-control research-center" placeholder="Evaluators" data-role="tagsinput"
                                required>
                            <div class="invalid-feedback">Missing evaluators</div>
                        </div> --}}


                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="submit" class="btn btn-primary btn-m ">Submit</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="editBestPaper" data-keyboard="false" data-backdrop="static" tabindex="-1"
        role="dialog" aria-labelledby="editContributionModalLabel" aria-hidden="true">
        <!-- Your modal content for editing an existing contribution -->
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <form id="editForm" method="" action="{{ url('update-best-paper') }}"
                        class="row g-3 needs-validation" novalidate>
                        @csrf
                        @method('PUT')
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

                        <div class="col-md-12 form-group">
                            <label for="con_name" class=" font-weight-bold">Year<span
                                    class="text-danger">*</span></label>

                            <input type="text" name="best_paper_year" id="e_best_paper_year"
                                class="form-control year" placeholder="Enter year" required>
                            <div class="invalid-feedback">Missing year</div>
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="con_name" class="font-weight-bold">Agency<span
                                    class="text-danger">*</span></label>

                            <input type="text" name="best_paper_fa" id="e_best_paper_fa" class="form-control"
                                placeholder="Enter agency" required>
                            <div class="invalid-feedback">Missing agency</div>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Evaluator(s)</label>
                            <table class="table table-append" id="dynamicAddRemoveEdit">
                                <tr>

                                    <td class="append">
                                        <input type="text" class="form-control" placeholder="Evaluator"
                                            name="moreFields[0][evaluator_name]" id="e_evaluator_name" required
                                            autocomplete="false">
                                    </td>

                                    <td class="append">
                                        <i class="fa-solid fa-user-plus fa-lg" style="color: #28a745;" name="add"
                                            id="add-btn-edit"></i>
                                    </td>
                                </tr>
                            </table>
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

    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Image Preview</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align: center">
                    <div class="col-md-12 form-group center">
                        <img id="preview" class="modalImage" src="" alt="Current Poster"
                            style="max-width: 100%; max-height: 100%;">
                    </div>
                </div>
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
                        <input type="text" class="form-control" placeholder="Evaluator" name="moreFields[` + i + `][evaluator_name]">
                    </td>
                    <td class="append">
                        <i class="fa-solid fa-user-minus fa-lg remove-input" style="color: #dc3545;"></i>
                    </td>
                </tr>
             `);
        });

        $("#add-btn-edit").click(function() {
            ++i;

            $("#dynamicAddRemoveEdit").append(`
                <tr>
                    <td class="append">
                        <input type="text" class="form-control" placeholder="Evaluator" name="moreFields[` + i + `][evaluator_name]">
                    </td>
                    <td class="append">
                        <i class="fa-solid fa-user-minus fa-lg remove-input" style="color: #dc3545;"></i>
                    </td>
                </tr>
             `);
        });

        $(document).on('click', '.remove-input', function() {
            $(this).parents('tr').remove();
        });
    </script>
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
                $('#e_best_paper_evaluators').val(data[2]);
                $('#e_best_paper_year').val(data[3]);
                $('#e_best_paper_fa').val(data[4]);
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

    <script>
        $(document).ready(function() {
            // Handle image click events
            $('#datatable2 tbody').on('click', 'img', function() {
                var imageUrl = $(this).attr('src');

                $('.modalImage').attr('src', imageUrl);
                $('#imageModal').modal('show');
            });
        });
    </script>

    <script>
        // Preview uploaded image
        document.getElementById('poster').addEventListener('change', function(event) {
            const preview = document.getElementById('preview');
            preview.src = URL.createObjectURL(event.target.files[0]);
        });
    </script>
@endsection
