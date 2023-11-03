@extends('backend.layouts.app')
@section('content')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
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
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="d-flex mt-3">
                            <form id="programForm" class="row g-3 needs-validation" novalidate>
                                @csrf
                                <div class="form-title col-12">
                                    <h2 class="font-weight-bold">Policies formulated, advocated, implemented institutional
                                        and institutionalized</h2>
                                    <h5 class="mt-0"> Kindly fill-out the fields needed.</h5>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="ini_initiates" class="font-weight-bold">Type<span
                                            class="text-danger">*</span></label>
                                    <br>
                                    <select id="policy_type" name="policy_type" class="others form-control" required>
                                        <option selected disabled value="">Select Type</option>
                                        <option value="Formulated"
                                            {{ 'Formulated' == $all->policy_type ? 'selected' : '' }}>Formulated</option>
                                        <option value="Advocated" {{ 'Advocated' == $all->policy_type ? 'selected' : '' }}>
                                            Advocated</option>
                                        <option value="Implemented"
                                            {{ 'Implemented' == $all->policy_type ? 'selected' : '' }}>Implemented</option>
                                        <option value="Institutionalized"
                                            {{ 'Institutionalized' == $all->policy_type ? 'selected' : '' }}>Institutionalized
                                        </option>

                                    </select>

                                    <div class="invalid-feedback">Missing type</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="ini_initiates" class="font-weight-bold">Agency<span
                                            class="text-danger">*</span></label>
                                    <br>
                                    <select name="policy_agency" class="form-control agency" required>
                                        <option value=""></option>
                                        @if (auth()->user()->role == 'Admin')
                                            @foreach ($agency as $key)
                                                <option value="{{ $key->abbrev }}"
                                                    {{ $key->abbrev == $all->policy_agency ? 'selected' : '' }}>
                                                    {{ $key->agency_name }}
                                                    </b></option>
                                            @endforeach
                                        @else
                                            <option value="{{ $user_agency->abbrev }}" selected>
                                                {{ $user_agency->agency_name }} -
                                                ({{ $user_agency->abbrev }})
                                                </b></option>
                                        @endif
                                    </select>

                                    <div class="invalid-feedback">Missing agency</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="policy_issues" class="font-weight-bold">Issues addressed<span
                                            class="text-danger">*</span></label>

                                    <textarea name="policy_issues" id="policy_issues" class="form-control" cols="30" rows="5" required>{{ $all->policy_issues }}</textarea>

                                    <div class="invalid-feedback">Missing issues addressed</div>
                                </div>

                                <div class="col-md-4 form-group float-right">
                                    <a href="{{ url('policy-prc') }}" class="btn btn-default">Back</a>
                                    <button type="submit" id="submit" class="btn btn-primary btn-m ">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        document.getElementById('programForm').addEventListener('submit', function(event) {
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            if (!endDate) {
                event.preventDefault();
                document.getElementById('end_date').classList.add('is-invalid');
            }
            if (!startDate) {
                event.preventDefault();
                document.getElementById('start_date').classList.add('is-invalid');
            }
            if (!startDate && !endDate) {
                event.preventDefault();
                document.getElementById('start_date').classList.add('is-invalid');
                document.getElementById('end_date').classList.add('is-invalid');
            }
        });
    </script>

    <script>
        var selectBox = document.getElementById("year");
        selectBox.onchange = function() {
            var textbox = document.getElementById("textYear");
            textbox.value = this.value;
        };
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
        var ni3 = document.getElementById("cf");
        var ni4 = document.getElementById("funding_duration");

        ni.addEventListener("keyup", formatNumber);
        ni2.addEventListener("keyup", formatNumber);
        ni3.addEventListener("keyup", formatNumber);
        ni4.addEventListener("keyup", formatNumber);
    </script>


    <script>
        $(document).ready(function() {
            $('.js-recipients').select2({
                placeholder: 'test',
                tags: true,
                allowClear: true
            });
        });
    </script>
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();

                            Swal.fire({
                                icon: 'info',
                                title: 'All fields are required',
                                timerProgressBar: false,
                                showConfirmButton: true,
                            });
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>


    <script>
        $(document).ready(function() {
            $('#fund_code, #status, #fund_code, #program_title, #category, #funding_agency, #coordination_fund, #program_leader, #assistant_leader, #start_date, #extension_date, #program_description, #approved_budget, #amount_of_release, #budget_year ,#year_of_release, #form_of_development')
                .on('input', function() {
                    const inputField = $(this);
                    if (inputField[0].checkValidity()) {
                        inputField.addClass('is-valid').removeClass('is-invalid');
                    } else {
                        inputField.addClass('is-invalid').removeClass('is-valid');
                    }
                });

            $('#programForm').on('submit', function(e) {

                var formData = new FormData(this);

                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('update-formulated/' . $all->id) }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Updated Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        }).then((result) => {
                            if (result.dismiss) {
                                // // this.reset();
                                window.location.href = '/policy-formulated';
                            }
                        })

                    },
                    error: function(data) {
                        // Swal.fire({
                        //     icon: 'warning',
                        //     title: "There's something wrong...",
                        //     timerProgressBar: false,
                        //     showConfirmButton: true,
                        // });
                    }
                });
            });
        });
    </script>
@endsection
