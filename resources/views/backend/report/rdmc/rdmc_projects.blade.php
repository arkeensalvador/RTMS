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
                                                        <th>Fund Code</th>
                                                        <th>Project Title</th>
                                                        <th>Start Date</th>
                                                        <th>End Date</th>
                                                        <th>Extend Date</th>
                                                        <th>Leader</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td># 417-002</td>
                                                        <td>Pilot Testing on the Use of Nanogold-based DNA Probe Rapid
                                                            Detection Kit for Aeromonas hydrophila</td>
                                                        <td>1/1/2021</td>
                                                        <td>12/31/2022</td>
                                                        <td>No data</td>
                                                        <td>Maria Excelsis M. Orden</td>
                                                        <td>New</td>
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
                                                        <td># 417-107</td>
                                                        <td>Increasing Productivity and income from Crop Production in
                                                            Marginalized Farms in Zambales through Promotion and Adoption of
                                                            Appropriate Technologies</td>
                                                        <td>10/1/2018</td>
                                                        <td>11/30/2019</td>
                                                        <td>12/31/2019</td>
                                                        <td>Constancia C. Dacumos</td>
                                                        <td>On-going</td>
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
