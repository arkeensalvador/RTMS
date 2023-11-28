@extends('backend.layouts.app')
@section('content')
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
        <section class="content">
            <div class="strategic">
                <div class="col-md-12">
                    <div class="container rounded bg-white mt-1 mb-5">
                        <div class="row">
                            <div class="col-md-12 border-right">
                                <div class="p-3 py-2">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="text-right">User Profile</h4>
                                    </div>
                                    <div class="row mt-2">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Name</th>
                                                    <td> {{ $all->name }} </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Email</th>
                                                    <td>{{ $all->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Agency</th>
                                                    <td>{{ $all->agencyID }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="text-left mb-3">
                                <a href="{{ url('/edit-profile/' . $all->id) }}"
                                    class="btn btn previous btn btn-info">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
