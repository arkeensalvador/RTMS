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
                            Edit User
                        </h5>
                    </div>
                    {{-- card body start --}}
                    <div class="card-body">
                        <form role="form" action="{{URL::to('/update-user/'.$edit->id)}}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" placeholder="Enter your name"
                                        required autocomplete="false" value="{{ $edit->name}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Enter Email Address" required value="{{ $edit->email }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="agency" class="col-sm-2 col-form-label">Agency</label>
                                <div class="col-sm-10">
                                    <select class="form-control agency" name="agencyID" id="agencyID" required>
                                        {{-- <optgroup label="Current Agency"> --}}
                                            @foreach($edit2 as $key)
                                            {{-- <option value="{{ $key->abbrev }}" > {{ $key->agency_name }} </option> --}}
                                        {{-- </optgroup> --}}

                                        <optgroup label="Select Agency">
                                            @foreach($agency as $keys)
                                            <option value="{{ $keys->abbrev}}" {{ $keys->abbrev == $key->abbrev ? 'selected' : ''}}>
                                                {{ $keys->agency_name }} </option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>

                                    </select>
                                    </select>
                                </div>
                            </div>

                            {{-- <div class="card-footer"> --}}
                                <a href="{{ url('all-user') }}" class="btn btn-default">Back</a>
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