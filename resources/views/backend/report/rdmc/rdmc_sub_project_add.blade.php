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

                <div class="col-md-7">

                    {{-- card start --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Add Project
                            </h5>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>
                        {{-- card body start --}}
                        <div class="card-body">
                            <form role="form" id="regiration_form" action="{{ url('add-sub-project') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <fieldset>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Project Title</label>
                                                {{-- Route::input('name'); --}}
                                                @foreach ($projects as $latest)
                                                    <input type="text" name="projectID" class="form-control" value="{{ $latest->id }}"
                                                        hidden readonly placeholder="Enter code">
                                                    <input type="text" class="form-control"
                                                        value="{{ $latest->project_title }}" readonly
                                                        placeholder="Enter code">
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Fund Code</label>
                                                <input type="text" name="sub_project_fund_code" class="form-control"
                                                    placeholder="Enter ...">
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="sub_project_status" id="" class="form-control">
                                                    <option value="New">New</option>
                                                    <option value="On-going">On-going</option>
                                                    <option value="Terminated">Terminated</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select name="sub_project_category" id="" class="form-control">
                                                    <option value="Research Category">Research Category</option>
                                                    <option value="Development Category">Development Category</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Project Title</label>
                                                <textarea name="sub_project_title" id="" cols="30" rows="5" style="resize: none;"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <label>Agency</label>
                                                <select name="sub_project_agency" id="agency"
                                                    class="form-control agency">
                                                    <option></option>
                                                    @foreach ($agency as $key)
                                                        <option value="{{ $key->abbrev }}">{{ $key->agency_name }} -
                                                            ({{ $key->abbrev }})
                                                            </b></option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for=""
                                                    style="visibility: hidden; background-color: white;">Agency</label>
                                                <input type="text" readonly class="form-control" id="agencyAbbrev"
                                                    style="border: none;">
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Funding Duration</label>
                                                <select name="sub_project_funding_duration" id="select1"
                                                    class="form-control">
                                                    <option value="" selected disabled>Select type of fund</option>
                                                    <option value="One-time">One-time Grant</option>
                                                    <option value="Multi-year">Multi-year Funding</option>
                                                    <option value="Both">Both One-time and Multi-year</option>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>&#8203;</label>
                                                <select name="sub_project_funding_years" id="select2"
                                                    class="form-control">
                                                    <option value="" selected disabled>&shy;</option>
                                                    <option value="One-time">1 Year</option>
                                                    <option value="Multi-year">2 - 5 Years</option>
                                                    <option value="Both">Both One-time and Multi-year</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>



                                    <a href="{{ url('rdmc-projects') }}" class="btn btn-default">Back</a>
                                    <input type="button" name="next" class="next btn btn-info" value="Next" />
                                </fieldset>


                                <fieldset>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Start Date</label>
                                                <input type="month" class="form-control" name="sub_project_start_date"
                                                    autocomplete="false">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input type="month" class="form-control" name="sub_project_end_date"
                                                    autocomplete="false">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @if (auth()->user()->role == 'Admin')
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Extend Date</label>
                                                    <input type="month" class="form-control"
                                                        name="sub_project_extend_date" autocomplete="false">
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <label>Project Leader</label>
                                                <input type="text" name="sub_project_leader" class="form-control"
                                                    placeholder="Program Leader" list="leaderdtlist">
                                                <datalist id="leaderdtlist">
                                                    <option value="Leader 1"><span>Agency</span></option>
                                                    <option value="Leader 2"></option>
                                                    <option value="Leader 3"></option>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="form-group">
                                                <label>Assistant Leader</label>
                                                <input type="text" name="sub_project_assistant_leader"
                                                    class="form-control" placeholder="Program Leader" list="assisdtlist">
                                                <datalist id="assisdtlist">
                                                    <option value="Leader 1"><span>Agency</span></option>
                                                    <option value="Leader 2"></option>
                                                    <option value="Leader 3"></option>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>


                                    <input type="button" name="previous" class="previous btn btn-default"
                                        value="Previous" />
                                    <input type="button" name="next" class="next btn btn-info" value="Next" />
                                </fieldset>

                                <fieldset>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Project Description</label>
                                                <textarea name="sub_project_description" id="" cols="30" rows="5" style="resize: none;"
                                                    class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Approved Budget</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">PHP</span>
                                                    </div>
                                                    <input name="sub_project_approved_budget" type="text"
                                                        class="form-control" id="numin">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Amount of Released</label>
                                                <select name="sub_project_budget_year" id="year"
                                                    class="form-control">
                                                    <option value="Year 1">Year 1</option>
                                                    <option value="Year 2">Year 2</option>
                                                    <option value="Year 3">Year 3</option>
                                                    <option value="Year 4">Year 4</option>
                                                    <option value="Year 5">Year 5</option>
                                                    <option value="Year 6">Year 6</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label style="visibility: hidden">Amount of Released</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">PHP</span>
                                                    </div>
                                                    <input name="sub_project_amount_released" type="text"
                                                        class="form-control" id="numin2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Form of Development</label>
                                                <select name="sub_project_form_of_development" id=""
                                                    class="form-control">
                                                    <option value="Local">Local</option>
                                                    <option value="National">National</option>
                                                    <option value="International">International</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="button" name="previous" class="previous btn btn-default"
                                        value="Previous" />
                                    <input type="submit" name="submit" class="submit btn btn-success"
                                        value="Submit" />
                                </fieldset>
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

    <script type="text/javascript">
        var i = 0;
        $("#add-btn").click(function() {
            ++i;
            $("#dynamicAddRemove").append(`
        <tr>
            <td class="append">
                <input type="text" class="form-control" placeholder="Project Staffs" name="moreFields[0][name]">
            </td>

            <td class="append">
                <i class="fa-solid fa-user-minus fa-lg remove-input" style="color: #dc3545;"></i>
            </td>
        </tr>
        `);
        });
        $(document).on('click', '.remove-input', function() {
            $(this).parents('tr').remove();
        });
    </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection
