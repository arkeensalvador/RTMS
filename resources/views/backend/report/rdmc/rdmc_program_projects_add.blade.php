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
                        <div class="d-flex justify-content-center mt-3">
                            <form id="projectForm" class="row g-3 needs-validation" novalidate>
                                @csrf
                                <div class="form-title col-12">
                                    <h2 class="font-weight-bold">Project under program</h2>
                                    <h5 class="mt-0"> Kindly fill-up the fields needed.</h5>
                                </div>

                                <div class="col-md-4 form-group" hidden>
                                    <label for="programID" class="font-weight-bold">System Generated Program ID <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="programID" class="form-control"
                                        value="{{ $programs->programID }}" readonly placeholder="Enter code"
                                        name="programID">
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">Missing program id</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="" class="font-weight-bold">Program<span
                                            class="text-success">*</span></label>
                                    <input type="text" class="form-control" value="{{ $programs->program_title }}"
                                        readonly placeholder="Enter code">
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">Missing program title</div>
                                </div>


                                <div class="col-md-4 form-group">
                                    <label for="fund_code" class="font-weight-bold">Fund Code<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="project_fund_code" class="form-control" id="fund_code"
                                        placeholder="Input Trust Fund Code" required>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">Missing fund code</div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="status" class="font-weight-bold">Status<span
                                            class="text-danger">*</span></label>
                                    <select id="status" name="project_status" class="form-control others" required>
                                        <option selected disabled value="">Select status</option>
                                        <option value="New">New</option>
                                        <option value="Ongoing">Ongoing</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Terminated">Terminated</option>
                                    </select>
                                    <div class="invalid-feedback">Missing status</div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="category" class=" font-weight-bold">Category<span
                                            class="text-danger">*</span></label>
                                    <select id="category" name="project_category" class="form-control others" required>
                                        <option selected disabled value="">Select the project category</option>
                                        <option value="Research">Research Category</option>
                                        <option value="Development">Development Category</option>
                                    </select>
                                    <div class="invalid-feedback">Missing project category</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="program_title" class=" font-weight-bold">Project Title<span
                                            class="text-danger">*</span></label></label>
                                    <textarea class="form-control" id="program_title" name="project_title" style="height: 100px"
                                        placeholder="Enter project title" required></textarea>
                                    <div class="invalid-feedback">Missing project title</div>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="form_of_development" class=" font-weight-bold">Form of Development<span
                                            class="text-danger">*</span></label>
                                    <select id="form_of_development" name="project_form_of_development"
                                        class="others form-control" required>
                                        <option selected disabled value="">Select form of development</option>
                                        <option value="Local">Local</option>
                                        <option value="National">National</option>
                                        <option value="International">International</option>
                                    </select>
                                    <div class="invalid-feedback">Missing form of development</div>
                                </div>

                                <div class="col-md-9 form-group">
                                    <label for="funding_agency" class=" font-weight-bold">Funding Agency<span
                                            class="text-danger">*</span></label>
                                    <select id="funding_agency" name="project_agency" class="form-control agency"
                                        required>
                                        <option selected disabled value="">Choose Funding Agency / Source of Fund
                                        </option>
                                        @foreach ($agency as $key)
                                            <option value="{{ $key->abbrev }}">{{ $key->agency_name }} -
                                                ({{ $key->abbrev }})
                                                </b></option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing Funding Agency / Source of Fund</div>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="coordination_fund" class=" font-weight-bold">Funding Grant<span
                                            class="text-danger">*</span></label>
                                    <select id="form_of_development" name="project_funding_duration"
                                        class="others form-control" required>
                                        <option selected disabled value="">Select Funding Grant</option>
                                        <option value="One-time">One-time Grant</option>
                                        <option value="Multi-year">Multi-year Grant</option>
                                        <option value="Both">One-time & Multi-year Grant</option>
                                    </select>
                                    <div class="invalid-feedback">Missing funding grant</div>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="coordination_fund" class=" font-weight-bold">Funding Year(s)<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="project_funding_years" class="form-control"
                                        id="coordination_fund" placeholder="E.g. 1 Year, 2 Years, etc." required>
                                    <div class="invalid-feedback">Missing funding year(s)</div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label for="program_leader" class=" font-weight-bold">Project Leader <span
                                                class="text-danger">*</span></label>
                                        <select id="program_leader" name="project_leader"
                                            class="form-control researchers" required>
                                            <option selected disabled value="">Select Researcher</option>
                                            @foreach ($researchers as $key)
                                                <option value="{{ $key->name }}">{{ $key->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Missing project leader</div>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="assistant_leader" class=" font-weight-bold">Assistant Leader <span
                                                class="text-danger">*</span></label>
                                        <select id="assistant_leader" name="project_assistant_leader"
                                            class="form-control researchers" required>
                                            <option selected disabled value="">Select Researcher</option>
                                            @foreach ($researchers as $key)
                                                <option value="{{ $key->name }}">{{ $key->name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">Missing assistant leader</div>
                                    </div>
                                </div>


                                <div class="col-md-4 form-group">
                                    <label for="start_date" class=" font-weight-bold">Start Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="project_start_date" class="form-control" id="start_date"
                                        required>
                                    <div class="invalid-feedback">Missing start date of the project</div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="end_date" class=" font-weight-bold">End Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="project_end_date" class="form-control" id="end_date"
                                        required>
                                    <div class="invalid-feedback"> Missing end of the project</div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="extension_date" class=" font-weight-bold">Extension Date</label>
                                    <input type="date" name="project_extend_date" class="form-control"
                                        id="extension_date">
                                    <div class="valid-feedback">There's no inputted extension date for this project</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="program_description" class=" font-weight-bold">Project Description<span
                                            class="text-danger">*</span></label></label>
                                    <textarea class="form-control" name="project_description" id="program_description" style="height: 100px"
                                        placeholder="Project brief description" required></textarea>
                                    <div class="invalid-feedback">Missing project description</div>
                                </div>


                                <div class="col-md-3 form-group">
                                    <label for="approved_budget" class=" font-weight-bold">Approved Budget<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="project_approved_budget" class="form-control"
                                        id="approved_budget" placeholder="Approved budget" required>
                                    <div class="invalid-feedback">Missing approved budget</div>
                                </div>

                                <div class="col-md-1 form-group">
                                    <label for="#year_of_release" class=" font-weight-bold">Budget Year<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="project_budget_year" class="form-control"
                                        id="budget_year" required placeholder="Ex. Year 1">
                                    <div class="invalid-feedback"> Missing budget year</div>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="year_of_release" class=" font-weight-bold">Amount Released<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="project_amount_released" class="form-control"
                                        id="year_of_release" placeholder="Enter exact amount" required>
                                    <div class="invalid-feedback">Missing</div>
                                </div>


                                <div class="col-md-12 form-group">
                                    <label for="" class=" font-weight-bold">Keywords</label>
                                    <input type="text" name="keywords[]" class="form-control js-recipients"
                                        placeholder="Keyword(s)" data-role="tagsinput" required>
                                    <div class="invalid-feedback">Missing keywords</div>
                                </div>

                                <div class="col-md-4 form-group float-right">
                                    <a href="{{ url('rdmc-programs') }}" class="btn btn-default">Back</a>
                                    <button type="submit" id="submit" class="btn btn-primary btn-m ">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    </section>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js"></script> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script> --}}

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

    <script>
        $(document).ready(function() {
            $('#fund_code, #status, #fund_code, #program_title, #category, #funding_agency, #coordination_fund, #program_leader, #assistant_leader, #start_date, #end_date, #extension_date, #program_description, #approved_budget, #amount_of_release, #budget_year ,#year_of_release, #form_of_development')
                .on('input', function() {
                    const inputField = $(this);
                    if (inputField[0].checkValidity()) {
                        inputField.addClass('is-valid').removeClass('is-invalid');
                    } else {
                        inputField.addClass('is-invalid').removeClass('is-valid');
                    }
                });

            $('#projectForm').on('submit', function(e) {

                var formData = new FormData(this);

                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('add-project') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Project Added Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        }).then((result) => {
                            if (result.dismiss) {
                                window.location.href = '/rdmc-programs';
                            }
                        })
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'warning',
                            title: "There's something wrong...",
                            timerProgressBar: false,
                            showConfirmButton: true,
                        });
                    }
                });
            });
        });
    </script>
@endsection
