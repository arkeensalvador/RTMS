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
                            <li class="breadcrumb-item active">Technology Transfer Proposals
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
                                <h2 class="card-title">List of Technology Transfer Proposals</h2>
                                <div class="card-tools">
                                    <a href="{{ url('rdru-add') }}" class="btn btn-success"><span><i
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
                                            <table id="programs" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Classification</th>
                                                        <th>Title</th>
                                                        <th>Budget</th>
                                                        <th>Source of Fund</th>
                                                        <th>Proponent/Researchers</th>
                                                        <th>Implementing Agency</th>
                                                        <th>Duration</th>
                                                        <th>Commodities Addressed</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                @if (auth()->user()->role == 'Admin')
                                                    <tbody>
                                                        @foreach ($all as $key => $row)
                                                            @php
                                                                $sof = json_decode($row->ttp_sof);
                                                                $sof = implode(', ', $sof);

                                                                $res = json_decode($row->ttp_researchers);
                                                                $res = is_array($res) ? implode(', ', $res) : null;

                                                                $imp = json_decode($row->ttp_implementing_agency);
                                                                $imp = implode(', ', $imp);

                                                                $prop = json_decode($row->ttp_proponent);
                                                                $prop = implode(', ', $prop);
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $row->ttp_type }}</td>
                                                                <td>{{ $row->ttp_title }}</td>
                                                                <td>₱{{ number_format($row->ttp_budget, 2) }}</td>
                                                                <td>{{ $sof }}</td>
                                                                <td>{{ $prop }}
                                                                    @if (!empty($res))
                                                                        / {{ $res }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $imp }}</td>
                                                                <td>{{ $row->ttp_date }}</td>
                                                                <td>{{ $row->ttp_priorities }}</td>
                                                                <td class="action btns">
                                                                    <a class="btn btn-primary"
                                                                        href="{{ url("edit-ttp/$row->id") }}"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: white;"></i></a>
                                                                    <a href="{{ url("delete-ttp/$row->id") }}"
                                                                        class="btn btn-danger" id="delete"><i
                                                                            class="fa-solid fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                @else
                                                    <tbody>
                                                        @foreach ($all_filter as $key => $row)
                                                            @php
                                                                $sof = json_decode($row->ttp_sof);
                                                                $sof = implode(', ', $sof);

                                                                $res = json_decode($row->ttp_researchers);
                                                                $res = is_array($res) ? implode(', ', $res) : null;

                                                                $imp = json_decode($row->ttp_implementing_agency);
                                                                $imp = implode(', ', $imp);

                                                                $prop = json_decode($row->ttp_proponent);
                                                                $prop = implode(', ', $prop);
                                                            @endphp
                                                            <tr>
                                                                <td>{{ $row->ttp_type }}</td>
                                                                <td>{{ $row->ttp_title }}</td>
                                                                <td>₱{{ number_format($row->ttp_budget, 2) }}</td>
                                                                <td>{{ $sof }}</td>
                                                                <td>{{ $prop }}
                                                                    @if (!empty($res))
                                                                        / {{ $res }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $imp }}</td>
                                                                <td>{{ $row->ttp_date }}</td>
                                                                <td>{{ $row->ttp_priorities }}</td>
                                                                <td class="action btns">
                                                                    <a class="btn btn-primary"
                                                                        href="{{ url("edit-ttp/$row->id") }}"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: white;"></i></a>
                                                                    <a href="{{ url("delete-ttp/$row->id") }}"
                                                                        class="btn btn-danger" id="delete"><i
                                                                            class="fa-solid fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                @endif
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
