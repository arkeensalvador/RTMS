@extends('backend.layouts.app')
@section('content')
    <style>
        input.number-to-text::-webkit-outer-spin-button,
        input.number-to-text::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number].number-to-text {
            -moz-appearance: textfield;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="strategic row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Sub-Project Details</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Sub-Project Budget</span>
                                                    <span class="info-box-number text-center text-muted mb-0">
                                                        @empty($sub_projects->sub_project_amount_released)
                                                            -
                                                        @else
                                                            {{ $sub_projects->sub_project_amount_released }}
                                                        @endempty
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Sub-Project Approved
                                                        Budget</span>
                                                    <span class="info-box-number text-center text-muted mb-0">
                                                        @empty($sub_projects->sub_project_approved_budget)
                                                            -
                                                        @else
                                                            {{ $sub_projects->sub_project_approved_budget }}
                                                        @endempty
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Sub-Project Duration
                                                    </span>
                                                    <span class="info-box-number text-center text-muted mb-0">

                                                        @empty($sub_projects->sub_project_extend_date)
                                                            -
                                                        @else
                                                            {{ date('F, Y', strtotime($sub_projects->sub_project_start_date)) }}
                                                            -
                                                            <label for=""
                                                                style="color: red">{{ date('F, Y', strtotime($sub_projects->sub_project_extend_date)) }}</label>
                                                        @endempty

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h3 class="text-primary">{{ $sub_projects->sub_project_title }}</h3>
                                            <p class="text-muted">{{ $sub_projects->sub_project_description }}</p>

                                            <br>
                                            <div class="text-muted">
                                                <p class="text-m">Funding Agency
                                                    <b class="d-block">{{ $agency->agency_name }}</b>
                                                </p>
                                                <p class="text-m">Leader
                                                    <b class="d-block">
                                                        {{ $sub_projects->sub_project_leader }}
                                                    </b>
                                                </p>
                                                <p class="text-m">Assistant Leader
                                                    <b class="d-block">
                                                        {{ $sub_projects->sub_project_assistant_leader }}
                                                    </b>
                                                </p>
                                                <p class="text-m">Staffs
                                                    @foreach ($personnels as $personnel)
                                                        <b class="d-block">{{ $personnel->staff_name }}</b>
                                                    @endforeach
                                                </p>
                                            </div>
                                            <hr>
                                            <div class="text-m text-muted">Files</div>
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
                                            {{-- <div class="text-m text-muted">Project(s) under this program</div>
                                            <ul class="list-unstyled">
                                                @foreach ($projects as $key => $items)
                                                    <li>
                                                        <a href="{{ url('view-project-index/' . $items->id) }}"
                                                            class="btn-link text-secondary"><i class="fa-solid fa-book mr-2"></i>{{ $items->project_title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul> --}}

                                            <div class="text-center mt-5 mb-3">
                                                <a href="{{ url('sub-projects-view/'.$sub_projects->projectID) }}"
                                                    class="btn btn previous btn btn-default">Back</a>
                                                <a href="{{ url("add-sub-project-personnel/$sub_projects->projectID/$sub_projects->id") }}"
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
