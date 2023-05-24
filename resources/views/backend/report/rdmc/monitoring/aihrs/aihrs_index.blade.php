@extends('backend.layouts.app')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content report">
        <div class="container-fluid">
            <div class="row">
                <div class="col-8">
                    <div class="card">

                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="col-sm-12">
                                        <a href="#">
                                            <div class="monitoring info-box bg-light">
                                                <div class="monitoring info-box-content">
                                                    <span class="info-box-number text-center text-muted">Agency In-House Reviews (AIHRs)
                                                    </span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-sm-12">
                                        <a href="#">
                                            <div class="monitoring info-box bg-light">
                                                <div class="monitoring info-box-content monitoring">
                                                    <span class="monitoring info-box-number text-center text-muted">Projects
                                                    </span>

                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="col-sm-12">
                                        <a href="#">
                                            <div class="monitoring info-box bg-light monitoring">
                                                <div class="monitoring info-box-content monitoring">
                                                    <span class="monitoring info-box-number text-center text-muted">Activities</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                    <!-- <div class="col-sm-12">
                                        <a href="#">
                                            <div class="monitoring info-box bg-light monitoring">
                                                <div class="monitoring info-box-content monitoring">
                                                    <span class="monitoring info-box-number text-center text-muted">Capability Building
                                                        and Governance</span>
                                                </div>
                                            </div>
                                        </a>
                                    </div> -->
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