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
                            <li class="breadcrumb-item active">Participants of Regional Symposium Highlights</li>
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
                                <h2 class="card-title">List of Regional Symposium Highlights Participants</h2>
                                <div class="card-tools">

                                    <a href="{{ url('rdmc-regional-participants-add') }}" class="btn btn-success">
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
                                            <table id="accounts" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Type of participants</th>
                                                        <th>Agency / Association</th>
                                                        <th>No. of participants</th>
                                                        <th>Remarks</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($all as $key => $row)
                                                        <tr>
                                                            <td class="counter">
                                                                {{ $key + 1 }}
                                                            </td>
                                                            <td>
                                                                {{ $row->rp_type }}
                                                            </td>
                                                            {{-- <td>{{ $row->activity_type }}</td> --}}
                                                            <td>{{ $row->rp_agency }}</td>
                                                            {{-- <td>
                                                                @php
                                                                    $imp = json_decode($row->regional_implementing_agency);
                                                                    $imp = implode(', ', $imp);

                                                                    $researchers = json_decode($row->regional_researchers);
                                                                    $researchers = implode(', ', $researchers);
                                                                @endphp
                                                                {{ $imp }}
                                                            </td>
                                                            <td>{{ $researchers }}</td> --}}
                                                            <td>{{ $row->rp_no }}</td>
                                                            <td>{{ $row->rp_remarks }}</td>
                                                            <td class="action">
                                                                <a class="btn btn-primary"
                                                                    href="{{ url('edit-regional-participants/' . Crypt::encryptString($row->id)) }}"><i
                                                                        class="fa-solid fa-pen-to-square"
                                                                        style="color: white;"></i></a>

                                                                <a href="{{ URL::to('/delete-regional-participants/' . Crypt::encryptString($row->id)) }}"
                                                                    class="btn btn-danger" id="delete"><i
                                                                        class="fa-solid fa-trash"></i></a>
                                                            </td>
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