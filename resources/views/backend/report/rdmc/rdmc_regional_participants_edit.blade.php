@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="d-flex mt-3">
                            <form id="techForm" class="row g-3 needs-validation" novalidate>
                                @csrf
                                <div class="form-title col-12">
                                    <h2 class="font-weight-bold">Participants of Regional Symposium Highlights</h2>
                                    <h5 class="mt-0">Kindly fill-out the fields needed.</h5>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="coordination_fund" class="font-weight-bold">Participants<span
                                            class="text-danger">*</span></label>
                                    <table id="participants-table" class="table">
                                        <thead>
                                            <tr>
                                                <th>Type of Participant <span data-toggle="tooltip" data-placement="right"
                                                        title="GO, NGO, Private Sector, or LGU">
                                                        <i class="fas fa-question-circle" style="cursor: pointer;"></i>
                                                    </span></th>
                                                <th>No. of Participants</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><i class="fa-solid fa-square-plus fa-xl" onclick="addInput()"
                                                        style="color: #28a745; cursor: pointer; "></i></td>
                                            </tr>
                                            @foreach ($participantsData as $key => $data)
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control"
                                                            name="type_of_participants[]"
                                                            placeholder="Enter type of participants"
                                                            value="{{ $data->type_of_participants }}" required>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-control"
                                                            name="no_of_participants[]"
                                                            placeholder="Enter no. of participants"
                                                            value="{{ $data->no_of_participants }}" required>
                                                    </td>
                                                    <td>
                                                        <a href="{{ URL::to('/delete-symposium-participant/' . $data->id) }}"
                                                            class="btn btn-danger" id="delete"
                                                            style="margin-left: 5px"><i class="fa-solid fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="awards_recipients" class=" font-weight-bold">Agency<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control agency" id="awards_recipients" name="rp_agency" required>
                                        <option value=""></option>
                                        @foreach ($agency as $key)
                                            <option value="{{ $key->abbrev }}"
                                                {{ $key->abbrev == $all->rp_agency ? 'selected' : '' }}>
                                                {{ $key->agency_name }} -
                                                ({{ $key->abbrev }})
                                                </b></option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing agency</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="program_title" class=" font-weight-bold">Remarks<span
                                            class="text-danger">*</span></label></label>
                                    <textarea class="form-control" id="program_title" name="rp_remarks" style="height: 100px" placeholder="Enter remarks"
                                        required>{{ $all->rp_remarks }}</textarea>
                                    <div class="invalid-feedback">Missing remarks</div>
                                </div>

                                <div class="col-md-4 form-group float-right">
                                    <a href="{{ url('rdmc-regional-participants') }}" class="btn btn-default">Back</a>
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
        function addInput() {
            var table = document.getElementById('participants-table').getElementsByTagName('tbody')[0];
            var newRow = table.insertRow(table.rows.length);
            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);

            cell1.innerHTML =
                '<input type="text" class="form-control" placeholder="Enter type of participants"  name="new_type_of_participants[]" required>';
            cell2.innerHTML =
                '<input type="text" class="form-control" placeholder="Enter no. of participants" name="new_no_of_participants[]" required>';
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

        // function updateRemoveButtons() {
        //     var removeButtons = document.querySelectorAll('#participants-table tbody tr i.fa-square-minus');
        //     removeButtons.forEach(function(button) {
        //         button.style.display = removeButtons.length > 1 ? 'block' : 'none';
        //     });
        // }

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
        $(document).ready(function() {
            $('#form_of_development, #address, #year')
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
                            Swal.fire({
                                icon: 'info',
                                // toast: true,
                                // position: 'top-right',
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

        document.getElementById('techForm').addEventListener('submit', function(event) {
            const startDate = document.getElementById('year').value;
            const endDate = document.getElementById('year').value;
            if (!endDate) {
                event.preventDefault();
                document.getElementById('form_of_development').classList.add('is-invalid');
            }
            if (!startDate) {
                event.preventDefault();
                document.getElementById('year').classList.add('is-invalid');
            }
            if (!startDate && !endDate) {
                event.preventDefault();
                document.getElementById('year').classList.add('is-invalid');
                document.getElementById('form_of_development').classList.add('is-invalid');
            }
        });

        $(document).ready(function() {
            $('#techForm').on('submit', function(e) {

                var formData = new FormData(this);

                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('update-regional-participants/' . $all->id) }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        // // this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Updated Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        }).then((result) => {
                            if (result.dismiss) {
                                window.location.href = '/rdmc-regional-participants';
                            }
                        })
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'warning',
                            title: data.responseJSON.message,
                            // title: 'There is something wrong...',
                            timerProgressBar: false,
                            showConfirmButton: true,
                        });
                    }
                });
            });
        });
    </script>
@endsection
