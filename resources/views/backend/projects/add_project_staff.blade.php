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
                            Add Project Personnel
                        </h5>
                    </div>
                    {{-- card body start --}}
                    <div class="card-body">
                        <form role="form" id="" action="{{URL::to('/insert-projects-personnel')}}" method="POST">
                            @csrf
                            <h2>Project Leader</h2>
                            <input type="text"  class="form-control" name="project_id" placeholder="" required
                                autocomplete="false" value="">

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="name" placeholder="Name" required
                                        autocomplete="false">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                                <div class="col-sm-8" style="padding-top: 5px;">
                                    <input type="radio" name="gender" value="Male" /> Male
                                    <input type="radio" name="gender" value="Female" /> Female
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="contact" class="col-sm-2 col-form-label">Contact Number</label>
                                <div class="col-sm-8">
                                    <input type="text" id="contact" class="form-control" name="contact" placeholder=""
                                        required autocomplete="false">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" name="email" placeholder="Email" required
                                        autocomplete="false">
                                </div>
                            </div>

                            <h2>Project Staffs</h2>
                            <div class="form-group row">
                                <label for="project_staffs" class="col-sm-2 col-form-label">Project Staffs</label>
                                <div class="col-sm-8">
                                    <textarea name="project_staffs" id="" cols="70" rows="5"></textarea>
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
<script>
    document.getElementById('funding_agency').onchange = function () {
        document.getElementById('funding_agency_abbrev').value = event.target.value  
}
</script>
@endsection