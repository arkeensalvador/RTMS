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
                                <table id="programs" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            {{-- <th>Trust Fund</th> --}}
                                            <th>Duration</th>
                                            {{-- <th>End Date</th> --}}
                                            {{-- <th>Extension Date</th> --}}
                                            <th>Funding Agency</th>
                                            <th>Program Title</th>
                                            <th>Description</th>
                                            {{-- <th>Approved Budget</th>
                                        <th>Amount of Release</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all as $key => $row)
                                            <tr>
                                                {{-- <td>{{ $row->trust_fund_code }}</td> --}}
                                                <td>
                                                    {{ date('F, Y', strtotime($row->start_date)) ?: 'Not Set' }} -
                                                    {{ date('F, Y', strtotime($row->end_date)) ?: 'Not Set' }}
                                                </td>
                                                {{-- <td>{{ $row->project_extension_date }}</td> --}}
                                                <td>{{ $row->funding_agency }}</td>
                                                <td>{{ $row->program_title }}</td>
                                                <td>{{ $row->program_description }}</td>
                                                {{-- <td>{{ $row->amount_of_release }}</td> --}}
                                                <td class="action">
                                                    <span title="View">
                                                        <a class="btn btn-info"
                                                            href="{{ url("view-program-index/$row->programID") }}"><i
                                                                class="fa-solid fa-eye" style="color: white;"></i></a>
                                                    </span>

                                                    <span title="Edit">
                                                        <a class="btn btn-primary"
                                                            href="{{ url("edit-program-index/$row->programID") }}"><i
                                                                class="fa-solid fa-pen-to-square"
                                                                style="color: white;"></i></a>
                                                    </span>

                                                    <span title="Upload">
                                                        <a class="btn btn-secondary"
                                                            href="{{ url("upload-file/$row->programID") }}"><i
                                                                class="fa-solid fa-file-circle-plus"></i></a>
                                                    </span>

                                                    <span title="Staffs">
                                                        <a class="btn btn-warning"
                                                            href="{{ URL::to('/add-program-personnel-index/' . $row->programID) }}">
                                                            <i class="fa-solid fa-user-plus"></i>
                                                        </a>
                                                    </span>

                                                    <a href="{{ URL::to('/delete-program/' . $row->id) }}"
                                                        class="btn btn-danger" id="delete"><i
                                                            class="fa-solid fa-trash"></i></a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            {{-- <th>Trust Fund</th> --}}
                                            <th>Duration</th>
                                            {{-- <th>Extension Date</th> --}}
                                            <th>Funding Agency</th>
                                            <th>Project Title</th>
                                            <th>Description</th>
                                            {{-- <th>Approved Budget</th>
                                        <th>Amount of Release</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                The footer of the card
                            </div>
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

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Import to Database
                        <span title="Click to download format">
                            <a href="{{url('download-template')}}" class="" download><i class="fa-solid fa-file-circle-question"></i></a>
                        </span>
                    </h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('import-file') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="file" name="import_excel_programs" accept="application/vnd.ms-excel" class="form-control" id="import_excel">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-success">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
