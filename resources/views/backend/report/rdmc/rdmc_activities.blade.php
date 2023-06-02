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
                                <h2 class="card-title">List of Projects</h2>
                                <div class="card-tools">

                                    <a href="{{ url('projects-add') }}" class="btn btn-success"
                                        onclick="event.preventDefault();
                                        
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'Is your project under a program?',
                                            confirmButtonText: 'Yes',
                                            cancelButtonText: 'No',
                                            showCancelButton: true,
                                            reverseButtons: true,
                                            buttons: true,
                                            allowEscapeKey: false,
                                            allowOutsideClick: false,
                                        })
                                        .then((result) => { 
                                            var link= $(this).attr('href');
                                            if (result.isConfirmed) {
                                                window.location.href = 'rdmc-choose-program';
                                            } else if (result.isDismissed){
                                                window.location.href = link;
                                            }
                                        }); ">

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
                                                        <th>Donor/Source</th>
                                                        <th>Activity/Project</th>
                                                        <th>Amount Shared</th>
                                                        <th>Remarks</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>DA-RFO3</td>
                                                        <td>Analysis of the DA RFO3’s Rice Program’s Research and Development Investment towards Identification of Regional Rice R&D Agenda</td>
                                                        <td>P 1,000,000.00</td>
                                                        <td>The project aims to analyze the Research and Development investment on Rice Program of the DARFO3 and provide database and information for program planning and implementation</td>
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
                                                        <td>PCAARRD</td>
                                                        <td>Support to the Implementation of Collaborative Program on AANR in Region III</td>
                                                        <td>P 3,067,452.00</td>
                                                        <td>Implementation of consortium activities</td>
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
