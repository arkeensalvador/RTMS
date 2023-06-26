@extends('backend.layouts.app')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content report">
            <div class="container-fluid">
                <div class="monitoring row">
                    <div class="col-11">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">List of Researchers</h2>
                                <div class="card-tools">
                                    <a href="{{ url('researcher-add') }}" class="btn btn-success"><span><i
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
                                                        <th>Researcher's Name</th>
                                                        <th>Gender</th>
                                                        <th>Contact No.</th>
                                                        <th>Email</th>
                                                        <th>Institution/Agency</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($all as $key => $row)
                                                        <tr>
                                                            <input type="hidden" class="delete_val_id"
                                                                value="{{ $row->id }}">
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $row->name }}</td>
                                                            <td>{{ $row->gender }}</td>
                                                            <td>{{ $row->contact }}</td>
                                                            <td>{{ $row->email }}</td>
                                                            <td>{{ $row->agency }}</td>
                                                            <td>
                                                                <a class="btn btn-primary"
                                                                    href="{{ URL::to('/edit-researcher/' . $row->id) }}"><i
                                                                        class="fa-solid fa-pen-to-square"
                                                                        style="color: white;"></i></a>

                                                                <a href="{{ URL::to('/delete-researcher/' . $row->id) }}"
                                                                    class="btn btn-danger" id="delete"><i
                                                                        class="fa-solid fa-trash"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach     
                                                </tbody>
                                            </table>

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
