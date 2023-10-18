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
                                        @empty($projects->project_approved_budget)
                                            -
                                        @else
                                            {{ $projects->project_approved_budget }}
                                        @endempty
                                    </span>
                                    <span class="card-title font-italic ">Project Budget</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card-counter bg-info text-white">
                                    <i class="fa fa-bar-chart"></i>
                                    <span class="count-numbers h2"><span class="font-weight-bold">₱</span>
                                        @empty($projects->project_approved_budget)
                                            -
                                        @else
                                            {{ $projects->project_approved_budget }}
                                        @endempty
                                    </span>
                                    <span class="card-title font-italic">Approved Budget</span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card-counter bg-success text-white">
                                    <i class="fa fa-calendar-o"></i>
                                    <span class="count-duration h5">
                                        @empty($projects->project_extend_date)
                                            {{ date('F, Y', strtotime($projects->project_start_date)) }}
                                            -
                                            {{ date('F, Y', strtotime($projects->project_end_date)) }}
                                        @else
                                            {{ date('F, Y', strtotime($projects->project_start_date)) }}
                                            -
                                            {{ date('F, Y', strtotime($projects->project_extend_date)) }}
                                        @endempty
                                    </span>
                                    <span class="card-title font-italic">Program Duration</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row pt-5">
                            <h2 class="font-weight-bold text-center">{{ $projects->project_title }}</h2>
                            <div class="h_line"></div>
                            <p class="font-italic text-center my-3 px-5">
                                {{ $projects->project_description }}
                            </p>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row pt-5">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row" class="thwidth">Funding Agency</th>
                                        <td>{{ $agency->agency_name }} ({{ $agency->abbrev }})</td>
                                    </tr>
                                    @php
                                        $imp = json_decode($projects->project_implementing_agency);
                                    @endphp
                                    <tr>
                                        <th scope="row" class="thwidth">Implementing Agency</th>
                                        <td>{{ implode(' / ', $imp) }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="thwidth">Project Leader</th>
                                        <td>{{ $projects->project_leader }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="thwidth">Project Assistant Leader</th>
                                        <td>{{ $projects->project_assistant_leader }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="thwidth">Project Staff(s)</th>
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
                                        <th scope="row" class="thwidth">Project Files</th>

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
                                    <tr>
                                        <th scope="row" class="thwidth">Sub - project(s) under this project</th>
                                        <td>
                                            <ul class="list-group list-group-flush">
                                                @foreach ($sub_projects as $key => $items)
                                                    <li class="list-group-item">
                                                        <a href="{{ url('view-subprojects/' . $projects->id . '/' . $items->id) }}"
                                                            class="btn-link text-secondary"><i
                                                                class="fa-solid fa-book mr-2"></i>{{ $items->sub_project_title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="text-center mt-5 mb-3">
                                <a href="javascript:history.back()" class="btn btn previous btn btn-default">Go back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
