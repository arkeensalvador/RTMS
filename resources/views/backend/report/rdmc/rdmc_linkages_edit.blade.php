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
                                    <h2 class="font-weight-bold">Linkages</h2>
                                    <h5 class="mt-0"> Kindly fill-out the fields needed.</h5>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="awards_type" class=" font-weight-bold">Type<span
                                            class="text-danger">*</span></label>

                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" value="Developed" name="type"
                                            value="Developed" id="customRadio1"
                                            {{ 'Developed' == $all->type ? 'checked' : '' }}>
                                        <label for="customRadio1" class="custom-control-label"
                                            style="font-weight: bold;">Developed</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" value="Maintained" name="type"
                                            id="customRadio2" {{ 'Maintained' == $all->type ? 'checked' : '' }}>
                                        <label for="customRadio2" class="custom-control-label"
                                            style="font-weight: bold;">Maintained/Sustained</label>
                                    </div>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="form_of_development" class=" font-weight-bold">Agency/Institution<span
                                            class="text-danger">*</span></label>
                                    <select id="form_of_development" name="form_of_development"
                                        class="form-control formtype" required>
                                        <option value=""></option>
                                        <option value="Local" {{ 'Local' == $all->form_of_development ? 'selected' : '' }}>
                                            Local
                                        </option>
                                        <option value="National"
                                            {{ 'National' == $all->form_of_development ? 'selected' : '' }}>National
                                        </option>
                                        <option value="International"
                                            {{ 'International' == $all->form_of_development ? 'selected' : '' }}>
                                            International</option>
                                    </select>
                                    <div class="invalid-feedback">Missing Agency/Institution type</div>
                                </div>

                                <div class="col-md-2 form-group">
                                    <label for="year" class=" font-weight-bold">Year<span
                                            class="text-danger">*</span></label>

                                    <input type="text" name="year" id="year" value="{{ $all->year }}"
                                        class="form-control year" placeholder="Year" required>
                                    <div class="invalid-feedback">Missing year</div>
                                </div>


                                <div class="col-md-7 form-group">
                                    <label for="address" class=" font-weight-bold">Address<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="address" name="address" value="{{ $all->address }}"
                                        class="form-control" placeholder="Source of fund" required>
                                    <div class="invalid-feedback">Missing address</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="nature_of_assistance" class=" font-weight-bold">Nature of
                                        Assistance/Linkages/Projects<span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="nature_of_assistance" rows="3" placeholder="Enter ..." style="resize: none;"
                                        required>{{ $all->nature_of_assistance }}</textarea>
                                    <div class="invalid-feedback">Missing nature of assistance</div>
                                </div>


                                <div class="col-md-12 form-group buttons">
                                    <a href="{{ url('rdmc-linkages-index') }}" class="btn btn-default">Back</a>
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
                    url: "{{ url('update-linkages/' . $all->id) }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        // this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Linkages Updated Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        }).then((result) => {
                            if (result.dismiss) {
                                window.location.href = '/rdmc-linkages-index';
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
