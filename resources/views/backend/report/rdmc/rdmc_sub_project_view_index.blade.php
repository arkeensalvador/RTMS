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
                            <li class="breadcrumb-item "><a href="rdmc-projects">Projects</a></li>
                            <li class="breadcrumb-item active">Sub Projects</li>
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
                                <h2 class="card-title">{{ $sub_project_title->project_title }}(Sub-projects)</h2>
                                <div class="card-tools">
                                    {{-- <a href="{{ url('view-subprojects') }}" class="btn btn-primary">Sub-projects</a> --}}

                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdrop">
                                        <i class="fa-solid fa-cloud-arrow-up"></i>
                                        Import
                                    </button>


                                    <a href="{{ url('sub-projects-add/' . $sub_project_title->id) }}"
                                        class="btn btn-success">
                                        <i class="fa-solid fa-plus"></i> Create</span></a>
                                    <!-- Here is a label for example -->
                                    {{-- <span class="badge badge-primary">Label</span> --}}
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="col-sm-12">
                                            <table id="projects" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Fund Code</th>
                                                        <th>Sub-Project Title</th>
                                                        <th>Duration</th>
                                                        {{-- <th>Extend Date</th> --}}
                                                        <th>Leader</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($sub_projects as $key => $row)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $row->sub_project_fund_code }}</td>
                                                            <td>{{ $row->sub_project_title }}</td>
                                                            <td>{{ date('F, Y', strtotime($row->sub_project_start_date)) ?: 'Not Set' }}
                                                                -
                                                                @if ($row->sub_project_extend_date)
                                                                    {{ date('F, Y', strtotime($row->sub_project_extend_date)) ?: 'Not Set' }}
                                                                @else
                                                                    {{ date('F, Y', strtotime($row->sub_project_end_date)) ?: 'Not Set' }}
                                                                @endif
                                                            </td>
                                                            {{-- <td>{{ $row->project_extend_date }}</td> --}}
                                                            <td>{{ $row->sub_project_leader }}</td>
                                                            <td>
                                                                @if ($row->sub_project_status == 'Terminated')
                                                                    <span
                                                                        class="right badge badge-danger">{{ $row->sub_project_status }}</span>
                                                                @else
                                                                    @if ($row->sub_project_status == 'Completed')
                                                                        <span
                                                                            class="right badge badge-success">{{ $row->sub_project_status }}</span>
                                                                    @else
                                                                        @if ($row->sub_project_status == 'On-going')
                                                                            <span
                                                                                class="right badge badge-info">{{ $row->sub_project_status }}</span>
                                                                        @else
                                                                            @if ($row->sub_project_status == 'New')
                                                                                <span
                                                                                    class="right badge badge-primary">{{ $row->sub_project_status }}</span>
                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif

                                                            </td>
                                                            <td class="action">
                                                                <span title="View">
                                                                    <a class="btn btn-info"
                                                                        href="{{ url("view-subprojects/$row->projectID/$row->id") }}"><i
                                                                            class="fa-solid fa-eye"
                                                                            style="color: white;"></i></a>
                                                                </span>


                                                                <span title="Edit">
                                                                    <a class="btn btn-primary"
                                                                        href="{{ url("edit-sub-project/$row->projectID/$row->id") }}"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: white;"></i></a>
                                                                </span>


                                                                <span title="Upload">
                                                                    <a class="btn btn-secondary"
                                                                        href="{{ url("sub-project-upload-file/$row->projectID/$row->id") }}"><i
                                                                            class="fa-solid fa-file-circle-plus"></i></a>
                                                                </span>


                                                                <span title="Staffs">
                                                                    <a class="btn btn-warning"
                                                                        href="{{ URL::to("/add-sub-project-personnel/$row->projectID/$row->id") }}">
                                                                        <i class="fa-solid fa-user-plus"></i>
                                                                    </a>
                                                                </span>

                                                                <a href="{{ URL::to('/delete-sub-project/' . $row->id) }}"
                                                                    class="btn btn-danger" id="delete"><i
                                                                        class="fa-solid fa-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <a href="{{ url('rdmc-projects') }}" class="btn btn-default">Back</a>
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

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Import to Database
                        <span title="Click to download format">
                            <a href="{{ url('download-template-subprojects') }}" class="" download><i
                                    class="fa-solid fa-file-circle-question"></i></a>
                        </span>
                    </h1>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('import-file') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="file" name="import_excel_sub_projects" accept="application/vnd.ms-excel"
                            class="form-control" id="import_excel_sub_projects">
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