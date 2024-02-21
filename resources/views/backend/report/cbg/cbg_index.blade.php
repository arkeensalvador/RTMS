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
                                            <a href="cbg-training">
                                                <div class="monitoring info-box bg-light">
                                                    <div class="monitoring info-box-content">
                                                        <span
                                                            class="monitoring info-box-number text-center text-muted">Training
                                                            - Workshop
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        @if (auth()->user()->role == 'Admin')
                                            <div class="col-sm-12">
                                                <a href="cbg-meetings">
                                                    <div class="monitoring info-box bg-light">
                                                        <div class="monitoring info-box-content">
                                                            <span
                                                                class="monitoring info-box-number text-center text-muted">Meetings</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                        <div class="col-sm-12">
                                            <a href="cbg-awards">
                                                <div class="monitoring info-box bg-light">
                                                    <div class="monitoring info-box-content">
                                                        <span
                                                            class="monitoring info-box-number text-center text-muted">Awards
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        @if (auth()->user()->role == 'Admin')
                                            <div class="col-sm-12">
                                                <a href="cbg-contributions">
                                                    <div class="monitoring info-box bg-light">
                                                        <div class="monitoring info-box-content">
                                                            <span
                                                                class="monitoring info-box-number text-center text-muted">CMI's
                                                                Contributions
                                                            </span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>


                                            <div class="col-sm-12">
                                                <a href="cbg-initiatives">
                                                    <div class="monitoring info-box bg-light">
                                                        <div class="monitoring info-box-content">
                                                            <span
                                                                class="monitoring info-box-number text-center text-muted">New
                                                                Initiatives on Governance</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endif

                                        <div class="col-sm-12">
                                            <a href="cbg-equipment">
                                                <div class="monitoring info-box bg-light">
                                                    <div class="monitoring info-box-content">
                                                        <span
                                                            class="monitoring info-box-number text-center text-muted">Equipments/Facilities</span>
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
