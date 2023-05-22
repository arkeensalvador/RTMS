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

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Program Details</h3>

            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Program Budget</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                            @empty($program_details->budget)
                                            -
                                            @else
                                            {{ $program_details->budget }}
                                            @endempty
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Approved Budget</span>
                                        <span class="info-box-number text-center text-muted mb-0">
                                            @empty($program_details->amount_release)
                                            -
                                            @else
                                            {{ $program_details->amount_release }}
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

                                            @empty($program_details->extend_date)
                                            {{ date('M/d/Y',
                                            strtotime($program_details->start_date)) }} - {{ date('M/d/Y',
                                            strtotime($program_details->end_date)) }}
                                            @else
                                            {{ date('M/d/Y',
                                            strtotime($program_details->start_date)) }} - {{ date('M/d/Y',
                                            strtotime($program_details->extend_date)) }}
                                            @endempty

                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4>Recent Activity</h4>
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                            alt="user image">
                                        <span class="username">
                                            <a href="#">Jonathan Burke Jr.</a>
                                        </span>
                                        <span class="description">Shared publicly - 7:45 PM today</span>
                                    </div>

                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore.
                                    </p>
                                    <p>
                                        <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo
                                            File 1 v2</a>
                                    </p>
                                </div>
                                <div class="post clearfix">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg"
                                            alt="User Image">
                                        <span class="username">
                                            <a href="#">Sarah Ross</a>
                                        </span>
                                        <span class="description">Sent you a message - 3 days ago</span>
                                    </div>

                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore.
                                    </p>
                                    <p>
                                        <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo
                                            File 2</a>
                                    </p>
                                </div>
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                            alt="user image">
                                        <span class="username">
                                            <a href="#">Jonathan Burke Jr.</a>
                                        </span>
                                        <span class="description">Shared publicly - 5 days ago</span>
                                    </div>

                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore.
                                    </p>
                                    <p>
                                        <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo
                                            File 1 v1</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <h3 class="text-primary">{{ $program->program_title }}</h3>
                        <p class="text-muted">{{ $program->description }}</p>
                        <br>
                        <div class="text-muted">
                            <p class="text-sm">Funding Agency
                                <b class="d-block">{{ $agency->agency_name }}</b>
                            </p>
                            <p class="text-sm">Program Leader

                                @foreach($program_leader as $leader)
                                <b class="d-block">
                                    {{ $leader->name }}
                                </b>
                                <b class="d-block">
                                    {{ $leader->contact}}
                                </b>
                                @endforeach
                            </p>

                            <p class="text-sm">Program Staffs
                                @foreach ($personnels as $personnel)
                                <b class="d-block">{{ $personnel->name }}</b>
                                @endforeach
                            </p>
                        </div>
                        <h5 class="mt-5 text-muted">Project files</h5>
                        <ul class="list-unstyled">
                            @foreach ($documents as $key=>$items )
                            <li>
                                <a href="{{ url('download/'.$items->id)}}" class="btn-link text-secondary"><i
                                        class="far fa-fw fa-file-pdf"></i>{{
                                    $items->file_name }}</a>

                            </li>
                            @endforeach
                            <li>

                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i>
                                    Functional-requirements.docx</a>
                            </li>
                            <li>
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-pdf"></i>
                                    UAT.pdf</a>
                            </li>
                            <li>
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-envelope"></i>
                                    Email-from-flatbal.mln</a>
                            </li>
                            <li>
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i>
                                    Logo.png</a>
                            </li>
                            <li>
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-file-word"></i>
                                    Contract-10_12_2014.docx</a>
                            </li>
                        </ul>
                        <div class="text-center mt-5 mb-3">
                            <a href="#" class="btn btn-sm btn-primary">Add files</a>
                            <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection