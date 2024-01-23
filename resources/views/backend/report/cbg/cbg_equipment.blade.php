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
                            <li class="breadcrumb-item"><a href="cbg-index">CBG</a></li>
                            <li class="breadcrumb-item active">Equipments/Facilities
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
                                <h2 class="card-title">List of Equipments/Facilities</h2>
                                <div class="card-tools">
                                    <a href="{{ url('cbg-equipment-add') }}" class="btn btn-success"><span><i
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
                                                        <th>#</th>
                                                        <th>Agency</th>
                                                        <th>Type</th>
                                                        <th>Equipment/Facilities</th>
                                                        <th>Details</th>
                                                        <th>Source of Fund</th>
                                                        <th>Expenditures</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                @if (auth()->user()->role == 'Admin')
                                                    <tbody>
                                                        @foreach ($equipment as $key => $row)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $row->equipments_agency }}</td>
                                                                <td>{{ $row->equipments_type }}</td>
                                                                <td>{{ $row->equipments_name }}</td>
                                                                <td>{{ $row->equipments_details }}</td>
                                                                @php
                                                                    $sof = json_decode($row->equipments_sof);
                                                                    $sof = implode(', ', $sof);
                                                                @endphp
                                                                <td>{{ $sof }}</td>
                                                                <td>₱{{ number_format($row->equipments_total, 2) }}</td>
                                                                <td class="action btns">
                                                                    <a class="btn btn-primary"
                                                                        href="{{ url('edit-equipment/' . $row->id) }}"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: white;"></i></a>
                                                                    <a href="{{ url('delete-equipment/' . $row->id) }}"
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
                                                                <td>{{ $row->equipments_agency }}</td>
                                                                <td>{{ $row->equipments_type }}</td>
                                                                <td>{{ $row->equipments_name }}</td>
                                                                <td>{{ $row->equipments_details }}</td>
                                                                @php
                                                                    $sof = json_decode($row->equipments_sof);
                                                                    $sof = implode(', ', $sof);
                                                                @endphp
                                                                <td>{{ $sof }}</td>
                                                                <td>₱{{ number_format($row->equipments_total, 2) }}</td>
                                                                <td class="action btns">
                                                                    <a class="btn btn-primary"
                                                                        href="{{ url('edit-equipment/' . $row->id) }}"><i
                                                                            class="fa-solid fa-pen-to-square"
                                                                            style="color: white;"></i></a>
                                                                    <a href="{{ url('delete-equipment/' . $row->id) }}"
                                                                        class="btn btn-danger" id="delete"><i
                                                                            class="fa-solid fa-trash"></i></a>

                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                @endif
                                            </table>
                                            <a href="{{ url('cbg-index') }}" class="btn btn-default">Back</a>
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
