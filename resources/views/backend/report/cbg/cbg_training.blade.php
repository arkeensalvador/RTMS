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
                                <h2 class="card-title">List of Trainings</h2>
                                <div class="card-tools">
                                    <a href="{{ url('cbg-training-add') }}"
                                        class="btn btn-success"><span><i class="fa-solid fa-plus"></i> Create</span></a>
                                   
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
                                                        <th>Title of Activity/Training</th>
                                                        <th>Date</th>
                                                        <th>No. of Participants</th>
                                                        <th>Expenditures</th>
                                                        <th>Source of Fund</th>
                                                        <th>Implementing Agency</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Training on Experimental Design and Data Management in Agricultural Research using STAR of CLAARRDEC CMIs</td>
                                                        <td>November 25, 2022 - November 27, 2022</td>
                                                        <td>30 Faculty/Teachers</td>
                                                        <td>200,000</td>
                                                        <td>CLAARRDEC</td>
                                                        <td>CLSU</td>
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
                                                        <td>Bayanihan Act Program</td>
                                                        <td>February 2021 to Present</td>
                                                        <td>30 farmers + 10 AEWs 100 org members</td>
                                                        <td>275,000</td>
                                                        <td>Department of Agriculture - Bayanihan Act</td>
                                                        <td>CLSU</td>
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
