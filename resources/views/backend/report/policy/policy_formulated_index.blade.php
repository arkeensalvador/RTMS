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
                        <ol class="breadcrumb float-sm-right" style="font-size: 1.2rem">
                            <li class="breadcrumb-item"><a href="home">Home</a></li>
                            <li class="breadcrumb-item"><a href="report-index">Reports</a></li>
                            <li class="breadcrumb-item"><a href="policy-index">Policy</a></li>
                            <li class="breadcrumb-item active">Policies formulated, advocated, implemented institutional and
                                institutionalized
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
                                <h2 class="card-title policy-formulated" style="font-size: 1.3rem">List of Policies
                                    formulated, advocated, implemented
                                    institutional and institutionalized</h2>
                                <div class="card-tools">
                                    <a href="{{ url('policy-formulated-add') }}" class="btn btn-success"><span><i
                                                class="fa-solid fa-plus"></i> Add</span></a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="col-sm-12">
                                            <table id="programs" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Type</th>
                                                        <th>Agency</th>
                                                        <th>Date</th>
                                                        <th>Resource Person(s)</th>
                                                        <th>Topic Issues</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($all as $key => $row)
                                                        <tr>
                                                            <td>{{ $row->id }}</td>
                                                            <td>{{ $row->policy_type }}</td>
                                                            <td>{{ $row->policy_agency }}</td>
                                                            <td>{{ date('m-d-Y', strtotime($row->policy_date)) }}</td>
                                                            <td>{{ $row->policy_resource }}</td>
                                                            <td>{{ $row->policy_issues }}</td>
                                                            <td class="action btns">
                                                                <a href="{{ url('edit-formulated/' . Crypt::encryptString($row->id)) }}"
                                                                    class="btn btn-primary"><i
                                                                        class="fa-solid fa-pen-to-square"
                                                                        style="color: white;"></i></a>
                                                                <a href="{{ url('delete-formulated/' . Crypt::encryptString($row->id)) }}"
                                                                    class="btn btn-danger" id="delete"><i
                                                                        class="fa-solid fa-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <a href="{{ url('policy-formulated') }}" class="btn btn-default">Back</a>
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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    </div>
@endsection
