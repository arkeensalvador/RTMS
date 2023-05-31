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
                                Add Project
                            </h5>
                        </div>

                        {{-- card body start --}}
                        <div class="card-body">
                            <form role="form" id="regiration_form" action="#" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Fund Code</label>
                                            <input type="text" class="form-control" placeholder="Enter ...">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="" id="" class="form-control">
                                                <option value="">New</option>
                                                <option value="">On-going</option>
                                                <option value="">Terminated</option>
                                                <option value="">Completed</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="" id="" class="form-control">
                                                <option value="">Research Category</option>
                                                <option value="">Development Category</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Project Title</label>
                                            <textarea name="" id="" cols="30" rows="5" style="resize: none;" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Agency</label>
                                            <select name="" id="agency" class="form-control">
                                                <option value="Agency 1">Agency 1</option>
                                                <option value="Agency 2">Agency 2</option>
                                                <option value="Agency 3">Agency 3</option>
                                                <option value="CLSU">Central Luzon State University</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for=""></label>
                                            <input type="text" class="form-control" id="agencyAbbrev"
                                                style="border: none;">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Funding Duration</label>
                                            <select name="select1" id="select1" class="form-control">
                                                <option value="" selected disabled>Select type of fund</option>
                                                <option value="1">One-time Grant</option>
                                                <option value="2">Multi-year Funding</option>
                                                <option value="3">Both One-time and Multi-year</option>
                                              </select>
                                              
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>&#8203;</label>
                                              <select name="select2" id="select2" class="form-control">
                                                <option value="" selected disabled>&shy;</option>
                                                <option value="1">1 Year</option>
                                                <option value="2">2 Years</option>
                                                <option value="2">3 Years</option>
                                                <option value="2">4 Years</option>
                                                <option value="2">5 Years</option>
                                                <option value="2">6 Years</option>
                                                <option value="2">7 Years</option>
                                                <option value="3">Both One-time and Multi-year</option>
                                              </select>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ url('researcher-index') }}" class="btn btn-default">Back</a>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script>
        var selectBox = document.getElementById("agency");
        selectBox.onchange = function() {
            var textbox = document.getElementById("agencyAbbrev");
            textbox.value = this.value;
        };

        $("#select1").change(function() {
            if ($(this).data('options') === undefined) {
                /*Taking an array of all options-2 and kind of embedding it on the select1*/
                $(this).data('options', $('#select2 option').clone());
            }
            var id = $(this).val();
            var options = $(this).data('options').filter('[value=' + id + ']');
            $('#select2').html(options);
        });
    </script>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection
