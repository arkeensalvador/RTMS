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
                                <h2>Agency In-House Reviews (AIHRs)</h2>
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
    </div>
    <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
@endsection
