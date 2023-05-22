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
                            Add Project
                        </h5>
                    </div>
                    {{-- card body start --}}
                    <div class="card-body">
                        <form role="form" action="{{URL::to('/insert-projects')}}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <label for="projectname" class="col-sm-2 col-form-label">Project Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="projectname"
                                        placeholder="Enter Project Name" required autocomplete="false">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control" name="start_date"
                                        placeholder="Enter Project Start Date" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control" name="end_date"
                                        placeholder="Enter Project End Date" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="institution" class="col-sm-2 col-form-label">Institution</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="institution" onchange="showCustomer(this.value)"
                                        required>
                                        <select name="customers" onchange="showCustomer(this.value)">
                                            <option value="">Select a customer:</option>
                                            <option value="ALFKI">Alfreds Futterkiste</option>
                                            <option value="NORTS ">North/South</option>
                                            <option value="WOLZA">Wolski Zajazd</option>
                                        {{-- @foreach($all as $row)
                                        <option value="{{$row->instname}}">{{$row->instname}}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
                                <div class="col-sm-2">
                                    <div id="txtHint">Customer info will be listed here...</div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="{{ url('all-user') }}" class="btn btn-default">Back</a>
                                <button type="submit" class="btn btn-info">Submit</button>
                            </div>
                        </form>
                    </div> {{-- card body end --}}
                </div>{{-- card end --}}
            </div>
            <div class="col-lg-1">

            </div>
        </div>
    </section>
</div>

@endsection