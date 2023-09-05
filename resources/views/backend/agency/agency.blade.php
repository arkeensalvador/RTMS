@extends('backend.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
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
                            <li class="breadcrumb-item active">Agency</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="strategic row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">List of Agencies</h3>
                                <div class="card-tools">

                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                        Import
                                    </button>

                                    <a href="{{ url('add-agency-index') }}"
                                        class="btn btn-success {{ Route::current()->getName() == 'add-agency-index' ? 'active' : '' }}">Add
                                        Agency</a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="accounts" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Agency</th>
                                            <th>Abbrev.</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all as $key => $row)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $row->agency_name }}</td>
                                                <td>
                                                    {{ $row->abbrev }}
                                                    {{-- <a href="{{ URL::to('/view-projects/'.$row->idnumber)}}"
                                                class="">
                                                    {{$row->instname}}
                                            </a> --}}
                                                </td>
                                                <td class="action btns">
                                                    <a class="btn btn-primary"
                                                        href="{{ URL::to('/edit-agency/' . $row->id) }}"><i
                                                            class="fa-solid fa-pen-to-square" style="color: white;"></i></a>

                                                    <a href="{{ URL::to('/delete-agency/' . $row->id) }}"
                                                        class="btn btn-danger" id="delete"><i
                                                            class="fa-solid fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Agency</th>
                                            <th>Abbrev.</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
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
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Import to Database
                        <span title="Click to download format">
                            <a href="{{ url('download-template-agency') }}" class="" download><i
                                    class="fa-solid fa-file-circle-question"></i></a>
                        </span>
                    </h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('import-file') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="file" name="import_excel_agency" accept="application/vnd.ms-excel"
                            class="form-control" id="import_excel_agency">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
