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
                            <h3 class="card-title">Projects</h3>
                            <div class="card-tools">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <a href="{{ url('all-institution') }}" class="btn btn-default">Back</a>
                                <!-- Here is a label for example -->
                                <span class="badge badge-primary">Label</span>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="container px-4 text-center">
                                <div class="row gx-5">
                                    @foreach($all as $key => $row)
                                    <div class="col">
                                        <div class="p-5">
                                            <a href="{{ URL::to('/view-project/'.$row->funding_agency)}}"
                                                class="btn btn-sm btn-info">{{$row->funding_agency}}</a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

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