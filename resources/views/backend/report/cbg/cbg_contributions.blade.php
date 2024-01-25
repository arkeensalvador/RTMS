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
                            <li class="breadcrumb-item"><a href="cbg-index">CBG</a></li>
                            <li class="breadcrumb-item active">Contributions
                            </li>
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
                                <h2 class="card-title">List of Contributions</h2>
                                <div class="card-tools">
                                    <span><button type="button" class="btn btn-success" data-toggle="modal"
                                            data-target="#createContributionModal">
                                            <i class="fa-solid fa-plus"></i>Add
                                        </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="col-sm-12">
                                            <table id="datatable" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Contributor</th>
                                                        <th>Amount</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($contributions as $key => $row)
                                                        <tr>
                                                            <td>{{ $row->id }}</td>
                                                            <td>{{ $row->con_name }}</td>
                                                            <td>{{ $row->con_amount }}</td>
                                                            <td class="action btns">
                                                                <a class="btn btn-primary editContributionModal"
                                                                    data-toggle="modal" data-id="'.$row->id.'"
                                                                    data-target="#editContributionModal"><i
                                                                        class="fa-solid fa-pen-to-square"
                                                                        style="color: white;"></i></a>
                                                                <a href="{{ url('delete-contributions/' . $row->id) }}"
                                                                    class="btn btn-danger" id="delete"><i
                                                                        class="fa-solid fa-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <a href="{{ url('cbg-index') }}" class="btn btn-default">Back</a>
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
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <!-- Create Contribution Modal -->
        <div class="modal fade" id="createContributionModal" data-keyboard="false" data-backdrop="static" tabindex="-1"
            role="dialog" aria-labelledby="createContributionModalLabel" aria-hidden="true">
            <!-- Your modal content for creating a new contribution -->

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <form id="techForm" method="POST" action="{{ url('add-contributions') }}"
                            class="row g-3 needs-validation" novalidate>
                            @csrf
                            <div class="form-title col-12">
                                <h2 class="font-weight-bold">Contributions</h2>
                                <h5 class="mt-0"> Kindly fill-out the fields needed.</h5>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="con_name" class=" font-weight-bold">Contributor<span
                                        class="text-danger">*</span></label>

                                <input type="text" name="con_name" class="form-control" placeholder="Enter name"
                                    required>
                                <div class="invalid-feedback">Missing name</div>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="con_amount" class=" font-weight-bold">Amount<span
                                        class="text-danger">*</span></label>

                                <input type="text" name="con_amount" class="form-control"
                                    onkeypress="return isNumberKey(event)" placeholder="Enter amount" required>
                                <div class="invalid-feedback">Missing amount</div>
                            </div>

                            {{-- <div class="col-md-12 form-group buttons">
                                <a href="{{ url('cbg-index') }}" class="btn btn-default">Back</a>
                                
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

        <!-- Edit Contribution Modal -->
        <div class="modal fade" id="editContributionModal" data-keyboard="false" data-backdrop="static" tabindex="-1"
            role="dialog" aria-labelledby="editContributionModalLabel" aria-hidden="true">
            <!-- Your modal content for editing an existing contribution -->

            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-body">
                        <form id="editForm" method="POST" action="{{ url('update-contributions') }}"
                            class="row g-3 needs-validation" novalidate>
                            @csrf
                            <div class="form-title col-12">
                                <h2 class="font-weight-bold">Contributions</h2>
                                <h5 class="mt-0"> Kindly fill-out the fields needed.</h5>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="con_name" class=" font-weight-bold">Contributor<span
                                        class="text-danger">*</span></label>

                                <input type="text" name="con_name" id="e_con_name" class="form-control"
                                    placeholder="Enter name" required>
                                <div class="invalid-feedback">Missing name</div>
                            </div>

                            <div class="col-md-12 form-group">
                                <label for="con_amount" class=" font-weight-bold">Amount<span
                                        class="text-danger">*</span></label>

                                <input type="text" name="con_amount" id="e_con_amount"
                                    onkeypress="return isNumberKey(event)" class="form-control"
                                    placeholder="Enter amount" required>
                                <div class="invalid-feedback">Missing amount</div>
                            </div>

                            {{-- <div class="col-md-12 form-group buttons">
                                <a href="{{ url('cbg-index') }}" class="btn btn-default">Back</a>
                                
                            </div> --}}

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="submit" class="btn btn-primary btn-m ">Update</button>
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

                table.on('click', '.editContributionModal', function() {
                    $tr = $(this).closest('tr');
                    if ($($tr).hasClass('child')) {
                        $tr = $tr.prev('.parent');
                    }
                    var data = table.row($tr).data();
                    console.log(data);

                    $('#e_con_name').val(data[1]);
                    $('#e_con_amount').val(data[2]);

                    $('#editForm').attr('action', '/update-contributions/' + data[0]);
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
    </div>
@endsection
