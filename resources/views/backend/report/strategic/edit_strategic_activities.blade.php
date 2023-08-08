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
                                Strategic R & D Activities
                            </h5>
                        </div>

                        {{-- card body start --}}
                        <div class="card-body">
                            <form role="form" id="regiration_form" action="{{ url('update-strategic/' . $all->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-4">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Programs/Projects</label>
                                            <select name="strategic_program" id="" class="form-control">
                                                <option value="Agency-led"
                                                    {{ 'Agency-led' == $all->strategic_program ? 'selected' : '' }}>
                                                    Agency-led</option>
                                                <option value="Consortium-led"
                                                    {{ 'Consortium-led' == $all->strategic_program ? 'selected' : '' }}>
                                                    Consortium-led</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-1">
                                        {{-- used for spacing --}}
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Researcher</label>
                                            <input type="text" value="{{ $all->strategic_researcher }}"
                                                name="strategic_researcher" class="form-control"
                                                placeholder="Enter researcher's name" list="dtlist">
                                            <datalist id="dtlist">
                                                @foreach ($researchers as $researcher)
                                                    <option value="{{ $researcher->name }}"></option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <label>Implementing Agency</label>
                                            <input type="text" value="{{ $all->strategic_implementing_agency }}"
                                                name="strategic_implementing_agency" class="form-control"
                                                placeholder="Enter ..." list="impdtlist">
                                            <datalist id="impdtlist">
                                                @foreach ($agency as $row)
                                                    <option value="{{ $row->agency_name }}"></option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Title</label>
                                            <textarea name="strategic_title" class="form-control" rows="4" placeholder="Enter ..." style="resize: none">{{ $all->strategic_title }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <label>Funding Agency</label>
                                            <input type="text" value="{{ $all->strategic_funding_agency }}"
                                                name="strategic_funding_agency" class="form-control" placeholder="Enter ..."
                                                list="funddtlist">
                                            <datalist id="funddtlist">
                                                @foreach ($agency as $row)
                                                    <option value="{{ $row->agency_name }} - {{ $row->abbrev }}"></option>
                                                @endforeach
                                            </datalist>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <input type="month" value="{{ $all->strategic_start }}"
                                                name="strategic_start" class="form-control" placeholder="Enter ...">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="month" value="{{ $all->strategic_end }}" name="strategic_end"
                                                class="form-control" placeholder="Enter ...">
                                        </div>
                                    </div>




                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Budget</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">PHP</span>
                                                </div>
                                                <input type="text" value="{{ $all->strategic_budget }}"
                                                    name="strategic_budget" class="form-control" id="numin"
                                                    placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-5">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label>Commodities</label>
                                            <input type="text" value="{{ $all->strategic_commodities }}"
                                                name="strategic_commodities" class="form-control" placeholder="Enter ...">
                                        </div>
                                    </div>



                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Role of Consortium</label>
                                            <input type="text" value="{{ $all->strategic_consortium_role }}"
                                                name="strategic_consortium_role" class="form-control"
                                                placeholder="Enter ...">
                                        </div>
                                    </div>

                                    <!-- /.card-body -->
                                </div>

                                <a href="{{ url('strategic-activities') }}" class="btn btn-default">Back</a>
                                <input type="submit" name="submit" class="submit btn btn-success" value="Update" />
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