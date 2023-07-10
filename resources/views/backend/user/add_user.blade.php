@extends('backend.layouts.app')
@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-lg-1">

            </div>
            <div class="col-lg-10">

                {{-- card start --}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            Add User
                        </h5>
                    </div>
                    {{-- card body start --}}
                    <div class="card-body">
                        <form role="form" action="{{URL::to('/insert-user')}}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" placeholder="Enter your name"
                                        required autocomplete="false">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Enter Email Address" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="agency" class="col-sm-2 col-form-label">Agency</label>
                                <div class="col-sm-10">
                                    <select class="form-control agency" name="agencyID" id="" required>
                                        <option></option>
                                        @foreach($all as $key)
                                            <option value="{{$key->abbrev}}">{{$key->agency_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Password" required>
                                </div>
                            </div>

                           
                                <a href="{{ url('all-user') }}" class="btn btn-default">Back</a>
                                <button type="submit" class="btn btn-success">Submit</button>
                            
                        </form>
                    </div>  {{-- card body end --}}
                </div>{{-- card end --}}
            </div>
            <div class="col-lg-1">

            </div>
        </div>
    </section>
</div>

@endsection