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
                                Add Staff
                            </h5>
                        </div>

                        {{-- card body start --}}
                        <div class="card-body">

                            <form role="form" id="regiration_form" action="{{ url('add-project-personnel') }}"
                                method="POST">
                                @csrf
                                {{-- EMPLOYEE FORM WORKING --}}
                                <fieldset>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Project Staff(s)</label>
                                                <table class="table table-append" id="dynamicAddRemove">
                                                    <tr>
                                                        <td class="append">
                                                            <input type="text" class="form-control"
                                                                name="moreFields[0][projectID]"
                                                                value="{{ Route::input('id') }}" placeholder="Project ID"
                                                                hidden readonly required autocomplete="false">

                                                            <input type="text" class="form-control" placeholder="Staff"
                                                                name="moreFields[0][staff_name]" autocomplete="false">
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

                                    {{-- <div class="card-footer"> --}}
                                    @if (Route::is('AddProgramPersonnelsIndex'))
                                        <a href="{{ url('rdmc-programs') }}" class="btn btn-default">Back</a>
                                    @else
                                        <a href="{{ url('rdmc-projects') }}" class="btn btn-default">Back</a>
                                    @endif
                                    <button type="submit" name="submit" class="next btn btn-info">Submit</button>
                                    {{-- </div> --}}
                                </fieldset>


                            </form>

                        </div> {{-- card body end --}}
                    </div>{{-- card end --}}

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Staff(s)
                            </h5>
                        </div>

                        {{-- card body start --}}
                        <div class="card-body">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            {{-- <label>Project Staff(s)</label> --}}
                                            <table class="table table-striped ">
                                                <tr>

                                                    <th>Name</th>
                                                    <th>Action</th>
                                                </tr>
                                                @foreach ($personnel as $staff)
                                                    <tr>
                                                        <td>
                                                            {{ $staff->staff_name }}
                                                        </td>
                                                        <td style="" class="action btns">
                                                            <a href="{{ URL::to('/delete-staff/' . $staff->id) }}"
                                                                class="btn btn-sm btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

    <script>
        var selectBox = document.getElementById("year");
        selectBox.onchange = function() {
            var textbox = document.getElementById("textYear");
            textbox.value = this.value;
        };
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
        var i = 0;
        $("#add-btn").click(function() {
            ++i;
            $("#dynamicAddRemove").append(`
            <tr>
                <td class="append">
                    <input type="text" class="form-control" name="moreFields[` + i + `][projectID]" value="{{ Route::input('id') }}" 
                    placeholder="Program ID" hidden readonly required autocomplete="false">
                    <input type="text" class="form-control" placeholder="Staff" name="moreFields[` + i + `][staff_name]">
                </td>

                <td class="append">
                    <i class="fa-solid fa-user-minus fa-lg remove-input" style="color: #dc3545;"></i>
                </td>
            </tr>`);
        });
        $(document).on('click', '.remove-input', function() {
            $(this).parents('tr').remove();
        });

        $('input.number-to-text').keydown(function(event) {
            if ([38, 40].indexOf(event.keyCode) > -1) {
                event.preventDefault();
            }
        });
    </script>
@endsection
