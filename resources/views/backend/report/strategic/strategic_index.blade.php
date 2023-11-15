@extends('backend.layouts.app')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content report">
            <div class="container-fluid">

                <div class="monitoring row">
                    <div class="col-6">
                        <div class="back-btn col-2">
                            <a href="report-index">
                                <div class="monitoring info-box bg-light">
                                    <div class="monitoring info-box-content">
                                        <span class="back monitoring info-box-number text-center text-muted"><i
                                                class="fa-sharp fa-solid fa-circle-left fa-2xl"></i>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="col-sm-12">
                                            <a href="strategic-program-list">
                                                <div class="monitoring info-box bg-light">
                                                    <div class="monitoring info-box-content">
                                                        <span class="monitoring info-box-number text-center text-muted">
                                                            R&D Programs / Projects Packaged, Approved and Implemented
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-sm-12">
                                            <a href="strategic-collaborative-list">
                                                <div class="monitoring info-box bg-light">
                                                    <div class="monitoring info-box-content">
                                                        <span class="monitoring info-box-number text-center text-muted">
                                                            Collaborative R&D Programs/Projects implemented</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-sm-12">
                                            <a href="strategic-tech-list">
                                                <div class="monitoring info-box bg-light">
                                                    <div class="monitoring info-box-content">
                                                        <span class="monitoring info-box-number text-center text-muted">List
                                                            of Technologies/Information Generated from R&D</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-sm-12">
                                            <a href="strategic-activities">
                                                <div class="monitoring info-box bg-light">
                                                    <div class="monitoring info-box-content">
                                                        <span class="monitoring info-box-number text-center text-muted">List
                                                            of Strategic R & D Activities
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
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
