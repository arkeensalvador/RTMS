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
                                    <h2 class="font-weight-bold">Researcher</h2>
                                    <h5 class="mt-0">Kindly fill-out the fields needed.</h5>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="fname" class=" font-weight-bold">Name<span
                                            class="text-danger">*</span></label>
                                    <div class="row g-3">
                                        <div class="col-sm-4">
                                            <input type="text" name="fname" id="fname" class="form-control"
                                                placeholder="First name" required>
                                            <div class="invalid-feedback">Missing first name</div>
                                        </div>

                                        <div class="col-sm-4">
                                            <input type="text" name="mname" id="mname" class="form-control"
                                                placeholder="Middle name" required>
                                            <div class="invalid-feedback">Missing middle name</div>
                                        </div>

                                        <div class="col-sm-4">
                                            <input type="text" name="lname" id="lname" class="form-control"
                                                placeholder="Last name" required>
                                            <div class="invalid-feedback">Missing last name</div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="agency" class=" font-weight-bold">Agency<span
                                            class="text-danger">*</span></label>
                                    <select id="agency" name="agency" class="form-control agency" required>
                                        <option value=""></option>
                                        @foreach ($agency as $row)
                                            <option value="{{ $row->abbrev }}"> {{ $row->agency_name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing agency</div>
                                </div>


                                <div class="col-md-6 form-group">
                                    <label for="sex" class=" font-weight-bold">Sex<span
                                            class="text-danger">*</span></label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sex" value="Male"
                                            required /> Male
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sex" value="Female"
                                            required />
                                        Female
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sex"
                                            value="Prefer not to say" required />
                                        Prefer not to say
                                    </div>
                                    <div class="invalid-feedback">Missing sex</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="emp_status" class="font-weight-bold">Employment Status<span
                                            class="text-danger">*</span></label>
                                    <select id="emp_status" name="emp_status" class="form-control others" required>
                                        <option value=""></option>
                                        <option value="Contractual">Contractual</option>
                                        <option value="JO">Job Order</option>
                                        <option value="Project">Project Based</option>
                                        <option value="Regular">Regular</option>
                                    </select>
                                    <div class="invalid-feedback">Missing employment status</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="email" class=" font-weight-bold">Email Address<span
                                            class="text-danger">*</span></label>

                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Email address" required>
                                    <div class="invalid-feedback">Missing email address</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="contact" class=" font-weight-bold">Phone No.<span
                                            class="text-danger">*</span></label>

                                    <input type="text" name="contact" id="contact" oninput="validateInput(this)"
                                        class="form-control" placeholder="Phone no." maxlength="11" required>
                                    <div class="invalid-feedback">Missing phone number</div>
                                </div>


                                <div class="col-md-12 form-group buttons">
                                    <a href="{{ url('researcher-index') }}" class="btn btn-default">Back</a>
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
            input.value = input.value.replace(/[^\d-]/g, '');

            // Ensure the input is not empty
            if (input.value === '-') {
                input.value = '';
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#fname, #mname, #lname, #email, #sex, #contact, #agency')
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

        $(document).ready(function() {
            $('#techForm').on('submit', function(e) {

                var formData = new FormData(this);

                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('add-researcher') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        // this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Researcher Added Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        }).then((result) => {
                            if (result.dismiss) {
                                window.location.href = '/researcher-index';
                            }
                        })
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
