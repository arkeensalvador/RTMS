@extends('backend.layouts.app')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of Programs</h3>
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->

                                @if($agency->isEmpty())
                                <a href="{{ url('rdmc-create-program') }}"
                                    class="btn btn-success {{ Route::current()->getName() == 'rdmc-create-program' ? 'active' : '' }}"
                                    hidden>Add
                                    Program</a>

                                @else
                                <a href="{{ url('rdmc-create-program') }}"
                                    class="btn btn-success {{ Route::current()->getName() == 'rdmc-create-program' ? 'active' : '' }}">Add
                                    Program</a>
                                @endif


                                <!-- Here is a label for example -->
                                {{-- <span class="badge badge-primary">Label</span> --}}
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" >
                                <thead>
                                    <tr>
                                        {{-- <th>Trust Fund</th> --}}
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        {{-- <th>Extension Date</th> --}}
                                        <th>Funding Agency</th>
                                        <th>Project Title</th>
                                        <th>Description</th>
                                        {{-- <th>Approved Budget</th>
                                        <th>Amount of Release</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($all as $key => $row)
                                    <tr>
                                        {{-- <td>{{ $row->trust_fund_code }}</td> --}}
                                        <td>
                                            @empty($row->start_date)
                                            <p>Not Set</p>
                                            @else
                                            {{ $row->start_date }}
                                            @endempty
                                        </td>
                                        <td>
                                            @empty($row->end_date)
                                            <p>Not Set</p>
                                            @else
                                            {{ $row->end_date }}
                                            @endempty
                                        </td>
                                        {{-- <td>{{ $row->project_extension_date }}</td> --}}
                                        <td>{{ $row->agencyID }}</td>
                                        <td>{{ $row->program_title }}</td>
                                        <td>{{ $row->program_description }}</td>
                                        {{-- <td>{{ $row->amount_of_release }}</td> --}}
                                        <td class="action">
                                            <a class="btn btn-info" href="{{ url("view-program-index/$row->programID")
                                                }}"><i class="fa-solid fa-eye" style="color: white;"></i></a>

                                            <a class="btn btn-primary" href="{{ url("edit-program-index/$row->programID") }}"><i
                                                    class="fa-solid fa-pen-to-square" style="color: white;"></i></a>

                                            <a class="btn btn-secondary" href="{{ url("upload-program-files-index/$row->programID") }}"><i
                                                    class="fa-solid fa-file-import"></i></a>

                                            <a class="btn btn-warning"
                                                href="{{ URL::to('/add-program-personnel-index/'.$row->programID)}}">
                                                <i class="fa-solid fa-user-plus"></i>
                                            </a>
                                            <a href="{{ URL::to('/delete-program/'.$row->id)}}" class="btn btn-danger"
                                                id="delete"><i class="fa-solid fa-trash"></i></a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        {{-- <th>Trust Fund</th> --}}
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        {{-- <th>Extension Date</th> --}}
                                        <th>Funding Agency</th>
                                        <th>Project Title</th>
                                        <th>Description</th>
                                        {{-- <th>Approved Budget</th>
                                        <th>Amount of Release</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            The footer of the card
                        </div>
                        <!-- /.card-footer -->
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