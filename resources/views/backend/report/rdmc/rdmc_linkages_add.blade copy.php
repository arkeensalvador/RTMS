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
        <div class="strategic row">

            <div class="col-md-5">

                {{-- card start --}}
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">
                            Add Linkages
                        </h5>
                    </div>

                    {{-- card body start --}}
                    <div class="card-body">
                        <form role="form" id="regiration_form" action="{{ url('add-linkages') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-5">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Type</label>
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" value="Developed/New" name="type" id="customRadio1" name="customRadio">
                                            <label for="customRadio1" class="custom-control-label" style="font-weight: normal;">Developed/New</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">
                                            <input class="custom-control-input" type="radio" value="Maintained/Sustained" name="type" id="customRadio2" name="customRadio">
                                            <label for="customRadio2" class="custom-control-label" style="font-weight: normal;">Maintained/Sustained</label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-5">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Form of Development</label>
                                        <select name="form_of_development" id="" class="form-control">
                                            <option value="Local">Local</option>
                                            <option value="National">National</option>
                                            <option value="International">International</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Year</label>
                                        <input type="text" class="form-control" placeholder="Enter year" name="year">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control" placeholder="Enter ...">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Nature of Assistance/Linkages/Projects</label>
                                        <textarea class="form-control" name="nature_of_assistance" rows="3" placeholder="Enter ..." style="resize: none;"></textarea>
                                    </div>
                                </div>

                                <!-- /.card-body -->
                            </div>

                            <a href="{{ url('rdmc-linkages-index') }}" class="btn btn-default">Back</a>
                            <input type="submit" name="submit" class="submit btn btn-success" value="Submit" />
                            <!-- /.card-body -->
                        </form>
                    </div>
                </div> {{-- card body end --}}
            </div>{{-- card end --}}
        </div>
        <div class="col-lg-1">

        </div>
</div>

</section>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<script>
    function formatNumber(e) {
        var rex = /(^\d{2})|(\d{1,3})(?=\d{1,3}|$)/g,
            val = this.value.replace(/^0+|\.|,/g, ""),
            res;

        if (val.length) {
            res = Array.prototype.reduce.call(val, (p, c) => c + p) // reverse the pure numbers string
                .match(rex) // get groups in array
                .reduce((p, c, i) => i - 1 ? p + "," + c : p + "." + c); // insert (.) and (,) accordingly
            res += /\.|,/.test(res) ? "" : ".0"; // test if res has (.) or (,) in it
            this.value = Array.prototype.reduce.call(res, (p, c) => c + p); // reverse the string and display
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