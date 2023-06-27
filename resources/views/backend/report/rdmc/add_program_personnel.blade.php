@extends('backend.layouts.app')
@section('content')

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-lg-2">

            </div>
            <div class="col-lg-8">

                {{-- card start --}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            Add Personnels
                        </h5>
                    </div>
                    {{-- card body start --}}

                    {{-- <div class="progress">
                        <div class="progress-bar bg-info progress-bar-striped" role="progressbar" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div> --}}
                    <div class="card-body">

                        <form role="form" id="regiration_form" action="{{ url('add-program-personnel') }}"
                            method="POST">
                            @csrf
                            {{-- EMPLOYEE FORM WORKING --}}
                            <fieldset>
                                <h2>Program Staffs</h2>
                                <table class="table table-bordered" id="dynamicAddRemove">
                                    <tr>
                                        <th>Details</th>
                                        <th>Action</th>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="moreFields[0][programID]"
                                                value="{{ request()->route()->programID }}" placeholder="Program ID"
                                                hidden readonly required autocomplete="false">

                                            <label for="name" class="col-sm-2 col-form-label text-md-end">
                                                Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="moreFields[0][name]"
                                                    value="" placeholder="Name" required autocomplete="false">
                                            </div>

                                            <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                                            <div class="col-sm-4">
                                                <select name="moreFields[0][gender]" class="form-control" id=""
                                                    value="">
                                                    <option value="Male" selected>Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>

                                            <label for="contact"
                                                class="col-sm-4 col-form-label text-md-end">Contact</label>
                                            <div class="col-sm-4 mr-4">
                                                <input type="text" class="form-control" id="contact"
                                                    name="moreFields[0][contact]" value="" placeholder="Contact"
                                                    required autocomplete="false">
                                            </div>

                                            <label for="email" class="col-sm-1 col-form-label text-md-end">Email</label>
                                            <div class="col-sm-5">
                                                <input type="email" class="form-control" name="moreFields[0][email]"
                                                    value="" placeholder="Email Address" required autocomplete="false">
                                            </div>

                                            <label for="role" class="col-sm-2 col-form-label">Role</label>
                                            <div class="col-sm-4">
                                                <select name="moreFields[0][role]" class="form-control" id="" value="">
                                                    
                                                    <option value="Program Leader" selected>Program Leader</option>
                                                </select>
                                            </div>
                                        </td>

                                        <td rowspan="2">
                                            <button type="button" name="add" id="add-btn" class="btn btn-success">Add
                                                More</button>
                                        </td>
                                    </tr>
                                </table>

                                {{-- <input type="button" name="previous" class="previous btn btn-default"
                                    value="Previous" />
                                <input type="button" name="next" class="next btn btn-info" value="Next" /> --}}

                                <div class="card-footer">
                                    <a href="{{ url('rdmc-programs') }}" class="btn btn-default">Back</a>
                                    <button type="submit" name="submit" class="next btn btn-info">Submit</button>
                                   
                                </div>
                            </fieldset>


                        </form>

                    </div> {{-- card body end --}}
                </div>{{-- card end --}}
            </div>
            <div class="col-lg-1">

            </div>
        </div>

    </section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script type="text/javascript">
    var i = 0;
    $("#add-btn").click(function(){
    ++i;
    $("#dynamicAddRemove").append(`
    <tr>
        <td>
            <input type="text" class="form-control" name="moreFields[`+i+`][programID]"
                                                    value="{{ Route::input('programID') }}" placeholder="Program ID" hidden readonly required autocomplete="false">
            <label for="name" class="col-sm-2 col-form-label text-md-end">Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="moreFields[`+i+`][name]" value="" placeholder="Name" required autocomplete="false">
            </div>

            <label for="gender" class="col-sm-2 col-form-label">Gender</label>
                <div class="col-sm-4">
                    <select name="moreFields[`+i+`][gender]" class="form-control" id="">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

            <label for="contact" class="col-sm-4 col-form-label text-md-end">Contact</label>
                <div class="col-sm-4 mr-4">
                    <input type="text" class="form-control" id="contact" name="moreFields[`+i+`][contact]" value="" placeholder="Contact" required autocomplete="false">
                </div>

            <label for="email" class="col-sm-1 col-form-label text-md-end">Email</label>
                <div class="col-sm-5">
                    <input type="email" class="form-control" name="moreFields[`+i+`][email]" value="" placeholder="Email Address" required autocomplete="false">
                </div>

            <label for="role" class="col-sm-2 col-form-label">Role</label>
                <div class="col-sm-4">
                    <select name="moreFields[`+i+`][role]" class="form-control" id="">
                        <option value="Staff" selected>Staff</option>
                    </select>
                </div>
        </td>
        <td>
            <button type="button" class="btn btn-danger remove-tr">Remove</button>
        </td>
    </tr>`);
    });
        $(document).on('click', '.remove-tr', function(){  
        $(this).parents('tr').remove();
    });  

    $('input.number-to-text').keydown(function(event) {
        if ([38, 40].indexOf(event.keyCode) > -1) {
            event.preventDefault();
    }
    });
    
</script>

<script>
    // Auto Add Comma in Number Function
    function updateTextView(_obj){
  var num = getNumber(_obj.val());
  if(num==0){
    _obj.val('');
  }else{
    _obj.val(num.toLocaleString());
  }
}
function getNumber(_str){
  var arr = _str.split('');
  var out = new Array();
  for(var cnt=0;cnt<arr.length;cnt++){
    if(isNaN(arr[cnt])==false){
      out.push(arr[cnt]);
    }
  }
  return Number(out.join(''));
}
$(document).ready(function(){
  $('input#comma').on('keyup',function(){
    updateTextView($(this));
  });
});
@endsection