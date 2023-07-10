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
                            Edit Institution
                        </h5>
                    </div>
                    {{-- card body start --}}
                    <div class="card-body">
                        <form role="form" action="{{URL::to('/update-agency/'.$edit->id)}}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="agency_name" class="col-sm-2 col-form-label">Agency Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="agency_name" placeholder="Enter agency name"
                                        required autocomplete="false" value="{{ $edit->agency_name }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="abbrev" class="col-sm-2 col-form-label">Abbreviation</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="abbrev" placeholder="Enter abbreviation"
                                        required autocomplete="false" value="{{ $edit->abbrev }}">
                                </div>
                            </div>

                            {{-- <div class="card-footer"> --}}
                                <a href="{{ url('all-agency') }}" class="btn btn-default">Back</a>
                                <button type="submit" class="btn btn-success">Update</button>
                            {{-- </div> --}}
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