@extends('backend.layouts.app')
@section('content')
<style>
    .radio-input input {
        display: none;
    }

    .radio-input {
        --container_width: 200px;
        position: relative;
        display: flex;
        height: 2.76rem;
        align-items: center;
        border-radius: 10px;
        background-color: #fff;
        color: #000000;
        width: var(--container_width);
        overflow: hidden;
        border: 1px solid rgba(53, 52, 52, 0.226);
    }


    .radio-input label.upl {
        width: 100%;
        padding: 10px;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1;
        font-weight: 600;
        letter-spacing: 1.5px;
        font-size: 14px;
    }

    label.upl {
        margin: 0 auto;
    }

    span.sel {
        display: none;
        position: absolute;
        height: 100%;
        width: calc(var(--container_width) / 2);
        z-index: 0;
        left: 0;
        top: 0;
        transition: .15s ease;
    }

    input#file-upload1,
    input#file-upload2,
    input#file-upload3,
    input#file-upload4 {
        height: auto !important;
    }

    .radio-input label.upl:has(input:checked) {
        color: #fff;
        /* color: #28a745; */
    }

    .radio-input label.upl:has(input:checked)~.sel {
        /* background-color: rgb(11 117 223); */
        background-color: #17a2b8;
        display: inline-block;
    }

    .radio-input label.upl:nth-child(1):has(input:checked)~.sel {
        transform: translateX(calc(var(--container_width) * 0/2));
    }

    .radio-input label.upl:nth-child(2):has(input:checked)~.sel {
        transform: translateX(calc(var(--container_width) * 1/2));
    }
</style>
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
                            Add Program
                        </h5>
                    </div>
                    {{-- card body start --}}

                    <div class="progress">
                        <div class="progress-bar bg-info progress-bar-striped" role="progressbar" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <div class="card-body">

                        <form role="form" id="regiration_form" action="{{ url('add-programs') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                <h2>Program Details</h2>
                                <input type="text" hidden readonly class="form-control" name="programID"
                                    placeholder="Program ID" value="<?php echo substr(md5(microtime()), 0, 10); ?>"
                                    autocomplete="false">

                                <div class="form-group row">
                                    <label for="status" class="col-sm-2 col-form-label">Program Status</label>
                                    <div class="col-sm-4">
                                        <select name="status" class="form-control" id="">
                                            <option value="Finished">Finished</option>
                                            <option value="Ongoing" selected>Ongoing</option>
                                            <option value="Canceled">Canceled</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="program_title" required
                                        class="col-sm-2 col-form-label text-md-end">Program
                                        Title</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" required name="program_title"
                                            style="font-weight: bold;" placeholder="Program Title" autocomplete="false"
                                            id="" cols="200" rows="3"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="description"
                                        class="col-sm-2 col-form-label text-md-end">Description</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" required name="description"
                                            style="font-weight: bold;" placeholder="Program Description"
                                            autocomplete="false" id="" cols="200" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="agencyID" class="col-sm-2 col-form-label">Funding Agency</label>
                                    <div class="col-sm-8">
                                        <select class="form-control agency" name="agencyID" id="" required>
                                            <option></option>
                                            @foreach($agency as $key)
                                            <option value="{{$key->abbrev}}">{{$key->agency_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <hr class="border border-info border-3 opacity-75">


                                <h2>Program Start and End Date</h2>
                                <div class="form-group row">
                                    <label for="start_date" class="col-sm-2 col-form-label">Program Start
                                        Date</label>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control" name="start_date"
                                            placeholder="Start Date" required autocomplete="false">
                                    </div>

                                    <label for="end_date" class="col-form-label">to</label>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control" name="end_date" placeholder="End Date"
                                            required autocomplete="false">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    @if(auth()->user()->role == 'Admin')

                                    <label for="extend_date" class="col-sm-2 col-form-label">Extension Date</label>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control" name="extend_date"
                                            placeholder="Extension Date" autocomplete="false">
                                    </div>
                                    @endif
                                </div>


                                <a href="{{ url('index') }}" class="btn btn-default">Back</a>
                                <input type="button" name="next" class="next btn btn-info" value="Next" />
                            </fieldset>


                            {{-- <fieldset>
                                <input type="button" name="previous" class="previous btn btn-default"
                                    value="Previous" />
                                <input type="button" name="next" class="next btn btn-info" value="Next" />

                            </fieldset> --}}

                            <fieldset>
                                <h2>Important Program Documents</h2>
                                {{-- File 1 --}}
                                <div class="form-group row">
                                    <label for="fileupload1" class="col-sm-3">Memorandum of Agreement</label>
                                    <div class="col-sm-6">
                                        <input type="file" class="form-control" name="fileupload1" required="required"
                                            id="file-upload1" disabled>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="radio-input">
                                            <label class="upl">
                                                <input type="radio" id="value-1" name="moa" value="1">
                                                <span>Available</span>
                                            </label>
                                            <label class="upl">
                                                <input type="radio" id="value-2" checked name="moa" value="0">
                                                <span>Not Available</span>
                                            </label>
                                            <span class="sel"></span>
                                        </div>
                                    </div>
                                </div>

                                {{-- File 2 --}}
                                <div class="form-group row">
                                    <label for="fileupload2" class="col-sm-3">Line Item Budget</label>
                                    <div class="col-sm-6">
                                        <input type="file" class="form-control" name="fileupload2" required="required"
                                            id="file-upload2" disabled>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="radio-input">
                                            <label class="upl">
                                                <input type="radio" id="value-3" name="lib" value="1">
                                                <span>Available</span>
                                            </label>
                                            <label class="upl">
                                                <input type="radio" id="value-4" checked name="lib" value="0">
                                                <span>Not Available</span>
                                            </label>
                                            <span class="sel"></span>
                                        </div>
                                    </div>
                                </div>

                                {{-- File 3 --}}
                                <div class="form-group row">
                                    <label for="fileupload3" class="col-sm-3">Notice to Proceed</label>
                                    <div class="col-sm-6">
                                        <input type="file" class="form-control" name="fileupload3" required="required"
                                            id="file-upload3" disabled>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="radio-input">
                                            <label class="upl">
                                                <input type="radio" id="value-5" name="ntp" value="1">
                                                <span>Available</span>
                                            </label>
                                            <label class="upl">
                                                <input type="radio" id="value-6" checked name="ntp" value="0">
                                                <span>Not Available</span>
                                            </label>
                                            <span class="sel"></span>
                                        </div>
                                    </div>
                                </div>

                                {{-- File 4 --}}
                                <div class="form-group row">
                                    <label for="fileupload4" class="col-sm-3">Terminal Report</label>
                                    <div class="col-sm-6">
                                        <input type="file" class="form-control" name="fileupload4" required="required"
                                            id="file-upload4" disabled>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="radio-input">
                                            <label class="upl">
                                                <input type="radio" id="value-7" name="tr" value="1">
                                                <span>Available</span>
                                            </label>
                                            <label class="upl">
                                                <input type="radio" id="value-8" checked name="tr" value="0">
                                                <span>Not Available</span>
                                            </label>
                                            <span class="sel"></span>
                                        </div>
                                    </div>
                                </div>

                                <input type="button" name="previous" class="previous btn btn-default"
                                    value="Previous" />
                                <input type="submit" name="submit" class="submit btn btn-success" value="Submit" />
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

<script>
    document.getElementById('value-1').onchange = function() {
        document.getElementById('file-upload1').disabled = !this.checked;
    };
    document.getElementById('value-2').onchange = function() {
        document.getElementById('file-upload1').disabled = this.checked;
    };
    
    document.getElementById('value-3').onchange = function() {
        document.getElementById('file-upload2').disabled = !this.checked;
    };
    document.getElementById('value-4').onchange = function() {
        document.getElementById('file-upload2').disabled = this.checked;
    };
    document.getElementById('value-5').onchange = function() {
        document.getElementById('file-upload3').disabled = !this.checked;
    };
    document.getElementById('value-6').onchange = function() {
        document.getElementById('file-upload3').disabled = this.checked;
    };
    document.getElementById('value-7').onchange = function() {
        document.getElementById('file-upload4').disabled = !this.checked;
    };
    document.getElementById('value-8').onchange = function() {
        document.getElementById('file-upload4').disabled = this.checked;
    };
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
{{-- <script type="text/javascript">
    var i = 0;
    $("#add-btn").click(function(){
    ++i;
    $("#dynamicAddRemove").append(`<tr><td><input type="text" name="moreFields['+i+'][title]" placeholder="Enter title" class="form-control" />
        <input type="text" name="moreFields['+i+'][name]" placeholder="Enter title" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>`);
    });
    $(document).on('click', '.remove-tr', function(){  
    $(this).parents('tr').remove();
    });  
</script> --}}

<script type="text/javascript">
    var i = 0;
    $("#add-btn").click(function(){
    ++i;
    $("#dynamicAddRemove").append(`
    <tr>
        <td>
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
                        <option value="Project Staff" selected>Program Staff</option>
                        <option value="Project Leader">Program Leader</option>
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

    
    
</script>

<script>
    function formatNumber(e){
    var rex = /(^\d{2})|(\d{1,3})(?=\d{1,3}|$)/g,
      val = this.value.replace(/^0+|\.|,/g,""),
      res;
      
    if (val.length) {
        res = Array.prototype.reduce.call(val, (p,c) => c + p)            // reverse the pure numbers string
                .match(rex)                                            // get groups in array
                .reduce((p,c,i) => i - 1 ? p + "," + c : p + "." + c); // insert (.) and (,) accordingly
        res += /\.|,/.test(res) ? "" : ".0";                              // test if res has (.) or (,) in it
        this.value = Array.prototype.reduce.call(res, (p,c) => c + p);    // reverse the string and display
        }
    }

    var ni = document.getElementById("numin");
    var ni2 = document.getElementById("numin2");

    ni.addEventListener("keyup", formatNumber);
    ni2.addEventListener("keyup", formatNumber);
</script>

<script>
    $('input.number-to-text').keydown(function(event) {
        if ([38, 40].indexOf(event.keyCode) > -1) {
            event.preventDefault();
    }
});
</script>

{{-- Upload Files --}}


@endsection