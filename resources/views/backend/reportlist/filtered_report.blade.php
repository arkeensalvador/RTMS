@extends('backend.layouts.app')
@section('content')
    <style>
        thead {
            color: #fff;
            font-weight: 200;
            font-size: 16px;
        }
    </style>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{-- <h1 class="m-0">{{ auth()->user()->role }} - Manage Accounts</h1> --}}
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Home</a></li>
                            <li class="breadcrumb-item active">Filtered Reports</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{ route('records.filter') }}" method="POST">
                                    @csrf
                                    <select name="duration" id="yearSelect">
                                        <option value="">Select Year</option>
                                        @for ($year = 2018; $year <= 2050; $year++)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                    <button type="submit">Filter</button>
                                </form>
                                <div class="category my-5">
                                    <div class="notices mb-1 " style="border-left: 6px solid #0DA603;">
                                        <h5>Summary of the <span class="font-weight-bold" style=" color: #0DA603;">AIHR's
                                                conducted by
                                                the CMI's</span></h5>
                                    </div>

                                    <table class="table-bordered table table-hover">
                                        <thead style="background-color: #0DA603;">
                                            <tr>
                                                <td rowspan="2">Agency</td>
                                                <td colspan="5">Number of Project Presented</td>
                                            </tr>
                                            <tr>
                                                <td style="">New</td>
                                                <td>Ongoing</td>
                                                <td>Terminated</td>
                                                <td>Completed</td>
                                                <td>Total Projects Reviewed</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($fundedCounts as $abbrev => $counts)
                                                @if (
                                                    $counts['new'] > 0 ||
                                                        $counts['ongoing'] > 0 ||
                                                        $counts['terminated'] > 0 ||
                                                        $counts['completed'] > 0 ||
                                                        $counts['totalCount'] > 0)
                                                    <tr>
                                                        <td>{{ $abbrev }}</td>
                                                        <td>{{ $counts['new'] }}</td>
                                                        <td>{{ $counts['ongoing'] }}</td>
                                                        <td>{{ $counts['terminated'] }}</td>
                                                        <td>{{ $counts['completed'] }}</td>
                                                        <td>{{ $counts['totalCount'] }}</td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->

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
