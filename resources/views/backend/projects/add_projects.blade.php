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
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <div class="card-body">
                        <form role="form" id="regiration_form" action="{{URL::to('/insert-projects')}}" method="POST">
                            @csrf
                            <fieldset>
                                <h2>Project Information</h2>
                                <div class="form-group row">
                                    <label for="trust_fund_code" class="col-sm-2 col-form-label">Trust Fund
                                        Code</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="trust_fund_code"
                                            placeholder="Trust Fund" autocomplete="false">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="funding_agency" class="col-sm-2 col-form-label">Funding
                                        Agency</label>
                                    <div class="col-sm-8">
                                         <select name="funding_agency" class="form-control" id="funding_agency">
                                            @foreach ($all as $agency)
                                                <option class="" value="{{$agency->abbrev}}">{{$agency->instname}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- <div class="form-group row">
                                    <label for="funding_agency_abbrev" class="col-sm-2 col-form-label">Funding
                                        Agency Abbrev.</label>
                                    <div class="col-sm-1">
                                        <input type="text" class="form-control" id="funding_agency_abbrev" name="funding_agency_abbrev"
                                            readonly value="" autocomplete="false">
                                    </div>
                                </div> --}}

                                <div class="form-group row">
                                    <label for="project_title" class="col-sm-2 col-form-label">Project Title</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="project_title"
                                            placeholder="Project Title" required autocomplete="false">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">Project
                                        Description</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" placeholder="Project Description"
                                            name="description" id="" cols="200" rows="6"></textarea>
                                    </div>
                                </div>

                                {{-- <h2>Project Leader</h2>
                                <div class="form-group row">
                                    <label for="project_leader" class="col-sm-2 col-form-label">Full Name</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="project_leader"
                                            placeholder="Project Leader" required autocomplete="false">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="contact" class="col-sm-2 col-form-label">Contact Number</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="contact" name="contact"
                                            placeholder="Contact" required autocomplete="false">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                                    <div class="col-sm-2">
                                        <input type="email" class="form-control" name="email" placeholder="Email"
                                            required autocomplete="false">
                                    </div>
                                </div>

                                <br>
                                <h2>Project Staff</h2>
                                <div class="form-group row">
                                    <label for="project_staff" class="col-sm-2 col-form-label">Project
                                        Staffs</label>
                                    <div class="col-sm-4">
                                        <textarea class="form-control" placeholder="Project Staffs" name="project_staff"
                                            id="" cols="50" rows="5"></textarea>
                                    </div>
                                </div> --}}
                                <input type="button" name="next" class="next btn btn-info" value="Next" />
                            </fieldset>


                            {{-- <div id="repeater">
                                <!-- Repeater Heading -->
                                <div class="repeater-heading">
                                    <h2 class="pull-left">Project Staff</h2>
                                    <button class="btn btn-primary pt-1 pull-right repeater-add-btn">
                                        Add
                                    </button>
                                </div>
                                <div class="clearfix"></div>
                                <!-- Repeater Items -->
                                <div class="items" data-group="test">
                                    <!-- Repeater Content -->
                                    <div class="item-content">
                                        <div class="form-group row ">
                                            <label for="project_staff" class="col-sm-2 col-form-label">Project
                                                Staff</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" placeholder="Project Staff"
                                                    name="project_staff">
                                            </div>
                                            <div class="pull-right repeater-remove-btn">
                                                <button class="btn btn-danger remove-btn">
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Repeater Remove Btn -->

                                    <div class="clearfix"></div>
                                </div>
                            </div> --}}

                            <fieldset>
                                <h2>Budget and Receipts</h2>
                                <div class="form-group row">
                                    <label for="approved_budget" class="col-sm-2 col-form-label">Approved
                                        Budget</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" name="approved_budget"
                                            placeholder="Budget" autocomplete="false">
                                    </div>

                                    <label for="amount_of_release" class="col-sm-2 col-form-label">Amount of
                                        Release</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" name="amount_of_release"
                                            placeholder="Amount of Release" autocomplete="false">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="check_num" class="col-sm-2 col-form-label">Check Number</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" name="check_num"
                                            placeholder="Check Number" autocomplete="false">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="or_num" class="col-sm-2 col-form-label">O.R. Number</label>
                                    <div class="col-sm-2">
                                        <input type="number" class="form-control" name="or_num"
                                            placeholder="O.R. Number" autocomplete="false">
                                    </div>

                                    <label for="or_date" class="col-sm-2 col-form-label">O.R. Date</label>
                                    <div class="col-sm-2">
                                        <input type="date" class="form-control" name="or_date" placeholder="O.R. Date"
                                            autocomplete="false">
                                    </div>
                                </div>

                                <input type="button" name="previous" class="previous btn btn-default"
                                    value="Previous" />
                                <input type="button" name="next" class="next btn btn-info" value="Next" />
                            </fieldset>
                            <fieldset>
                                <h2>Project Start and End Date</h2>
                                <div class="form-group row">
                                    <label for="project_start_date" class="col-sm-2 col-form-label">Project Start
                                        Date</label>
                                    <div class="col-sm-2">
                                        <input type="date" class="form-control" name="project_start_date"
                                            placeholder="Start Date" required autocomplete="false">
                                    </div>

                                    <label for="project_end_date" class="col-form-label">--</label>
                                    <div class="col-sm-2">
                                        <input type="date" class="form-control" name="project_end_date"
                                            placeholder="End Date" required autocomplete="false">
                                    </div>
                                </div>

                                @if(auth()->user()->role == 'Admin')
                                <div class="form-group row">
                                    <label for="project_extension_date" class="col-sm-2 col-form-label">Project
                                        Extension Date</label>
                                    <div class="col-sm-2">
                                        <input type="date" class="form-control" name="project_extension_date"
                                            placeholder="Extension Date" autocomplete="false">
                                    </div>
                                </div>
                                @endif
                                <input type="button" name="previous" class="previous btn btn-default"
                                    value="Previous" />
                                <input type="submit" name="submit" class="submit btn btn-success" value="Submit" />
                            </fieldset>

                            {{-- <div class="form-group row">
                                <label for="projectname" class="col-sm-2 col-form-label">Project Name</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="projectname"
                                        placeholder="Enter Project Name" required autocomplete="false">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" data-inputmask-inputformat="mm/dd/yyyy"
                                        name="start_date" id="start_date">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="end_date" id="end_date">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="institution" class="col-sm-2 col-form-label">Institution</label>
                                <div class="col-sm-5">
                                    <select class="form-control" id="institution" name="institution" required>
                                        <option value="" disabled selected>Select Agency</option>
                                        @foreach($all as $row)
                                        <option value="{{$row->idnumber}}">{{$row->instname}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="instid" class="col-sm-2 col-form-label">Institution ID</label>
                                <div class="col-sm-2">
                                    <input type="text" id="field" class="form-control" name="instid" readonly>
                                </div>
                            </div> --}}


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
    document.getElementById('funding_agency').onchange = function () {
        document.getElementById('funding_agency_abbrev').value = event.target.value  
}
</script>
@endsection