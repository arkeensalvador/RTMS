@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-lg-1">

                </div>
                <div class="col-lg-12">

                    {{-- card start --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Edit display name and email
                            </h5>
                        </div>
                        {{-- card body start --}}
                        <div class="card-body">
                            <form role="form" action="{{ URL::to('/update-profile/' . $edit->id) }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter your name" required autocomplete="false"
                                            value="{{ $edit->name }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Enter Email Address" required value="{{ $edit->email }}">
                                    </div>
                                </div>

                                {{-- <div class="card-footer"> --}}
                                <a href="{{ url('profile/' . auth()->user()->id) }}" class="btn btn-default">Back</a>
                                <button type="submit" class="btn btn-success">Update</button>
                                {{-- </div> --}}
                            </form>
                        </div> {{-- card body end --}}
                    </div>{{-- card end --}}
                </div>
                <div class="col-lg-1">

                </div>
            </div>
        </section>
    </div>
    <script>
        var options = $('#agencyID').html();
    </script>
@endsection
