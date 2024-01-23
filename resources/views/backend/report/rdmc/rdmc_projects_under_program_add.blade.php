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
                                    <h5 class="mt-0"> Kindly fill-out the fields needed.</h5>
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
                                    <label for="fund_code" class="font-weight-bold">Fund Code (Optional)</label>
                                    <input type="text" name="project_fund_code" class="form-control" id="fund_code"
                                        placeholder="Input Trust Fund Code">
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="status" class="font-weight-bold">Status<span
                                            class="text-danger">*</span></label>
                                    <select id="status" name="project_status" class="form-control status" required>
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

                                <div class="col-md-12 form-group">
                                    <label for="program_description" class=" font-weight-bold">Project
                                        Description<span class="text-danger">*</span></label></label>
                                    <textarea class="form-control" name="project_description" id="program_description" style="height: 100px"
                                        placeholder="Project brief description" required></textarea>
                                    <div class="invalid-feedback">Missing project description</div>
                                </div>

                                <div class="col-md-4 form-group">
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

                                <div class="col-md-4 form-group">
                                    <label for="start_date" class=" font-weight-bold">Duration<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="project_duration" placeholder="Enter project duration"
                                        class="form-control date-range" id="project_duration" required>
                                    <div class="invalid-feedback">Missing duration</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="program_leader" class=" font-weight-bold">Project Leader <span
                                            class="text-danger">*</span></label>
                                    <select id="program_leader" name="project_leader" class="form-control researchers"
                                        required>
                                        <option selected disabled value="">Select Researcher</option>
                                        @foreach ($researchers as $key)
                                            <option value="{{ $key->id }}">
                                                {{ $key->first_name . ' ' . $key->middle_name . ' ' . $key->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing project leader</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="funding_agency" class=" font-weight-bold">Funding Agency<span
                                            class="text-danger">*</span></label>
                                    <select id="funding_agency" name="project_agency[]" multiple
                                        class="form-control agency" required>
                                        <option value=""></option>
                                        @foreach ($agency as $key)
                                            <option value="{{ $key->abbrev }}">{{ $key->agency_name }} -
                                                ({{ $key->abbrev }})
                                                </b></option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing Funding Agency / Source of Fund</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="awards_recipients" class=" font-weight-bold">Implementing Agency<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control implementing_agency" id="awards_recipients"
                                        name="project_implementing_agency[]" multiple="multiple" required>
                                        @foreach ($agency as $key)
                                            <option value="{{ $key->abbrev }}">{{ $key->agency_name }} -
                                                ({{ $key->abbrev }})
                                                </b></option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing implementing agency</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="awards_recipients" class=" font-weight-bold">Collaborating Agency<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control collaborating_agency" id=""
                                        name="project_collaborating_agency[]" multiple="multiple" required>

                                        @foreach ($agency as $key)
                                            <option value="{{ $key->abbrev }}">{{ $key->agency_name }} -
                                                ({{ $key->abbrev }})
                                                </b></option>
                                        @endforeach

                                    </select>
                                    <div class="invalid-feedback">Missing collaborating agency</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="" class=" font-weight-bold">Research and Development Center<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="project_research_center[]" id="rc"
                                        class="form-control research-center"
                                        placeholder="Research and Development Center(s)" value=""
                                        data-role="tagsinput" required>
                                    <div class="invalid-feedback">Missing research center</div>
                                </div>



                                <div class="col-md-3 form-group">
                                    <label for="coordination_fund" class=" font-weight-bold">Type of Funding
                                        Grant<span class="text-danger">*</span></label>
                                    <select id="" name="project_funding_grant" class="others form-control"
                                        required>
                                        <option value="">Select Funding Grant</option>
                                        <option value="One-time">One-time Grant</option>
                                        <option value="Multi-year">Multi-year Grant</option>
                                    </select>

                                    <div class="invalid-feedback">Missing funding grant</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="coordination_fund" class="font-weight-bold">Budget<span
                                            class="text-danger">*</span></label>
                                    <table id="budget-table" class="table">
                                        <thead>
                                            <tr>
                                                <th>Approved Budget</th>
                                                <th>Year No.</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <i class="fa-solid fa-square-plus fa-xl" onclick="addInput()"
                                                        style="color: #28a745; cursor: pointer;"></i>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control budget-input"
                                                        style="margin-bottom: 5px;" name="approved_budget[]"
                                                        oninput="validateInput(this)" placeholder="Enter budget" required>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control year-input"
                                                        style="margin-bottom: 5px;" name="budget_year[]" value="1"
                                                        required readonly>
                                                </td>
                                                <td class="budget-action">
                                                    <i class="fa-solid fa-square-minus fa-lg"
                                                        style="color: #dc3545; margin-left: 1rem; margin-bottom:0px; cursor: pointer"
                                                        onclick="removeRow(this)"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div id="total-budget" hidden>Total Approved Budget: <span id="total">0</span>
                                    </div>
                                    <div class="col-md-4 form-group" id="amountReleased">
                                        <label for="year_of_release" class=" font-weight-bold">Total Amount Released<span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="project_amount_released" class="form-control"
                                            id="total_amount_released" placeholder="0" readonly>
                                        <div class="invalid-feedback">Missing amount released</div>
                                    </div>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initial check for remove buttons
            updateRemoveButtons();
        });

        function addInput() {
            var table = document.getElementById('budget-table').getElementsByTagName('tbody')[0];
            var newRow = table.insertRow(table.rows.length);
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);

            cell1.innerHTML =
                '<input type="text" style="margin-bottom: 5px;" class="form-control budget-input" oninput="validateInput(this)" placeholder="Enter budget" name="approved_budget[]" required>';
            cell2.innerHTML =
                '<input type="text" style="margin-bottom: 5px;" class="form-control year-input" name="budget_year[]" required readonly>';
            cell3.innerHTML =
                '<i class="fa-solid fa-square-minus fa-lg" style="color: #dc3545; margin-left: 1rem; margin-bottom:0px; cursor: pointer" onclick="removeRow(this)"></i>';

            // Increment the year for each new row added
            var lastYearInput = document.getElementsByClassName('year-input')[document.getElementsByClassName('year-input')
                .length - 2];
            var newYearInput = document.getElementsByClassName('year-input')[document.getElementsByClassName('year-input')
                .length - 1];
            var lastYear = parseInt(lastYearInput.value) || 0;

            // Start incrementing from 2 for subsequent inputs
            newYearInput.value = lastYear === 1 ? 2 : lastYear + 1;

            // Recalculate the total when an input is removed
            calculateTotal();
            // Hide "Remove" button if there is only one row
            updateRemoveButtons();
        }

        function removeRow(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);

            // Recalculate the total when an input is removed
            calculateTotal();
            // Hide "Remove" button if there is only one row
            updateRemoveButtons();
        }



        function validateInput(input) {
            // Remove non-numeric characters (except '-')
            input.value = input.value.replace(/[^\d-]/g, '');

            // Ensure the input is not empty
            if (input.value === '-') {
                input.value = '';
            }

            // Recalculate the total when the input changes
            calculateTotal();
        }

        function calculateTotal() {
            var budgetInputs = document.getElementsByClassName('budget-input');
            var total = 0;

            for (var i = 0; i < budgetInputs.length; i++) {
                var value = parseFloat(budgetInputs[i].value) || 0;
                total += value;
            }

            // Update the total displayed in the HTML
            document.getElementById('total').textContent = total;
            document.getElementById('total_amount_released').value = total;

            // Hide "Remove" button if there is only one row
            updateRemoveButtons();
        }

        function updateRemoveButtons() {
            var removeButtons = document.querySelectorAll('#budget-table tbody tr i.fa-square-minus');

            removeButtons.forEach(function(button, index) {
                // Hide "Remove" button if there is only one row or it's the first row
                button.style.display = (removeButtons.length > 1 && index > 0) ? 'block' : 'none';
            });
        }
    </script>
    <script>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        document.getElementById('approved_budget').addEventListener('keyup', function() {
            var value = this.value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
            document.getElementById('amount_released').value = value;
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
                            // Swal.fire({
                            //     icon: 'info',
                            //     title: 'All fields are required',
                            //     timerProgressBar: false,
                            //     showConfirmButton: true,
                            // });
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
                        // this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Project Added Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        }).then((result) => {
                            if (result.dismiss) {
                                window.location.href = '/rdmc-projects';
                            }
                        })

                    },
                    error: function(data) {
                        // Swal.fire({
                        //     icon: 'warning',
                        //     title: data.responseJSON.message,
                        //     // title: "There's something wrong...",
                        //     timerProgressBar: false,
                        //     showConfirmButton: true,
                        // });
                        Swal.fire({
                            icon: 'error',
                            toast: true,
                            iconColor: 'white',
                            position: 'top-end',
                            customClass: {
                                popup: 'colored-toast',
                            },
                            // title: data.responseJSON.message,
                            text: data.responseJSON.message,
                            // title: 'There is something wrong...',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                });
            });
        });
    </script>
@endsection
