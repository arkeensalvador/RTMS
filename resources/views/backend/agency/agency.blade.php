@extends('backend.layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of Agency</h3>
                            <div class="card-tools">
                                <a href="{{ url('add-agency-index') }}" class="btn btn-success {{ Route::current()->getName() == 'add-agency-index' ? 'active' : '' }}">Add Agency</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Agency</th>
                                        <th>Abbrev.</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($all as $key => $row)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$row->agency_name}}</td>
                                        <td>
                                            {{$row->abbrev}}
                                            {{-- <a href="{{ URL::to('/view-projects/'.$row->idnumber)}}"
                                                class="">
                                                    {{$row->instname}}
                                            </a> --}}
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('/edit-agency/'.$row->id)}}"
                                                class="btn btn-sm btn-info">Edit</a>
                                            <a href="{{ URL::to('/delete-agency/'.$row->id)}}"
                                                class="btn btn-sm btn-danger" id="delete">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Agency</th>
                                        <th>Abbrev.</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
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