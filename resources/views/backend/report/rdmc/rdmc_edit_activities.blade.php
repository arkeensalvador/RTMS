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
                                Edit Activity
                            </h5>
                        </div>


                        {{-- card body start --}}
                        <div class="card-body">
                            <form role="form" id="regiration_form" action="{{ URL::to('/update-activity/'.$all->id)}}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <label>Donor/Source</label>
                                            <input type="text" value="{{ $all->donor }}" name="donor" class="form-control" list="donorList">
                                            <datalist id="donorList">
                                                @foreach ($agency as $key)
                                                    <option value="{{ $key->abbrev }}">{{ $key->agency_name }} -
                                                        ({{ $key->abbrev }})
                                                        </b></option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Activity Type</label>
                                            <input name="activity_type" value="{{ $all->activity_type }}" class="form-control" list="titledtlist">
                                            <datalist id="titledtlist">
                                                <option
                                                    value="Implementation of Consortium-led R&D and Technology Transfer-related Programs/Activities">
                                                </option>
                                                <option value="HRD Activities"></option>
                                                <option
                                                    value="Improvement of Consortium's or Member-institution's Facilities">
                                                </option>
                                                <option value="Planning/Consultation Activities"></option>
                                                <option value="AIHRS/Sectoral Reviews"></option>
                                                <option value="RSRDH"></option>
                                                <option value="Regional Fairs/Exhibits(e.g. Fiesta, etc)"></option>
                                                <option value="Annual Contribution"></option>
                                            </datalist>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Activity Title</label>
                                            <textarea name="activity_title"  id="" cols="5" rows="5" style="resize: none;" class="form-control">{{ $all->activity_title }} </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <label>Shared Amount</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">PHP</span>
                                                </div>
                                                <input type="text" value="{{ $all->shared_amount }} " name="shared_amount" id="numin" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <textarea name="remarks" id="" cols="5" rows="5" style="resize: none;" class="form-control">{{ $all->remarks }} </textarea>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ url('rdmc-activities') }}" class="btn btn-default">Back</a>
                                <input type="submit" name="submit" class="submit btn btn-success" value="Submit" />
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
                    <input type="text" class="form-control" placeholder="Program Staffs" name="moreFields[0][name]">
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
