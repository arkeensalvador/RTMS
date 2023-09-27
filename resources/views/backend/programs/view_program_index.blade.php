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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Program Details</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-12 order-2 order-md-1">
                                    <div class="row">
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Program Budget</span>
                                                    <span class="info-box-number text-center text-muted mb-0">
                                                        @empty($program->amount_released)
                                                            -
                                                        @else
                                                            {{ $program->amount_released }}
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
                                                        @empty($program->approved_budget)
                                                            -
                                                        @else
                                                            {{ $program->approved_budget }}
                                                        @endempty
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="info-box bg-light">
                                                <div class="info-box-content">
                                                    <span class="info-box-text text-center text-muted">Program Duration
                                                    </span>
                                                    <span class="info-box-number text-center text-muted mb-0">

                                                        @empty($program->extend_date)
                                                            -
                                                        @else
                                                            {{ date('F, Y', strtotime($program->start_date)) }}
                                                            -
                                                            <label for=""
                                                                style="color: red">{{ date('F, Y', strtotime($program->extend_date)) }}</label>
                                                        @endempty

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        {{-- <div class="col-md-12">
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">An item</li>
                                                <li class="list-group-item">A second item</li>
                                                <li class="list-group-item">A third item</li>
                                                <li class="list-group-item">A fourth item</li>
                                                <li class="list-group-item">And a fifth one</li>
                                            </ul>
                                        </div> --}}
                                        <div class="col-12">
                                            <h3 class="text-primary">{{ $program->program_title }}</h3>
                                            <p class="text-muted">{{ $program->program_description }}</p>

                                            <br>
                                            <div class="text-muted">
                                                <p class="text-m">Funding Agency
                                                    <b class="d-block">{{ $agency->agency_name }}</b>
                                                </p>
                                                <p class="text-m">Program Leader
                                                    <b class="d-block">
                                                        {{ $program->program_leader }}
                                                    </b>
                                                </p>
                                                <p class="text-m">Program Assistant Leader
                                                    <b class="d-block">
                                                        {{ $program->assistant_leader }}
                                                    </b>
                                                </p>
                                                <p class="text-m">Program Staffs
                                                    @foreach ($personnels as $personnel)
                                                        <b class="d-block">{{ $personnel->staff_name }}</b>
                                                    @endforeach
                                                </p>
                                            </div>
                                            <hr>
                                            <div class="text-m text-muted">Program files</div>
                                            <ul class="list-unstyled">
                                                @foreach ($upload_files as $key => $items)
                                                    <li>
                                                        <a href="{{ url('download/' . $items->id) }}"
                                                            class="btn-link text-secondary"><i
                                                                class="far fa-fw fa-file-pdf"></i>{{ $items->file_name }}</a>
                                                        <a href="{{ url('/'.$items->file_path) }}" target="_blank">View </a>
                                                    </li>
                                                @endforeach
                                            </ul>

                                            <hr>
                                            <div class="text-m text-muted">Project(s) under this program</div>
                                            <ul class="list-unstyled">
                                                @foreach ($projects as $key => $items)
                                                    <li>
                                                        <a href="{{ url('view-project-index/' . $items->id) }}"
                                                            class="btn-link text-secondary"><i
                                                                class="fa-solid fa-book mr-2"></i>{{ $items->project_title }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>

                                            <div class="text-center mt-5 mb-3">
                                                <a href="{{ url('rdmc-programs') }}"
                                                    class="btn btn previous btn btn-default">Back</a>
                                                <a href="{{ url("upload-file/$program->programID") }}"
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
