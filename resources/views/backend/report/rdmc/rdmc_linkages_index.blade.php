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
                            <li class="breadcrumb-item active">Linkages</li>
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
                                <h2 class="card-title">List of Linkages</h2>
                                <div class="card-tools">

                                    <a href="{{ url('rdmc-linkages-add') }}" class="btn btn-success">
                                        <span><i class="fa-solid fa-plus"></i> Create</span></a>
                                    <!-- Here is a label for example -->
                                    {{-- <span class="badge badge-primary">Label</span> --}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="col-sm-12">
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Type</th>
                                                        <th>Agency/Institution</th>
                                                        <th>Year</th>
                                                        <th>Address</th>
                                                        <th>Nature of Assistance/Linkages/Projects</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (auth()->user()->role == 'Admin')
                                                        @foreach ($all as $key => $row)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $row->type }}</td>
                                                                <td>{{ $row->form_of_development }}</td>
                                                                <td>{{ $row->year }}</td>
                                                                <td>{{ $row->address }}</td>
                                                                <td>{{ $row->nature_of_assistance }}</td>
                                                                <td class="action btns">
                                                                    <a class="btn btn-primary"
                                                                        href="{{ url("edit-linkages/$row->id") }}"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: white;"></i></a>
                                                                    <a href="{{ URL::to('/delete-linkages/' . $row->id) }}"
                                                                        class="btn btn-danger" id="delete"><i
                                                                            class="fa-solid fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        @foreach ($all_filter as $key => $row)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $row->type }}</td>
                                                                <td>{{ $row->form_of_development }}</td>
                                                                <td>{{ $row->year }}</td>
                                                                <td>{{ $row->address }}</td>
                                                                <td>{{ $row->nature_of_assistance }}</td>
                                                                <td class="action btns">
                                                                    <a class="btn btn-primary"
                                                                        href="{{ url("edit-linkages/$row->id") }}"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: white;"></i></a>
                                                                    <a href="{{ URL::to('/delete-linkages/' . $row->id) }}"
                                                                        class="btn btn-danger" id="delete"><i
                                                                            class="fa-solid fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                            <a href="{{ url('rdmc-index') }}" class="btn btn-default">Back</a>
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
    </div>
@endsection
