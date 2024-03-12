@extends('backend.layouts.app')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('css/paper-dashboard.css?v=2.0.1') }}" />

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="home">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- Main content -->
        <div class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-user">
                        <div class="image">
                            <img src="{{ asset('img/CMI_BG.webp') }}" alt="...">
                        </div>
                        <div class="card-body">
                            <div class="author">

                                <img class="avatar border-gray" src="{{ asset($all->profile_picture) }}" alt="...">
                                <h5 class="title">{{ $all->name }}</h5>

                            </div>
                        </div>
                        <div class="card-footer">
                            <hr>
                            <div class="button-container">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-6 ml-auto">
                                        <h5>{{ $all->role == 'Admin' ? $total_program : $program }}</h5>
                                        <small>Programs</small></h5>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-6 ml-auto mr-auto">
                                        <h5>{{ $all->role == 'Admin' ? $total_project : $project }}</h5>
                                        <small>Projects</small></h5>
                                    </div>
                                    <div class="col-lg-3 mr-auto">
                                        <h5>{{ $all->role == 'Admin' ? $total_researcher : $researcher }}</h5>
                                        <small>Researchers</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-8">
                    <div class="card card-user">
                        <div class="card-header">
                            <h5 class="card-title">Edit Profile</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-12 pr-2">
                                        <div class="form-group">
                                            <label>Agency</label>
                                            @php
                                                $agency = DB::table('agency')
                                                    ->where('abbrev', $all->agencyID)
                                                    ->first();
                                            @endphp
                                            <input type="text" class="form-control" disabled="" placeholder="Company"
                                                value="{{ $agency->agency_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <input type="text" class="form-control" placeholder="Company"
                                                value="{{ 'Admin' == $all->role ? 'Administrator' : 'CMI' }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" placeholder="Company"
                                                value="{{ $all->email }}" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="text-left mb-3">
                                        <a href="{{ url('/edit-profile/' . $all->id) }}"
                                            class="btn btn previous btn btn-info">Edit</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
