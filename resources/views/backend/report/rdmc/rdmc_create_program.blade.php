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
                                Add Program
                            </h5>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuemin="0"
                                aria-valuemax="100"></div>
                        </div>

                        {{-- card body start --}}
                        <div class="card-body">
                            <form role="form" id="regiration_form" action="#" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <fieldset>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>ProgramID</label>
                                                {{-- Route::input('name'); --}}
                                                <input type="text" class="form-control"
                                                    value="<?= substr(md5(microtime()), 0, 10) ?>" disabled
                                                    placeholder="Enter code">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Fund Code</label>
                                                <input type="text" class="form-control" placeholder="Enter code">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="New">New</option>
                                                    <option value="On-going">On-going</option>
                                                    <option value="Terminated">Terminated</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="Research Category">Research Category</option>
                                                    <option value="Development Category">Development Category</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Program Title</label>
                                                <textarea name="" id="" cols="30" rows="5" style="resize: none;" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>Funding Agency</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="">Agency 1</option>
                                                    <option value="">Agency 2</option>
                                                    <option value="">Agency 3</option>
                                                    <option value="">Agency 4</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Coordination Fund</label>
                                                <input type="text" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <a href="{{ url('rdmc-projects') }}" class="btn btn-default">Back</a>
                                    <input type="submit" name="submit" class="submit btn btn-success" value="Submit" /> --}}

                                    <a href="{{ url('rdmc-projects') }}" class="btn btn-default">Back</a>
                                    <input type="button" name="next" class="next btn btn-info" value="Next" />
                                    <!-- /.card-body -->


                                    {{-- Page2 --}}
                                </fieldset>

                                <fieldset>

                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Start Date</label>
                                                <input type="date" class="form-control" name="start_date" required
                                                    autocomplete="false">
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>End Date</label>
                                                <input type="date" class="form-control" name="end_date" required
                                                    autocomplete="false">
                                            </div>
                                        </div>

                                        @if (auth()->user()->role == 'Admin')
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>Extend Date</label>
                                                    <input type="date" class="form-control" name="extend_date" required
                                                        autocomplete="false">
                                                </div>
                                            </div>
                                        @endif
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Coordination Fund</label>
                                                <input type="text" class="form-control" placeholder="Enter ...">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Program Leader</label>
                                                <input type="text" class="form-control" placeholder="Program Leader"
                                                    list="leaderdtlist">
                                                <datalist id="leaderdtlist">
                                                    <option value="Leader 1"><span>Agency</span></option>
                                                    <option value="Leader 2"></option>
                                                    <option value="Leader 3"></option>
                                                </datalist>
                                            </div>
                                        </div>

                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Assistant Leader</label>
                                                <input type="text" class="form-control" placeholder="Program Leader"
                                                    list="assisdtlist">
                                                <datalist id="assisdtlist">
                                                    <option value="Leader 1"><span>Agency</span></option>
                                                    <option value="Leader 2"></option>
                                                    <option value="Leader 3"></option>
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Program Staff(s)</label>
                                                <table class="table table-append" id="dynamicAddRemove">
                                                    <tr>
                                                        <td class="append">
                                                            {{-- <label>Program Staff</label> --}}
                                                            <input type="text" class="form-control"
                                                                placeholder="Program Staffs" name="moreFields[0][name]">
                                                        </td>

                                                        <td class="append">
                                                            <i class="fa-solid fa-user-plus fa-lg" style="color: #28a745;"
                                                                name="add" id="add-btn"></i>
                                                        </td>
                                                    </tr>
                                                </table>
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
                                                <textarea name="" id="" cols="30" rows="5" style="resize: none;" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Approved Budget</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">PHP</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="numin">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label>Amount of Released</label>
                                                <select name="" id="year" class="form-control">
                                                    <option value="Year 1">Year 1</option>
                                                    <option value="Year 2">Year 2</option>
                                                    <option value="Year 3">Year 3</option>
                                                    <option value="Year 4">Year 4</option>
                                                    <option value="Year 5">Year 5</option>
                                                    <option value="Year 6">Year 6</option>
                                                </select>
                                            </div>
                                            <input type="text" id="textYear">

                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label style="visibility: hidden">Amount of Released</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">PHP</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="numin2">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Form of Development</label>
                                                <select name="" id="" class="form-control">
                                                    <option value="">Local</option>
                                                    <option value="">National</option>
                                                    <option value="">International</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <input type="button" name="previous" class="previous btn btn-default"
                                        value="Previous" />

                                    <a href="{{ url('projects-add') }}" class="btn btn-info"
                                        onclick="event.preventDefault();
                                        swalWithBootstrapButtons = Swal.mixin({
                                    customClass: {
                                        confirmButton: 'btn btn-success',
                                        cancelButton: 'btn btn-danger'
                                        },
                                        buttonsStyling: false
                                        })
                                        Swal.fire({
                                            icon: 'info',
                                            title: 'Are there any Project associated with this Program?',
                                            confirmButtonText: 'Yes',
                                            cancelButtonText: 'No',
                                            showCancelButton: true,
                                            reverseButtons: true,
                                            buttons: true,
                                            allowEscapeKey: false,
                                            allowOutsideClick: false
                                        })
                                        .then((result) => { 
                                            var link= $(this).attr('href');
                                            if (result.isConfirmed) {
                                                window.location.href = 'projects-add';
                                            // } else if (result.isDismissed){
                                            //     window.location.href = link;
                                            }
                                        }); ">

                                        <span>Next</span></a>
                                    {{-- <input type="submit" name="submit" class="submit btn btn-success" value="Submit" /> --}}
                                </fieldset>
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
