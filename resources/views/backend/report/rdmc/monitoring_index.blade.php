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
                            <a href="rdmc-index">
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
                                        @if (auth()->user()->role == 'Admin')
                                            <div class="col-sm-12">
                                                <a href="aihrs">
                                                    <div class="monitoring info-box bg-light">
                                                        <div class="monitoring info-box-content">
                                                            <span
                                                                class="monitoring info-box-number text-center text-muted">Agency
                                                                In-House Reviews (AIHRs)
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-sm-12">
                                                <a href="rdmc-regional">
                                                    <div class="monitoring info-box bg-light">
                                                        <div class="monitoring info-box-content">
                                                            <span
                                                                class="monitoring info-box-number text-center text-muted">Regional
                                                                Symposium on R&D Highlights</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                            <div class="col-sm-12">
                                                <a href="rdmc-regional-participants">
                                                    <div class="monitoring info-box bg-light">
                                                        <div class="monitoring info-box-content">
                                                            <span
                                                                class="monitoring info-box-number text-center text-muted">Participants
                                                                of Regional Symposium on R&D Highlights</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endif

                                        <div class="col-sm-12">
                                            <a href="rdmc-projects">
                                                <div class="monitoring info-box bg-light">
                                                    <div class="monitoring info-box-content">
                                                        <span
                                                            class="monitoring info-box-number text-center text-muted">Projects
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="col-sm-12">
                                            <a href="rdmc-activities">
                                                <div class="monitoring info-box bg-light">
                                                    <div class="monitoring info-box-content">
                                                        <span
                                                            class="monitoring info-box-number text-center text-muted">Resources
                                                            / Generation / Sharing</span>
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
