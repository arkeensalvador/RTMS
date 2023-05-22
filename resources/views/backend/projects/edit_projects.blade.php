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
                            Edit Project
                        </h5>
                    </div>
                    {{-- card body start --}}
                    <div class="card-body">
                        <form role="form" action="{{URL::to('/update-projects/'.$edit->id)}}" method="POST">
                            @csrf

                            <div class="form-group row">
                                <label for="projectname" class="col-sm-2 col-form-label">Project Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="projectname"
                                        placeholder="Enter Project Name" autocomplete="false"
                                        value="{{ $edit->projectname }}"> 
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" id="" class="form-control" required>
                                        <option value="" disabled selected>Select Project Status</option>
                                        <option value="New" {{ 'New'== $edit->status ? 'selected': ''
                                            }}>New</option>
                                        <option value="Ongoing" {{ 'Ongoing'== $edit->status ? 'selected': ''
                                            }}>Ongoing</option>
                                        <option value="Terminated" {{ 'Terminated'== $edit->status ? 'selected': ''
                                            }}>Terminated</option>
                                        <option value="Completed" {{ 'Completed'==$edit->status ? 'selected': ''
                                            }}>Completed</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="{{ url('view-projects/'.$edit->instid) }}" class="btn btn-default">Back</a>
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