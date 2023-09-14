@extends('backend.layouts.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="strategic row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Project Details</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Project Budget</span>
                                                <span class="info-box-number text-center text-muted mb-0">
                                                    @empty($projects->project_amount_released)
                                                        -
                                                    @else
                                                        {{ $projects->project_amount_released }}
                                                    @endempty
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Approved
                                                    Budget</span>
                                                <span class="info-box-number text-center text-muted mb-0">
                                                    @empty($projects->project_approved_budget)
                                                        -
                                                    @else
                                                        {{ $projects->project_approved_budget }}
                                                    @endempty
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Project Duration
                                                </span>
                                                <span class="info-box-number text-center text-muted mb-0">

                                                    @empty($projects->project_extend_date)
                                                        -
                                                    @else
                                                        {{ date('F, Y', strtotime($projects->project_start_date)) }}
                                                        -
                                                        <label for=""
                                                            style="color: red">{{ date('F, Y', strtotime($projects->project_extend_date)) }}</label>
                                                    @endempty

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="text-primary">{{ $projects->project_title }}</h3>
                                        <p class="text-muted">{{ $projects->project_description }}</p>

                                        <br>
                                        <div class="text-muted">
                                            <p class="text-m">Project Funding Agency
                                                <b class="d-block">{{ $agency->agency_name }}</b>
                                            </p>
                                            <p class="text-m">Project Leader
                                                <b class="d-block">
                                                    {{ $projects->project_leader }}
                                                </b>
                                            </p>
                                            <p class="text-m">Project Assistant Leader
                                                <b class="d-block">
                                                    {{ $projects->project_assistant_leader }}
                                                </b>
                                            </p>
                                            <p class="text-m">Project Staffs
                                                @foreach ($personnels as $personnel)
                                                    <b class="d-block">{{ $personnel->staff_name }}</b>
                                                @endforeach
                                            </p>
                                        </div>
                                        <hr>
                                        <div class="text-m text-muted">Project files</div>
                                        <ul class="list-unstyled">
                                            @foreach ($upload_files as $key => $items)
                                                <li>
                                                    <a href="{{ url('download/' . $items->id) }}"
                                                        class="btn-link text-secondary"><i
                                                            class="far fa-fw fa-file-pdf"></i>{{ $items->file_name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <hr>
                                        <div class="text-m text-muted">Sub - project(s) under this Project</div>
                                        <ul class="list-unstyled">
                                            @foreach ($sub_projects as $key => $items)
                                                <li>
                                                    <a href="{{ url('view-sub-project-index/' . $items->id) }}"
                                                        class="btn-link text-secondary"><i class="fa-solid fa-book mr-2"></i>{{ $items->sub_project_title }}</a>
                                                </li>
                                            @endforeach
                                        </ul>

                                        <div class="text-center mt-5 mb-3">
                                            <a href="{{ url('rdmc-projects') }}"
                                                class="btn btn previous btn btn-default">Back</a>
                                            <a href="{{ url("project-upload-file/$projects->id") }}"
                                                class="btn btn btn-primary">Add files</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection