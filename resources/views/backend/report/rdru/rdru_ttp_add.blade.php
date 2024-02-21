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
                                    <h2 class="font-weight-bold">Technology Transfer Proposals</h2>
                                    <h5 class="mt-0"> Kindly fill-out the fields needed.</h5>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="customRadio1" class="font-weight-bold">Technology Classification<span
                                            class="text-danger">*</span></label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" value="Packaged"
                                            id="customRadio1" name="ttp_type" required>
                                        <label for="customRadio1" class="custom-control-label">Packaged</label>
                                    </div>
                                    <div class="invalid-feedback">Missing classification</div>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="customRadio2" class="font-weight-bold"></label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" value="Approved"
                                            id="customRadio2" name="ttp_type" required>
                                        <label for="customRadio2" class="custom-control-label">Approved/Implemented</label>
                                    </div>
                                    <div class="invalid-feedback">Missing classification</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="ttp_title" class=" font-weight-bold">Title<span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" name="ttp_title" id="ttp_title" rows="3" placeholder="Enter title"
                                        style="resize: none;" required></textarea>
                                    <div class="invalid-feedback">Missing title</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="ttp_sof" class=" font-weight-bold">Source of Fund<span
                                            class="text-danger">*</span></label>
                                    <select id="ttp_sof" name="ttp_sof[]" multiple class="form-control agency" required>
                                        <option value=""></option>
                                        @foreach ($agency as $row)
                                            <option value="{{ $row->abbrev }}"> {{ $row->agency_name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing source of fund</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="ttp_sof" class=" font-weight-bold">Proponent<span
                                            class="text-danger">*</span></label>
                                    <select id="" name="ttp_proponent[]" class="form-control r-agency" multiple
                                        required>
                                        <option value=""></option>
                                        @foreach ($agency as $row)
                                            <option value="{{ $row->abbrev }}"> {{ $row->agency_name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing proponent</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="ttp_sof" class=" font-weight-bold">Researchers<span
                                            class="text-danger">*</span></label>
                                    <select id="" name="ttp_researchers[]" class="form-control researchers"
                                        multiple="multiple" required>
                                        <option value=""></option>
                                        @foreach ($researchers as $key)
                                            <option
                                                value="{{ $key->first_name . ' ' . $key->middle_name . ' ' . $key->last_name }}">
                                                {{ $key->first_name . ' ' . $key->middle_name . ' ' . $key->last_name }}
                                                </b></option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing researchers</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="awards_recipients" class=" font-weight-bold">Implementing Agency<span
                                            class="text-danger">*</span></label>

                                    <select class="form-control implementing_agency" name="ttp_implementing_agency[]"
                                        multiple="multiple" required>

                                        @foreach ($agency as $key)
                                            <option value="{{ $key->abbrev }}">{{ $key->agency_name }} -
                                                ({{ $key->abbrev }})
                                                </b></option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing implementing agency</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="ttp_budget" class=" font-weight-bold">Proposed Budget<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="ttp_budget" id="ttp_budget"
                                        placeholder="Enter proposed budget" oninput="validateInput(this)" required>
                                    <div class="invalid-feedback">Missing budget</div>
                                </div>


                                <div class="col-md-3 form-group">
                                    <label for="ttp_start_date" class="font-weight-bold">Duration<span
                                            class="text-danger">*</span></label>

                                    <input type="number" name="ttp_date" id="ttp_date" class="form-control date-range"
                                        placeholder="Enter date" required>
                                    <div class="invalid-feedback">Missing duration</div>
                                </div>


                                <div class="col-md-12 form-group">
                                    <label for="ttp_priorities" class=" font-weight-bold">Regional Priorities
                                        Addressed<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="ttp_priorities" id="ttp_priorities" rows="3" placeholder="Enter ..."
                                        required></textarea>
                                    <div class="invalid-feedback"> Missing regional priorities addressed</div>
                                </div>

                                <div class="col-md-12 form-group buttons">
                                    <a href="{{ url('rdru-ttp') }}" class="btn btn-default">Back</a>
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
            $('.r-agency').select2({
                placeholder: 'Select Agency'
            });

            // $('#agencySelect').on('change', function() {
            //     var agencyId = $(this).val();
            //     if (agencyId) {
            //         $.ajax({
            //             url: '/get-researchers',
            //             type: 'GET',
            //             data: {
            //                 agency_id: agencyId
            //             },
            //             success: function(data) {
            //                 $('#researcherSelect').empty();
            //                 $('#researcherSelect').append(
            //                     '<option value="">Select a Researcher</option>'
            //                 );
            //                 data.forEach(function(researcher) {
            //                     $('#researcherSelect').append($('<option>', {
            //                         value: researcher.name,
            //                         text: researcher.name
            //                     }));
            //                 });
            //                 $('#researcherSelect').select2({
            //                     placeholder: "Select researchers"
            //                 });
            //             }
            //         });
            //     } else {
            //         $('#researcherSelect').empty();
            //         $('#researcherSelect').append(
            //             '<option value="">Select a Researcher</option>');
            //         $('#researcherSelect').select2();
            //     }
            // });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#ttp_title, #ttp_budget, #ttp_sof, #ttp_start_date, #ttp_end_date, #ttp_priorities')
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

        document.getElementById('techForm').addEventListener('submit', function(event) {
            const startDate = document.getElementById('ttp_start_date').value;
            const endDate = document.getElementById('ttp_end_date').value;
            if (!endDate) {
                event.preventDefault();
                document.getElementById('ttp_end_date').classList.add('is-invalid');
            }
            if (!startDate) {
                event.preventDefault();
                document.getElementById('ttp_start_date').classList.add('is-invalid');
            }
            if (!startDate && !endDate) {
                event.preventDefault();
                document.getElementById('ttp_start_date').classList.add('is-invalid');
                document.getElementById('ttp_end_date').classList.add('is-invalid');
            }
        });

        $(document).ready(function() {
            $('#techForm').on('submit', function(e) {

                var formData = new FormData(this);

                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('add-ttp') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        // this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'TTP Added Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        }).then((result) => {
                            if (result.dismiss) {
                                window.location.href = '/rdru-ttp';
                            }
                        })
                    },
                    error: function(data) {
                        // Swal.fire({
                        //     icon: 'warning',
                        //     title: data.responseJSON.message,
                        //     // title: 'There is something wrong...',
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
