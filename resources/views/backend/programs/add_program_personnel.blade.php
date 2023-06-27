@extends('backend.layouts.app')
@section('content')
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
                                Add Personnels
                            </h5>
                        </div>
                        {{-- card body start --}}

                        {{-- <div class="progress">
                        <div class="progress-bar bg-info progress-bar-striped" role="progressbar" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div> --}}
                        <div class="card-body">

                            <form role="form" id="regiration_form" action="{{ url('add-program-personnel') }}"
                                method="POST">
                                @csrf
                                {{-- EMPLOYEE FORM WORKING --}}
                                <fieldset>
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label>Program Staff(s)</label>
                                                <table class="table table-append" id="dynamicAddRemove">
                                                    <tr>
                                                        <td class="append">
                                                            <input type="text" class="form-control"
                                                                name="moreFields[`+i+`][programID]"
                                                                value="{{ Route::input('programID') }}"
                                                                placeholder="Program ID" hidden readonly required
                                                                autocomplete="false">

                                                            <input type="text" class="form-control"
                                                                placeholder="Program Staffs"
                                                                name="moreFields[0][staff_name]">
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

                                    {{-- <input type="button" name="previous" class="previous btn btn-default"
                                    value="Previous" />
                                <input type="button" name="next" class="next btn btn-info" value="Next" /> --}}

                                    <div class="card-footer">
                                        <a href="{{ url('rdmc-programs') }}" class="btn btn-default">Back</a>
                                        <button type="submit" name="submit" class="next btn btn-info">Submit</button>

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
        var i = 0;
        $("#add-btn").click(function() {
            ++i;
            $("#dynamicAddRemove").append(`
            <tr>
                <td class="append">
                    <input type="text" class="form-control" name="moreFields[` + i + `][programID]" value="{{ Route::input('programID') }}" 
                    placeholder="Program ID" hidden readonly required autocomplete="false">
                    <input type="text" class="form-control" placeholder="Program Staffs" name="moreFields[` + i + `][staff_name]">
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

    <script>
        // Auto Add Comma in Number Function
        function updateTextView(_obj) {
            var num = getNumber(_obj.val());
            if (num == 0) {
                _obj.val('');
            } else {
                _obj.val(num.toLocaleString());
            }
        }

        function getNumber(_str) {
            var arr = _str.split('');
            var out = new Array();
            for (var cnt = 0; cnt < arr.length; cnt++) {
                if (isNaN(arr[cnt]) == false) {
                    out.push(arr[cnt]);
                }
            }
            return Number(out.join(''));
        }
        $(document).ready(function() {
            $('input#comma').on('keyup', function() {
                updateTextView($(this));
            });
        });
    @endsection
