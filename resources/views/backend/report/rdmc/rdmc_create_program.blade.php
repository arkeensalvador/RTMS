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
                                    <h2 class="font-weight-bold">Program</h2>
                                    <h5 class="mt-0"> Kindly fill-out the fields needed.</h5>
                                </div>

                                <div class="col-md-4 form-group" hidden>
                                    <label for="fund_code" class="font-weight-bold">System Generated Program ID <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control"
                                        value="<?= substr(md5(microtime()), 0, 10) ?>" readonly placeholder="Enter code"
                                        name="programID">
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">Missing programID</div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="fund_code" class="font-weight-bold">Fund Code<span
                                            class="text-danger"></span> (Optional)</label>
                                    <input type="text" name="fund_code" class="form-control" id="fund_code"
                                        placeholder="Input Trust Fund Code">
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="status" class="font-weight-bold">Status<span
                                            class="text-danger">*</span></label>
                                    <select id="status" name="program_status" class="form-control status" required>
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
                                    <select id="category" name="program_category" class="form-control others" required>
                                        <option selected disabled value="">Select the program category</option>
                                        <option value="Research">Research Category</option>
                                        <option value="Development">Development Category</option>
                                    </select>
                                    <div class="invalid-feedback">Missing program category</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="program_title" class=" font-weight-bold">Program Title<span
                                            class="text-danger">*</span></label></label>
                                    <textarea class="form-control" id="program_title" name="program_title" style="height: 100px"
                                        placeholder="Enter program title" required></textarea>
                                    <div class="invalid-feedback">Missing program title</div>
                                </div>

                                <div class="col-md-2 form-group">
                                    <label for="form_of_development" class=" font-weight-bold">Form of Development<span
                                            class="text-danger">*</span></label>
                                    <select id="form_of_development" name="form_of_development" class="others form-control"
                                        required>
                                        <option selected disabled value="">Select form of development</option>
                                        <option value="Local">Local</option>
                                        <option value="National">National</option>
                                        <option value="International">International</option>
                                    </select>
                                    <div class="invalid-feedback">Missing form of development</div>
                                </div>

                                <div class="col-md-10 form-group">
                                    <label for="funding_agency" class=" font-weight-bold">Funding Agency<span
                                            class="text-danger">*</span></label>
                                    <select id="funding_agency" name="funding_agency[]" multiple="multiple"
                                        class="form-control" required>
                                        @foreach ($agency as $key)
                                            <option value="{{ $key->abbrev }}">{{ $key->agency_name }} -
                                                ({{ $key->abbrev }})
                                                </b></option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing funding agency / source of fund</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="awards_recipients" class=" font-weight-bold">Implementing Agency<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control implementing_agency" id="awards_recipients"
                                        name="implementing_agency[]" multiple="multiple" required>

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
                                        name="collaborating_agency[]" multiple="multiple" required>

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
                                    <input type="text" name="research_center[]" id="rc"
                                        class="form-control research-center"
                                        placeholder="Research and Development Center(s)" data-role="tagsinput" required>
                                    <div class="invalid-feedback">Missing research center</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="program_leader" class=" font-weight-bold">Program Leader<span
                                            class="text-danger">*</span></label>
                                    <select id="program_leader" name="program_leader" class="form-control researchers"
                                        required>
                                        <option value=""></option>

                                        @foreach ($researchers as $key)
                                            <option value="{{ $key->id }}">
                                                {{ $key->first_name . ' ' . $key->middle_name . ' ' . $key->last_name }}
                                            </option>
                                        @endforeach

                                    </select>
                                    <div class="invalid-feedback">Missing program leader</div>
                                </div>


                                <div class="col-md-4 form-group">
                                    <label for="start_date" class=" font-weight-bold">Duration<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="duration" class="form-control date-range"
                                        id="start_date" placeholder="Start date" required>
                                    <div class="invalid-feedback">Missing duration of the program</div>
                                </div>


                                <div class="col-md-12 form-group">
                                    <label for="program_description" class=" font-weight-bold">Program Description<span
                                            class="text-danger">*</span></label></label>
                                    <textarea class="form-control" name="program_description" id="program_description" style="height: 100px"
                                        placeholder="Program brief description" required></textarea>
                                    <div class="invalid-feedback">Missing program description</div>
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
                                                <td><i class="fa-solid fa-square-plus fa-xl" onclick="addInput()"
                                                        style="color: #28a745; cursor: pointer; "></i></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control budget-input"
                                                        name="approved_budget[]" oninput="validateInput(this)" required>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control year-input"
                                                        name="budget_year[]" value="1" required readonly>
                                                </td>
                                                <td>
                                                    <i class="fa-solid fa-square-minus fa-lg"
                                                        style="color: #dc3545; margin-left: 1rem; margin-bottom:0px; cursor: pointer"
                                                        onclick="removeRow(this)"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div id="total-budget" hidden>Total Approved Budget: <span id="total">0</span>
                                    </div>
                                </div>


                                <div class="col-md-4 form-group">
                                    <label for="year_of_release" class=" font-weight-bold">Amount Released<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="amount_released" class="form-control"
                                        id="total_amount_released" placeholder="Enter exact amount" readonly>
                                    <div class="invalid-feedback">Missing amount released</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="" class=" font-weight-bold">Keywords</label>
                                    <input type="text" name="keywords[]" class="form-control js-recipients"
                                        placeholder="Keyword(s)" data-role="tagsinput" required>
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
                '<input type="text" class="form-control budget-input" oninput="validateInput(this)" name="approved_budget[]" required>';
            cell2.innerHTML =
                '<input type="text" class="form-control year-input" name="budget_year[]" required readonly>';
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
            removeButtons.forEach(function(button) {
                button.style.display = removeButtons.length > 1 ? 'block' : 'none';
            });
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                    url: "{{ url('add-programs') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        // this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: "Program added successfully!",
                            text: 'Are there any Project associated with this Program?',
                            showDenyButton: true,
                            showCloseButton: true,
                            confirmButtonText: 'Yes',
                            denyButtontext: 'No',
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            reverseButtons: true
                        }).then((result) => {
                            if (result.value) {
                                window.location.href = 'program-projects-add';
                            } else {
                                window.location.href = 'rdmc-programs';
                            }
                        });
                    },
                    error: function(data) {
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
