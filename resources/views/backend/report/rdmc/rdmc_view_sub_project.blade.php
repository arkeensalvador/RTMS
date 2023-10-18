@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="strategic row">
                <div class="col-md-12">
                    <div class="container">
                        <div class="row pt-2 ">
                            <div class="col-md-4 ">
                                <div class="card-counter bg-primary text-white">
                                    <i class="fa fa-area-chart"></i>
                                    <span class="count-numbers h2"><span class="font-weight-bold">₱</span>
                                        @empty($sub_projects->sub_project_approved_budget)
                                            -
                                        @else
                                            {{ $sub_projects->sub_project_approved_budget }}
                                        @endempty
                                    </span>
                                    <span class="card-title font-italic ">Budget</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card-counter bg-info text-white">
                                    <i class="fa fa-bar-chart"></i>
                                    <span class="count-numbers h2"><span class="font-weight-bold">₱</span>
                                        @empty($sub_projects->sub_project_approved_budget)
                                            -
                                        @else
                                            {{ $sub_projects->sub_project_approved_budget }}
                                        @endempty
                                    </span>
                                    <span class="card-title font-italic">Approved Budget</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card-counter bg-success text-white">
                                    <i class="fa fa-calendar-o"></i>
                                    <span class="count-duration h5">
                                        @empty($sub_projects->sub_project_extend_date)
                                            {{ date('F, Y', strtotime($sub_projects->sub_project_start_date)) }}
                                            -
                                            {{ date('F, Y', strtotime($sub_projects->sub_project_end_date)) }}
                                        @else
                                            {{ date('F, Y', strtotime($sub_projects->sub_project_start_date)) }}
                                            -
                                            {{ date('F, Y', strtotime($sub_projects->sub_project_extend_date)) }}
                                        @endempty
                                    </span>
                                    <span class="card-title font-italic">Duration</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row pt-5">
                            <h2 class="font-weight-bold text-center">{{ $sub_projects->sub_project_title }}</h2>
                            <div class="h_line"></div>
                            <p class="font-italic text-center my-3 px-5">
                                {{ $sub_projects->sub_project_description }}
                            </p>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row pt-5">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="thwidth">Funding Agency</th>
                                        <td>{{ $agency->agency_name }} ({{ $sub_projects->sub_project_agency }})</td>
                                    </tr>
                                    @php
                                        $imp = json_decode($sub_projects->sub_project_implementing_agency);
                                    @endphp
                                    <tr>
                                        <th scope="row" class="thwidth">Implementing Agency</th>
                                        <td>{{ implode(' / ', $imp) }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="thwidth">Sub-Project Leader</th>
                                        <td>{{ $sub_projects->sub_project_leader }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="thwidth">Sub-Project Assistant Leader</th>
                                        <td>{{ $sub_projects->sub_project_assistant_leader }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="thwidth">Sub-Project Staff(s)</th>
                                        <td>
                                            <ul class="list-group list-group-flush">
                                                @foreach ($personnels as $personnel)
                                                    <li class="list-group-item">
                                                        {{ $personnel->staff_name }}
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="thwidth">Sub-Project Files</th>

                                        <td>
                                            <ul class="list-group list-group-flush">
                                                @foreach ($upload_files as $key => $items)
                                                    <li class="list-group-item">
                                                        <a href="{{ url('delete-file/' . $items->id) }}"
                                                            class="btn btn-danger float-right">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                        &nbsp;
                                                        <a href="{{ url('download/' . $items->id) }}"
                                                            class="btn btn-info float-right">
                                                            <i class="fa-solid fa-download"></i>
                                                        </a>
                                                        {{ $items->file_name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="text-center mt-5 mb-3">
                                <a href="{{ url('sub-projects-view/' . $sub_projects->projectID) }}"
                                    class="btn btn previous btn btn-default">Go back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
