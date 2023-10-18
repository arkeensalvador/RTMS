@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="strategic">
                <div class="col-md-12">
                    <div class="container rounded bg-white mt-5 mb-5">
                        <div class="row">
                            <div class="col-md-4 border-right">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img
                                        class="rounded-circle mt-5" width="250"
                                        src="{{ asset('storage/' . $researcher->image) }}">
                                    <span class="font-weight-bold h4">{{ $researcher->name }}</span>
                                </div>
                            </div>
                            <div class="col-md-8 border-right">
                                <div class="p-3 py-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="text-right">User Profile</h4>
                                    </div>
                                    <div class="row mt-3">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Gender</th>
                                                    <td>{{ $researcher->gender }}</td>
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
                                                        ({{ $researcher->agency }})</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Research Involvement</th>
                                                    <td>
                                                        <ul>
                                                            <li>12</li>
                                                            <li>23</li>
                                                            <li>23</li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center mt-3 mb-3">
                                <a href="{{ url('researcher-index') }}" class="btn btn previous btn btn-default">Go back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </div>
    </section>
    </div>
@endsection
