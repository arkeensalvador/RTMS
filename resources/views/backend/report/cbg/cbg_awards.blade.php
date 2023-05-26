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
                                <h2 class="card-title">List of Awards Received</h2>
                                <div class="card-tools">
                                    <a href="{{ url('cbg-awards-add') }}"
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
                                                        <th>Type of Award</th>
                                                        <th>Title</th>
                                                        <th>Recipient/Agency</th>
                                                        <th>Sponsor</th>
                                                        <th>Event/Activity</th>
                                                        <th>Place of Award</th>
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>National</td>
                                                        <td>Best Paper - Development Category</td>
                                                        <td>Hermogenes M. Paguia, et.al. / BPSU</td>
                                                        <td>PCAARRD</td>
                                                        <td>NSAARRD</td>
                                                        <td>Los Banos, Laguna</td>
                                                        <td>November, 2020</td>
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
                                                        <td>Regional</td>
                                                        <td>Pag-Lingkod Bayan Regional Award</td>
                                                        <td>Hope Behind Bar Project/BPSU</td>
                                                        <td>Civil Service Commision</td>
                                                        <td>Pag-Lingkod Bayan Regional Award</td>
                                                        <td>San Fernando City, Pampanga</td>
                                                        <td>September, 2021</td>
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
