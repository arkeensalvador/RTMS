@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="strategic">
                <div class="col-md-12">
                    <div class="container rounded bg-white mt-2 mb-2">
                        <div class="row">
                            <div class="col-md-12 px-3 px-3">
                                <div class="d-flex justify-content-between align-items-center pt-3">
                                    <h4 class="text-right">Reseacher Profile</h4>
                                </div>
                                <div class="row pt-3">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th scope="row" style="border-top: 0px #dee2e600">Photo</th>
                                                <td style="border-top: 0px #dee2e600"> <img id="img-thumbnail"
                                                        src="{{ asset($researcher->profile_picture) }}" alt=""
                                                        style="width: 170px; height: 170px; border-top-radius: 50px"
                                                        class="img-thumbnail" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Name</th>
                                                <td> {{ $researcher->name }} </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Sex</th>
                                                <td>{{ $researcher->sex }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row" class="w-30">Contact Number</th>
                                                <td>{{ $researcher->contact }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Email</th>
                                                <td>{{ $researcher->email }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Agency</th>
                                                <td>{{ $researcher->agency_name }}
                                                    ({{ $researcher->abbrev }})</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Research Involvement</th>
                                                <td>
                                                    <span><i>Programs</i></span>
                                                    <ol class="">
                                                        @foreach ($prog_involvement as $res)
                                                            <li>
                                                                <a
                                                                    href="{{ url('view-program-index/' . $res->programID) }}">
                                                                    {{ $res->program_title }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ol>

                                                    <span><i>Projects</i></span>
                                                    <ol>
                                                        @foreach ($proj_involvement as $proj_res)
                                                            <li>
                                                                <a href="{{ url('view-project-index/' . $proj_res->id) }}">{{ $proj_res->project_title }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ol>
                                                    <span><i>Sub-Projects/Studies</i></span>
                                                    <ol>
                                                        @foreach ($sub_proj_involvement as $res)
                                                            @if (!$res)
                                                                <li>None</li>
                                                            @else
                                                                <li>{{ $res->sub_project_title }}</li>
                                                            @endif
                                                        @endforeach
                                                    </ol>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Awards received</th>
                                                <td>
                                                    @if ($awards->isEmpty())
                                                        <span><i>Have not received any awards yet</i></span>
                                                    @endif

                                                    @foreach ($awards as $award)
                                                        <li>
                                                            {{ $award->awards_title }}
                                                            <i>({{ date('m/d/Y', strtotime($award->awards_date)) }})</i>
                                                        </li>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="text-center pt-3 mb-3">
                                <a href="{{ url('researcher-index') }}" class="btn btn previous btn btn-default">Go
                                    back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
