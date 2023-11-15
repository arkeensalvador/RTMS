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
                            <li class="breadcrumb-item"><a href="strategic-index">Strategic R&D</a></li>
                            <li class="breadcrumb-item active">R&D Programs / Projects Packaged, Approved and Implemented
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
                                <h2 class="card-title">List of Collaborative R&D Programs/Projects implemented
                                </h2>
                                <div class="card-tools">
                                    <a href="{{ url('add-strategic-collaborative-list-index') }}"
                                        class="btn btn-success {{ Route::current()->getName() == 'add-programs-index' ? 'active' : '' }}"><span><i
                                                class="fa-solid fa-plus"></i> Create</span></a>
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
                                                        <th>Program/Project Type</th>
                                                        <th>Program Title</th>
                                                        <th>Project Title</th>
                                                        <th>Implementing Agency</th>
                                                        <th>Collaborating Agency</th>
                                                        <th>Duration</th>
                                                        <th>Budget</th>
                                                        <th>Source of Fund</th>
                                                        <th>Role of Consortium</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($all as $key => $row)
                                                        <tr>
                                                            <td>{{ $row->str_collab_type }}</td>
                                                            <td>{{ $row->str_collab_program_title }}</td>
                                                            @php

                                                                $imp = json_decode($row->str_collab_imp_agency);
                                                                $imp = implode(', ', $imp);

                                                                $collab = json_decode($row->str_collab_agency);
                                                                $collab = implode(', ', $collab);

                                                                $proj = json_decode($row->str_collab_project);
                                                                $proj = implode(', ', $proj);
                                                            @endphp
                                                            <td> {{ $proj }} </td>
                                                            <td> {{ $imp }} </td>
                                                            <td> {{ $collab }}</td>
                                                            <td>{{ $row->str_collab_date }}</td>
                                                            <td>₱{{ number_format($row->str_collab_budget) }}</td>
                                                            <td>{{ $row->str_collab_sof }}</td>
                                                            <td>{{ $row->str_collab_roc }}</td>
                                                            <td class="action btns">
                                                                <a class="btn btn-primary"
                                                                    href="{{ url('edit-strategic-collaborative-list-index/' . Crypt::encryptString($row->id)) . '/' . $row->str_collab_program }}"><i
                                                                        class="fa-solid fa-pen-to-square"
                                                                        style="color: white;"></i></a>
                                                                <a href="{{ url('delete-strategic-collaborative-list/' . Crypt::encryptString($row->id)) }}"
                                                                    class="btn btn-danger" id="delete"><i
                                                                        class="fa-solid fa-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
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
                                            <a href="{{ url('strategic-index') }}" class="btn btn-default">Back</a>
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
