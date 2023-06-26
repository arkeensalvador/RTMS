@extends('backend.layouts.app')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content report">
            <div class="container-fluid">
                <div class="monitoring row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="col-sm-12">
                                            <div class="col-sm-12">
                                                <div class="form-group" style="text-align:center">
                                                    <h2>Choose Program</h2>
                                                    <div class="col-sm-12">
                                                        <select class="form-control"
                                                            onchange="window.location.assign(this.value)"
                                                            style="text-align: center">
                                                            <option class="opt" value="#" selected disabled>Choose
                                                                existing program</option>
                                                            <option class="opt" value="rdmc-create-program">Create New
                                                                Program</option>
                                                            @foreach ($programs as $program)
                                                                <option class="opt" value="projects-u-program-add/{{ $program->programID }}">
                                                                    {{ $program->program_title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
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
