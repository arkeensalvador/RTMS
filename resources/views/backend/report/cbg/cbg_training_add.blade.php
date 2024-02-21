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
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="d-flex justify-content-center mt-3">
                            <form id="techForm" class="row g-3 needs-validation" novalidate>
                                @csrf
                                <div class="form-title col-12">
                                    <h2 class="font-weight-bold">Trainings / Workshops</h2>
                                    <h5 class="mt-0"> Kindly fill-out the fields needed.</h5>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="coordination_fund" class="font-weight-bold">Participants<span
                                            class="text-danger">*</span></label>
                                    <table id="participants-table" class="table">
                                        <thead>
                                            <tr>
                                                <th>Type of Participant</th>
                                                <th>No. of Participants</th>
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
                                                    <input type="text" class="form-control" name="type_of_participants[]"
                                                        placeholder="Enter type of participants" required>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="no_of_participants[]"
                                                        placeholder="Enter no. of participants" required>
                                                </td>
                                                <td>
                                                    <i class="fa-solid fa-square-minus fa-lg"
                                                        style="color: #dc3545; margin-left: 1rem; margin-bottom:0px; cursor: pointer"
                                                        onclick="removeRow(this)"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="trainings_sof" class=" font-weight-bold">Source of Funds<span
                                            class="text-danger">*</span></label>
                                    <select id="trainings_sof" name="trainings_sof[]" multiple class="form-control agency"
                                        required>
                                        @foreach ($agency as $row)
                                            <option value="{{ $row->abbrev }}"> {{ $row->agency_name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing source of funds</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="trainings_agency" class=" font-weight-bold">Implementing Agency<span
                                            class="text-danger">*</span></label>
                                    <select id="trainings_agency" name="trainings_agency[]" multiple
                                        class="form-control agency" required>
                                        <option value=""></option>
                                        @foreach ($agency as $row)
                                            <option value="{{ $row->abbrev }}"> {{ $row->agency_name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing implementing agency</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="" class=" font-weight-bold">Research and Development Center
                                        (Optional)</label>
                                    <input type="text" name="trainings_research_center[]" id="rc"
                                        class="form-control research-center" placeholder="R&D Center(s)" value=""
                                        data-role="tagsinput">
                                </div>



                                <div class="col-md-12 form-group">
                                    <label for="trainings_title" class=" font-weight-bold">Title of Activity/Training<span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" name="trainings_title" id="trainings_title" rows="3"
                                        placeholder="Enter activity/training title" style="resize: none;" required></textarea>
                                    <div class="invalid-feedback">Missing title</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="trainings_expenditures" class=" font-weight-bold">Expenditures<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="trainings_expenditures"
                                        id="trainings_expenditures" placeholder="Enter expenditures"
                                        oninput="validateInput(this)" required>
                                    <div class="invalid-feedback">Missing expenditures</div>
                                </div>


                                <div class="col-md-6 form-group">
                                    <label for="trainings_start" class=" font-weight-bold">Activity/Training Duration<span
                                            class="text-danger">*</span></label>

                                    <input type="number" name="trainings_start" id="trainings_start"
                                        class="form-control date-range" placeholder="Enter duration" required>
                                    <div class="invalid-feedback">Missing activity/training duration</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="trainings_no_participants" class=" font-weight-bold">Venue<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="trainings_venue" class="form-control" id="trainings_venue"
                                        placeholder="Venue" required>
                                    <div class="invalid-feedback"> Missing venue</div>
                                </div>

                                <div class="col-md-12 form-group buttons">
                                    <a href="{{ url('cbg-training') }}" class="btn btn-default">Back</a>
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
        function addInput() {
            var table = document.getElementById('participants-table').getElementsByTagName('tbody')[0];
            var newRow = table.insertRow(table.rows.length);
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);

            cell1.innerHTML =
                '<input type="text" class="form-control" placeholder="Enter type of participants"  name="type_of_participants[]" required>';
            cell2.innerHTML =
                '<input type="text" class="form-control" placeholder="Enter no. of participants" name="no_of_participants[]" required>';
            cell3.innerHTML =
                '<i class="fa-solid fa-square-minus fa-lg" style="color: #dc3545; margin-left: 1rem; margin-bottom:0px; cursor: pointer" onclick="removeRow(this)"></i>';

            // Hide "Remove" button if there is only one row
            updateRemoveButtons();
        }

        function removeRow(button) {
            var row = button.parentNode.parentNode;
            row.parentNode.removeChild(row);
            // Hide "Remove" button if there is only one row
            updateRemoveButtons();
        }

        function updateRemoveButtons() {
            var removeButtons = document.querySelectorAll('#participants-table tbody tr i.fa-square-minus');
            removeButtons.forEach(function(button) {
                button.style.display = removeButtons.length > 1 ? 'block' : 'none';
            });
        }

        function validateInput(input) {
            // Remove non-numeric characters (except '-')
            let numericValue = input.value.replace(/[^\d-]/g, '');

            // Ensure the input is not empty
            if (numericValue === '-') {
                numericValue = '';
            }

            // Format the numeric value with commas
            const formattedValue = formatNumberWithCommas(numericValue);

            // Set the formatted value back to the input
            input.value = formattedValue;
        }

        function formatNumberWithCommas(number) {
            // Convert the number to a string and add commas
            return parseFloat(number).toLocaleString('en-US');
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#trainings_sof, #trainings_agency, #trainings_title, #trainings_start, #trainings_end, #trainings_title, #trainings_venue')
                .on('input', function() {
                    const inputField = $(this);
                    if (inputField[0].checkValidity()) {
                        inputField.addClass('is-valid').removeClass('is-invalid');
                    } else {
                        inputField.addClass('is-invalid').removeClass('is-valid');
                    }
                });
        });


        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                            //Swal.fire({
                            //                                icon: 'info',
                            //                                title: 'All //fields are required',
                            //timerProgressBar: false,
                            //showConfirmButton: true,
                            //                        });
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        document.getElementById('techForm').addEventListener('submit', function(event) {
            const startDate = document.getElementById('trainings_start').value;
            const endDate = document.getElementById('trainings_end').value;
            if (!endDate) {
                event.preventDefault();
                document.getElementById('trainings_end').classList.add('is-invalid');
            }
            if (!startDate) {
                event.preventDefault();
                document.getElementById('trainings_start').classList.add('is-invalid');
            }
            if (!startDate && !endDate) {
                event.preventDefault();
                document.getElementById('trainings_start').classList.add('is-invalid');
                document.getElementById('trainings_end').classList.add('is-invalid');
            }
        });

        $(document).ready(function() {
            $('#techForm').on('submit', function(e) {

                var formData = new FormData(this);

                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('add-training') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        // this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Training Added Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        }).then((result) => {
                            if (result.dismiss) {
                                window.location.href = '/cbg-training';
                            }
                        })
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'error',
                            toast: true,
                            iconColor: 'white',
                            position: 'top-end',
                            // customClass: {
                            //     popup: 'colored-toast',
                            // },
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
