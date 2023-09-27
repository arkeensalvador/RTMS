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
                            <form id="programForm" class="row g-3 needs-validation" novalidate>
                                @csrf
                                <div class="form-title col-12 mb-3">
                                    <h2 class="font-weight-bold">Edit Program</h2>
                                    <h5 class="mt-0"> Kindly edit the fields needed.</h5>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="fund_code" class="font-weight-bold">System Generated Program ID <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ $programs->programID }}"
                                            readonly placeholder="Enter code" name="programID">
                                        <div class="valid-feedback"></div>
                                        <div class="invalid-feedback">Missing fund code</div>
                                    </div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="fund_code" class="font-weight-bold">Fund Code<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="fund_code" value="{{ $programs->fund_code }}"
                                        class="form-control" id="fund_code" placeholder="Input Trust Fund Code" required>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">Missing fund code</div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="status" class="font-weight-bold">Status<span
                                            class="text-danger">*</span></label>
                                    <select id="status" name="program_status" class="form-control others" required>
                                        <option selected disabled value="">Select status</option>
                                        <option value="New" {{ 'New' == $programs->program_status ? 'selected' : '' }}>
                                            New</option>
                                        <option value="Ongoing"
                                            {{ 'Ongoing' == $programs->program_status ? 'selected' : '' }}>Ongoing</option>
                                        <option value="Completed"
                                            {{ 'Completed' == $programs->program_status ? 'selected' : '' }}>Completed
                                        </option>
                                        <option value="Terminated"
                                            {{ 'Terminated' == $programs->program_status ? 'selected' : '' }}>Terminated
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">Missing status</div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="category" class=" font-weight-bold">Category<span
                                            class="text-danger">*</span></label>
                                    <select id="category" name="program_category" class="form-control others" required>
                                        <option selected disabled value="">Select the program category</option>
                                        <option value="Research"
                                            {{ 'Research' == $programs->program_category ? 'selected' : '' }}>
                                            Research Category</option>
                                        <option value="Development"
                                            {{ 'Development' == $programs->program_category ? 'selected' : '' }}>
                                            Development Category</option>
                                    </select>
                                    <div class="invalid-feedback">Missing program category</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="program_title" class=" font-weight-bold">Program Title<span
                                            class="text-danger">*</span></label></label>
                                    <textarea class="form-control" id="program_title" name="program_title" style="height: 100px"
                                        placeholder="Enter program title" required>{{ $programs->program_title }}</textarea>
                                    <div class="invalid-feedback">Missing program title</div>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="form_of_development" class=" font-weight-bold">Form of Development<span
                                            class="text-danger">*</span></label>
                                    <select id="form_of_development" name="form_of_development" class="others form-control"
                                        required>
                                        <option selected disabled value="">Select form of development</option>
                                        <option value="Local"
                                            {{ 'Local' == $programs->form_of_development ? 'selected' : '' }}>Local</option>
                                        <option value="National"
                                            {{ 'National' == $programs->form_of_development ? 'selected' : '' }}>National
                                        </option>
                                        <option value="International"
                                            {{ 'International' == $programs->form_of_development ? 'selected' : '' }}>
                                            International</option>
                                    </select>
                                    <div class="invalid-feedback">Missing form of development</div>
                                </div>

                                <div class="col-md-9 form-group">
                                    <label for="funding_agency" class=" font-weight-bold">Funding Agency<span
                                            class="text-danger">*</span></label>
                                    <select id="funding_agency" name="funding_agency" class="form-control agency" required>
                                        <option selected disabled value="">Choose Funding Agency / Source of Fund
                                        </option>
                                        @foreach ($agency as $key)
                                            <option value="{{ $key->abbrev }}"
                                                {{ $key->abbrev == $programs->funding_agency ? 'selected' : '' }}>
                                                {{ $key->agency_name }} -
                                                ({{ $key->abbrev }})
                                                </b></option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing Funding Agency / Source of Fund</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="program_leader" class=" font-weight-bold">Program Leader <span
                                            class="text-danger">*</span></label>
                                    <select id="program_leader" name="program_leader" class="form-control researchers"
                                        required>
                                        <option selected disabled value="">Select Researcher</option>
                                        @foreach ($researchers as $key)
                                            <option value="{{ $key->name }}"
                                                {{ $key->name == $programs->program_leader ? 'selected' : '' }}>
                                                {{ $key->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing program leader</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="assistant_leader" class=" font-weight-bold">Assistant Leader <span
                                            class="text-danger">*</span></label>
                                    <select id="assistant_leader" name="assistant_leader"
                                        class="form-control researchers" required>
                                        <option selected disabled value="">Select Researcher</option>
                                        @foreach ($researchers as $key)
                                            <option value="{{ $key->name }}"
                                                {{ $key->name == $programs->assistant_leader ? 'selected' : '' }}>
                                                {{ $key->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing Assistant Leader</div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="start_date" class=" font-weight-bold">Start Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="start_date" class="form-control"
                                        value="{{ $programs->start_date }}" id="start_date" required>
                                    <div class="invalid-feedback">Missing start date of the program</div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="end_date" class=" font-weight-bold">End Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" name="end_date" class="form-control"
                                        value="{{ $programs->end_date }}" id="end_date" required>
                                    <div class="invalid-feedback"> Missing end of the program</div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="extension_date" class=" font-weight-bold">Extension Date</label>
                                    <input type="date" name="extend_date" class="form-control"
                                        value="{{ $programs->extend_date }}" id="extension_date">
                                    <div class="valid-feedback"> There's no inputted extension date for this program</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="program_description" class=" font-weight-bold">Program Description<span
                                            class="text-danger">*</span></label></label>
                                    <textarea class="form-control" name="program_description" id="program_description" style="height: 100px"
                                        placeholder="Program brief description" required>{{ $programs->program_description }}</textarea>
                                    <div class="invalid-feedback">Missing program description</div>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="coordination_fund" class=" font-weight-bold">Coordination Fund<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="coordination_fund"
                                        value="{{ $programs->coordination_fund }}" class="form-control"
                                        id="coordination_fund" placeholder="Enter exact amount" required>
                                    <div class="invalid-feedback">Missing coordination fund</div>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="approved_budget" class="font-weight-bold">Approved Budget<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="approved_budget"
                                        value="{{ $programs->approved_budget }}" class="form-control"
                                        id="approved_budget" placeholder="Approved budget" required>
                                    <div class="invalid-feedback">Missing approved budget</div>
                                </div>

                                <div class="col-md-1 form-group">
                                    <label for="#year_of_release" class=" font-weight-bold">Budget Year<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="budget_year" value="{{ $programs->budget_year }}"
                                        class="form-control" id="budget_year" required placeholder="Ex. Year 1">
                                    <div class="invalid-feedback"> Missing budget year</div>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="year_of_release" class=" font-weight-bold">Amount Released<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="amount_released"
                                        value="{{ $programs->amount_released }}" class="form-control"
                                        id="year_of_release" placeholder="Enter exact amount" required>
                                    <div class="invalid-feedback">Missing</div>
                                </div>

                                @php
                                    $keywords = json_decode($programs->keywords);
                                    $keywords = implode($keywords);
                                @endphp
                                
                                <div class="col-md-12 form-group">
                                    <label for="" class=" font-weight-bold">Keywords</label>
                                    <input type="text" name="keywords[]" class="form-control js-recipients"
                                        placeholder="Keyword(s)" value="{{ $keywords }}" data-role="tagsinput"
                                        required>
                                    <div class="invalid-feedback">Missing Keywords</div>
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
            $('#programForm').on('submit', function(e) {

                var formData = new FormData(this);

                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('update-program/' . $programs->programID) }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Program Updated Successfully',
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
                            title: 'There is something wrong...',
                            timerProgressBar: false,
                            showConfirmButton: true,
                        });
                    }
                });
            });
        });
    </script>
@endsection
