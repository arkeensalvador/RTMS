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
                            <li class="breadcrumb-item active">R&D Programs - Projects Packaged, Approved and Implemented
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
                                <h2 class="card-title">List of R&D Programs / Projects Packaged, Approved and Implemented
                                </h2>
                                <div class="card-tools">
                                    <a href="{{ url('add-strategic-program-list-index') }}"
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
                                                        <th>Program/Project Title</th>
                                                        <th>Researcher</th>
                                                        <th>Implementing Agency</th>
                                                        <th>Collaborating Agency</th>
                                                        <th>Duration</th>
                                                        <th>Budget</th>
                                                        <th>Source of Fund</th>
                                                        <th>Commodities Addressed</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                @if (auth()->user()->role == 'Admin')
                                                    <tbody>
                                                        @foreach ($all as $key => $row)
                                                            <tr>
                                                                <td>
                                                                    @if ($row->str_p_type == 'Proposals')
                                                                        {{ 'Proposals Packaged' }}
                                                                    @elseif ($row->str_p_type == 'Approved')
                                                                        {{ 'Approved and Implemented' }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $row->str_p_title }}</td>
                                                                <td>{{ $row->str_p_researchers }}</td>
                                                                @php
                                                                    $imp = json_decode($row->str_p_imp_agency);
                                                                    $imp = implode(', ', $imp);

                                                                    $collab = json_decode($row->str_p_collab_agency);
                                                                    $collab = implode(', ', $collab);

                                                                    $sof = json_decode($row->str_p_sof);
                                                                    $sof = implode(', ', $sof);
                                                                @endphp
                                                                <td> {{ $imp }}</td>
                                                                <td> {{ $collab }}</td>
                                                                <td>{{ $row->str_p_date }}</td>
                                                                <td>₱{{ number_format($row->str_p_budget, 2) }}</td>
                                                                <td>{{ $sof }}</td>
                                                                <td>{{ $row->str_p_regional }}</td>
                                                                <td class="action btns">
                                                                    <a class="btn btn-primary"
                                                                        href="{{ url('edit-strategic-program-list-index/' . Crypt::encryptString($row->id)) }}"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: white;"></i></a>
                                                                    <a href="{{ url('delete-strategic-program-list/' . Crypt::encryptString($row->id)) }}"
                                                                        class="btn btn-danger" id="delete"><i
                                                                            class="fa-solid fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                @else
                                                    <tbody>
                                                        @foreach ($all_filter as $key => $row)
                                                            <tr>
                                                                <td>
                                                                    @if ($row->str_p_type == 'Proposals')
                                                                        {{ 'Proposals Packaged' }}
                                                                    @elseif ($row->str_p_type == 'Approved')
                                                                        {{ 'Approved and Implemented' }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $row->str_p_title }}</td>
                                                                <td>{{ $row->str_p_researchers }}</td>
                                                                @php
                                                                    $imp = json_decode($row->str_p_imp_agency);
                                                                    $imp = implode(', ', $imp);

                                                                    $collab = json_decode($row->str_p_collab_agency);
                                                                    $collab = implode(', ', $collab);

                                                                    $sof = json_decode($row->str_p_sof);
                                                                    $sof = implode(', ', $sof);
                                                                @endphp
                                                                <td> {{ $imp }}</td>
                                                                <td> {{ $collab }}</td>
                                                                <td>{{ $row->str_p_date }}</td>
                                                                <td>₱{{ number_format($row->str_p_budget, 2) }}</td>
                                                                <td>{{ $sof }}</td>
                                                                <td>{{ $row->str_p_regional }}</td>
                                                                <td class="action btns">
                                                                    <a class="btn btn-primary"
                                                                        href="{{ url('edit-strategic-program-list-index/' . Crypt::encryptString($row->id)) }}"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: white;"></i></a>
                                                                    <a href="{{ url('delete-strategic-program-list/' . Crypt::encryptString($row->id)) }}"
                                                                        class="btn btn-danger" id="delete"><i
                                                                            class="fa-solid fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                @endif
                                            </table>
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
