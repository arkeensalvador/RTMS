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

                <div class="col-md-8">

                    {{-- card start --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Technology Transfer Proposals
                            </h5>
                        </div>

                        {{-- card body start --}}
                        <div class="card-body">
                            <form role="form" id="regiration_form" action="{{ url('add-ttp') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-3">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" value="Packaged"
                                                    id="customRadio1" name="ttp_type">
                                                <label for="customRadio1" class="custom-control-label">Packaged</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio"
                                                    value="Approved/Implemented" id="customRadio2" name="ttp_type">
                                                <label for="customRadio2"
                                                    class="custom-control-label">Approved/Implemented</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Title</label>
                                            <textarea class="form-control" name="ttp_title" rows="3" placeholder="Enter ..." style="resize: none;"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Budget</label>
                                            <input type="text" class="form-control" id="numin" name="ttp_budget"
                                                placeholder="Enter ...">
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Source of Fund</label>
                                            <input type="text" class="form-control" name="ttp_sof"
                                                placeholder="Enter ..." list="sourcedtlist">
                                            <datalist id="sourcedtlist">
                                                <option value="Source of Fund 1"></option>
                                            </datalist>
                                        </div>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="month" name="ttp_start_date" class="form-control"
                                                placeholder="Enter ...">
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="month" name="ttp_end_date" class="form-control"
                                                placeholder="Enter ...">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-5">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Regional Priorities Addressed</label>
                                            <textarea class="form-control" name="ttp_priorities" rows="3" placeholder="Enter ..."></textarea>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </div>

                                <a href="{{ url('rdru-ttp') }}" class="btn btn-default">Back</a>
                                <input type="submit" name="submit" class="submit btn btn-success" value="Submit" />
                                <!-- /.card-body -->
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