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

                <div class="col-md-6">

                    {{-- card start --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Add Program
                            </h5>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>

                        {{-- card body start --}}
                        <div class="card-body">
                            <form role="form" id="regiration_form" action="{{ URL::to('/update-program/'.$program->programID)}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <fieldset>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>ProgramID</label>
                                                {{-- Route::input('name'); --}}
                                                <input type="text" class="form-control" value="{{ $program->programID }}"
                                                    readonly placeholder="Enter code" name="programID">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Fund Code</label>
                                                <input type="text" value="{{ $program->fund_code }}" class="form-control"
                                                    placeholder="Enter code" name="fund_code">
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="program_status" class="form-control" id="">
                                                    <option value="Finished"
                                                        {{ 'New' == $program->program_status ? 'selected' : '' }}
                                                        class="">New</option>
                                                    <option value="Ongoing"
                                                        {{ 'On-going' == $program->program_status ? 'selected' : '' }}
                                                        class="">Ongoing</option>
                                                    <option value="Canceled"
                                                        {{ 'Terminated' == $program->program_status ? 'selected' : '' }}
                                                        class="">Terminated</option>
                                                    <option value="Finished"
                                                        {{ 'Completed' == $program->program_status ? 'selected' : '' }}
                                                        class="">Completed</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select name="program_category" id="" class="form-control">
                                                    <option value="Research Category"
                                                        {{ 'Research Category' == $program->program_category ? 'selected' : '' }}>
                                                        Research
                                                        Category</option>
                                                    <option value="Development Category"
                                                        {{ 'Development Category' == $program->program_category ? 'selected' : '' }}>
                                                        Development Category</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Program Title</label>
                                                <textarea name="program_title" id="" cols="30" rows="5"
                                                    style="resize: none;" class="form-control">{{ $program->program_title }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>Funding Agency</label>
                                                <select class="form-control agency" value="{{ $program->funding_agency }}"
                                                    name="funding_agency" id="" required>
                                                    <option></option>
                                                    @foreach ($agency as $key)
                                                        <option value="{{ $key->abbrev }}"
                                                            {{ $key->abbrev == $program->funding_agency ? 'selected' : '' }}>
                                                            {{ $key->agency_name }} -
                                                            ({{ $key->abbrev }})
                                                            </b></option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Coordination Fund</label>
                                                <input type="text" value="{{ $program->coordination_fund }}" name="coordination_fund" class="form-control"
                                                    id="cf" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <a href="{{ url('rdmc-projects') }}" class="btn btn-default">Back</a>
                                    <input type="submit" name="submit" class="submit btn btn-success" value="Submit" /> --}}

                                    <a href="{{ url('rdmc-programs') }}" class="btn btn-default">Back</a>
                                    <input type="button" name="next" class="next btn btn-info" value="Next" />
                                    <!-- /.card-body -->
                                    {{-- Page2 --}}
                                </fieldset>

                                <fieldset>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Start Date</label>
                                                <input type="date" value="{{ $program->start_date }}" class="form-control" name="start_date"
                                                    autocomplete="false">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input type="date" value="{{ $program->end_date }}" class="form-control" name="end_date"
                                                    autocomplete="false">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        @if (auth()->user()->role == 'Admin')
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Extend Date</label>
                                                    <input type="date" value="{{ $program->extend_date }}" class="form-control" name="extend_date"
                                                        autocomplete="false">
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Program Leader</label>
                                                <input type="text" name="program_leader" value="{{ $program->program_leader }}" class="form-control"
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
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Assistant Leader</label>
                                                <input type="text" name="assistant_leader" class="form-control"
                                                    placeholder="Program Leader" value="{{ $program->assistant_leader }}" list="assisdtlist">
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
                                                <label>Program Description</label>
                                                <textarea name="program_description" id="" cols="30" rows="5" style="resize: none;"
                                                    class="form-control">{{ $program->program_description }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Approved Budget</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">PHP</span>
                                                    </div>
                                                    <input type="text" value="{{ $program->approved_budget }}" class="form-control" id="numin"
                                                        name="approved_budget">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Amount of Released</label>
                                                <select name="budget_year" id="year" class="form-control">
                                                    <option value="Year 1" {{ 'Year 1' == $program->budget_year ? 'selected' : '' }} >Year 1</option>
                                                    <option value="Year 2" {{ 'Year 2' == $program->budget_year ? 'selected' : '' }} >Year 2</option>
                                                    <option value="Year 3" {{ 'Year 3' == $program->budget_year ? 'selected' : '' }} >Year 3</option>
                                                    <option value="Year 4" {{ 'Year 4' == $program->budget_year ? 'selected' : '' }} >Year 4</option>
                                                    <option value="Year 5" {{ 'Year 5' == $program->budget_year ? 'selected' : '' }} >Year 5</option>
                                                    <option value="Year 6" {{ 'Year 6' == $program->budget_year ? 'selected' : '' }} >Year 6</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label style="visibility: hidden">Amount of Released</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">PHP</span>
                                                    </div>
                                                    <input type="text" value="{{ $program->amount_released }}" class="form-control" id="numin2"
                                                        name="amount_released">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Form of Development</label>
                                                <select name="form_of_development" id="" class="form-control">
                                                    <option value="Local"
                                                    {{ 'Local' == $program->form_of_development ? 'selected' : '' }} >Local</option>
                                                    <option value="National"
                                                    {{ 'National' == $program->form_of_development ? 'selected' : '' }}>National</option>
                                                    <option value="International"
                                                    {{ 'International' == $program->form_of_development ? 'selected' : '' }}>International</option>
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

    {{-- <script>
        $(document).ready(function() {
            $('form #btn-ok').click(function(e) {
                let $form = $(this).closest('form');
                Swal.fire({
                    // title: 'Are you  sure?',
                    icon: 'info',
                    text: 'Are there any Project associated with this Program?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'None',
                    allowEscapeKey: false,
                    allowOutsideClick: false,
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {

                        $form.submit();
                        window.location.href = "projects-add" + "/" + $_SESSION['programID'];

                    } else if (
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        $form.submit();
                        window.location.href = 'rdmc-projects';
                    }
                });

            });
        });
    </script> --}}

    <script>
        var selectBox = document.getElementById("year");
        selectBox.onchange = function() {
            var textbox = document.getElementById("textYear");
            textbox.value = this.value;
        };
    </script>
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
        var ni3 = document.getElementById("cf");

        ni.addEventListener("keyup", formatNumber);
        ni2.addEventListener("keyup", formatNumber);
        ni3.addEventListener("keyup", formatNumber);
    </script>

    <script type="text/javascript">
        var i = 0;
        $("#add-btn").click(function() {
            ++i;
            $("#dynamicAddRemove").append(`
            <tr>
                <td class="append">
                    <input type="text" class="form-control" placeholder="Program Staffs" name="moreFields[` + i + `][staff_name]">
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
@endsection
