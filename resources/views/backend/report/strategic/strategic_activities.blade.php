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
                            <li class="breadcrumb-item active">Strategic R&D Activities</li>
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
                                <h2 class="card-title">List of Strategic R & D Activities</h2>
                                <div class="card-tools">
                                    <a href="{{ url('add-strategic-index') }}"
                                        class="btn btn-success {{ Route::current()->getName() == 'add-programs-index' ? 'active' : '' }}"><span><i class="fa-solid fa-plus"></i> Create</span></a>
                                   
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
                                                        <th>Program/Projects</th>
                                                        <th>Title</th>
                                                        <th>Duration</th>
                                                        <th>Researcher</th>
                                                        <th>Funding Agency</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Consortium-led</td>
                                                        <td>Title Example</td>
                                                        <td>October 2019 - March 2022</td>
                                                        <td>Juan Dela Cruz</td>
                                                        <td>DOST_PCAARRD</td>
                                                        <td class="action">
                                                            <a class="btn btn-primary" href="#"><i
                                                                    class="fa-solid fa-pen-to-square"
                                                                    style="color: white;"></i></a>
                                                            <a href="#" class="btn btn-danger" id="delete"><i
                                                                    class="fa-solid fa-trash"></i></a>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            {{-- <a href="#">
                                                <div class="monitoring info-box bg-light">
                                                    <div class="monitoring info-box-content">
                                                        <span class="info-box-number text-center text-muted">Agency In-House
                                                            Reviews (AIHRs)
                                                        </span>
                                                    </div>
                                                </div>
                                            </a> --}}
                                            <a href="{{ url('report-index') }}" class="btn btn-default">Back</a>
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
