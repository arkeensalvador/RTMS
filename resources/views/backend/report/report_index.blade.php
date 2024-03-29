@extends('backend.layouts.app')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content report">
            <div class="container-fluid">
                <div class="monitoring row">
                    <div class="col-6">
                        <div class="card">

                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="col-sm-12">
                                            <a href="rdmc-index">
                                                <div class="monitoring info-box bg-light">
                                                    <div class="monitoring info-box-content">
                                                        <span class="monitoring info-box-number text-center text-muted">R &
                                                            D
                                                            Management and Coordination
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-sm-12">
                                            <a href="strategic-index">
                                                <div class="monitoring info-box bg-light">
                                                    <div class="monitoring info-box-content">
                                                        <span
                                                            class="monitoring info-box-number text-center text-muted">Strategic
                                                            R & D
                                                            Activities
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-sm-12">
                                            <a href="rdru-index">
                                                <div class="monitoring info-box bg-light">
                                                    <div class="monitoring info-box-content">
                                                        <span class="monitoring info-box-number text-center text-muted">R &
                                                            D Results
                                                            Utilization</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-sm-12">
                                            <a href="cbg-index">
                                                <div class="monitoring info-box bg-light">
                                                    <div class="monitoring info-box-content">
                                                        <span
                                                            class="monitoring info-box-number text-center text-muted">Capability
                                                            Building
                                                            and Governance</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-sm-12">
                                            <a href="policy-index">
                                                <div class="monitoring info-box bg-light">
                                                    <div class="monitoring info-box-content">
                                                        <span
                                                            class="monitoring info-box-number text-center text-muted">Policy
                                                            Analysis and Advocacy</span>
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
