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
                            <li class="breadcrumb-item"><a href="rdru-index">RDRU</a></li>
                            <li class="breadcrumb-item active">Technology Promotion Approaches
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
                                <h2 class="card-title">List of Technology Promotion Approaches</h2>
                                <div class="card-tools">
                                    <a href="{{ url('rdru-tpa-add') }}" class="btn btn-success"><span><i
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
                                            <table id="accounts" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>IEC Approaches</th>
                                                        <th>Title</th>
                                                        <th>Agency</th>
                                                        <th>Researchers</th>
                                                        <th>Date</th>
                                                        <th>Details</th>
                                                        <th>Remarks</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                @if (auth()->user()->role == 'Admin')
                                                    <tbody>
                                                        @foreach ($all as $key => $row)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>
                                                                    @php
                                                                        $approach = json_decode($row->tpa_approaches);
                                                                        $forbidden_words = ['Others'];
                                                                        $approach = array_filter($approach, function ($approach) use ($forbidden_words) {
                                                                            return !in_array($approach, $forbidden_words);
                                                                        });
                                                                        $others = $row->is_others;
                                                                        if (!empty($others)) {
                                                                            array_push($approach, $others);
                                                                        }
                                                                        $researchers = json_decode($row->tpa_researchers);
                                                                        $researchers = implode(', ', $researchers);

                                                                        $agency = $row->tpa_agency;

                                                                    @endphp
                                                                    {{ implode(', ', $approach) }}
                                                                </td>
                                                                <td>{{ $row->tpa_title }}</td>
                                                                <td>{{ $agency }}</td>
                                                                <td>{{ $researchers }}</td>
                                                                <td>{{ $row->tpa_date }}</td>
                                                                <td>{{ $row->tpa_details }}</td>
                                                                <td>{{ $row->tpa_remarks }}</td>
                                                                {{-- <td>{{ $row->tpa_activity }}</td> --}}
                                                                <td class="action btns">
                                                                    <a class="btn btn-primary"
                                                                        href="{{ url('edit-tpa/' . $row->id) }}"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: white;"></i></a>
                                                                    <a href="{{ url('delete-tpa/' . $row->id) }}"
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
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>
                                                                    @php
                                                                        $approach = json_decode($row->tpa_approaches);
                                                                        $forbidden_words = ['Others'];
                                                                        $approach = array_filter($approach, function ($approach) use ($forbidden_words) {
                                                                            return !in_array($approach, $forbidden_words);
                                                                        });
                                                                        $others = $row->is_others;
                                                                        if (!empty($others)) {
                                                                            array_push($approach, $others);
                                                                        }
                                                                        $researchers = json_decode($row->tpa_researchers);
                                                                        $researchers = implode(', ', $researchers);

                                                                        $agency = $row->tpa_agency;

                                                                    @endphp
                                                                    {{ implode(', ', $approach) }}
                                                                </td>
                                                                <td>{{ $row->tpa_title }}</td>
                                                                <td>{{ $agency }}</td>
                                                                <td>{{ $researchers }}</td>
                                                                <td>{{ $row->tpa_date }}</td>
                                                                <td>{{ $row->tpa_details }}</td>
                                                                <td>{{ $row->tpa_remarks }}</td>
                                                                {{-- <td>{{ $row->tpa_activity }}</td> --}}
                                                                <td class="action btns">
                                                                    <a class="btn btn-primary"
                                                                        href="{{ url('edit-tpa/' . $row->id) }}"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: white;"></i></a>
                                                                    <a href="{{ url('delete-tpa/' . $row->id) }}"
                                                                        class="btn btn-danger" id="delete"><i
                                                                            class="fa-solid fa-trash"></i></a>

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                @endif
                                            </table>

                                            <a href="{{ url('rdru-index') }}" class="btn btn-default">Back</a>
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
