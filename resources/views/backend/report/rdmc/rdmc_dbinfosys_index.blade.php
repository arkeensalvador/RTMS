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
                                <h2 class="card-title">List of Database & Information System</h2>
                                <div class="card-tools">

                                    <a href="{{ url('rdmc-dbinfosys-add') }}" class="btn btn-success">
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
                                            <table id="example1" class="table table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Database/Information System</th>
                                                        <th>Type</th>
                                                        <th>Title</th>
                                                        <th>Date Created</th>
                                                        <th>Purpose/Use</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Database</td>
                                                        <td>Developed/Enhanced</td>
                                                        <td>CLSU-RADIS</td>
                                                        <td>November, 2022</td>
                                                        <td>Sample Purpose/Use</td>
                                                        <td class="action">
                                                            <a class="btn btn-primary" href="#"><i
                                                                    class="fa-solid fa-pen-to-square"
                                                                    style="color: white;"></i></a>
                                                            <a href="#" class="btn btn-danger" id="delete"><i
                                                                    class="fa-solid fa-trash"></i></a>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>Information System</td>
                                                        <td>Maintained</td>
                                                        <td>CLAARRDEC - Facebook Page</td>
                                                        <td>January, 2020</td>
                                                        <td>Sample Purpose/Use</td>
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
