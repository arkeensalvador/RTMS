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
                            <h3 class="card-title">List of Projects</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Trust Fund</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Extension Date</th>
                                        <th>Funding Agency</th>
                                        <th>Project Title</th>
                                        <th>Approved Budget</th>
                                        <th>Amount of Release</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($view as $key => $row)
                                        <tr>
                                            <td>{{ $row->trust_fund_code }}</td>
                                            <td>{{ $row->project_start_date }}</td>
                                            <td>{{ $row->project_end_date }}</td>
                                            <td>{{ $row->project_extension_date }}</td>
                                            <td>{{ $row->funding_agency }}</td>
                                            <td>{{ $row->project_title }}</td>
                                            <td>{{ $row->approved_budget }}</td>
                                            <td>{{ $row->amount_of_release }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Trust Fund</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Extension Date</th>
                                        <th>Funding Agency</th>
                                        <th>Project Title</th>
                                        <th>Approved Budget</th>
                                        <th>Amount of Release</th>
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