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
                                    <h2 class="font-weight-bold">Database & Information System</h2>
                                    <h5 class="mt-0"> Kindly fill-out the fields needed.</h5>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="awards_type" class=" font-weight-bold">Category<span
                                            class="text-danger">*</span></label>

                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" required value="Database"
                                            name="dbinfosys_category" id="customRadio1"
                                            {{ 'Database' == $all->dbinfosys_category ? 'checked' : '' }}>
                                        <label for="customRadio1" class="custom-control-label"
                                            style="font-weight: bold;">Database</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" required
                                            value="Information System" name="dbinfosys_category" id="customRadio2"
                                            {{ 'Information System' == $all->dbinfosys_category ? 'checked' : '' }}>
                                        <label for="customRadio2" class="custom-control-label"
                                            style="font-weight: bold;">Information System</label>
                                    </div>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="equipments_sof" class=" font-weight-bold">Type<span
                                            class="text-danger">*</span></label>
                                    <select name="dbinfosys_type" id="dbinfosys_type" class="form-control type" required>
                                        <option value=""></option>
                                        <option value="Developed"
                                            {{ 'Developed' == $all->dbinfosys_type ? 'selected' : '' }}>Developed</option>
                                        <option value="Enhanced" {{ 'Enhanced' == $all->dbinfosys_type ? 'selected' : '' }}>
                                            Enhanced</option>
                                        <option value="Maintained"
                                            {{ 'Maintained' == $all->dbinfosys_type ? 'selected' : '' }}>Maintained</option>
                                        <option value="Research" {{ 'Research' == $all->dbinfosys_type ? 'selected' : '' }}>
                                            Research</option>
                                    </select>
                                    <div class="invalid-feedback">Missing type</div>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="dbinfosys_date_created" class="font-weight-bold">Date<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="dbinfosys_date_created"
                                        value="{{ $all->dbinfosys_date_created }}" id="dbinfosys_date_created"
                                        class="form-control date" placeholder="Enter" required>
                                    <div class="invalid-feedback">Missing date</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="dbinfosys_title" class=" font-weight-bold">Title<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="dbinfosys_title" value="{{ $all->dbinfosys_title }}"
                                        id="dbinfosys_title" class="form-control" placeholder="Enter title" required>
                                    <div class="invalid-feedback">Missing title</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="dbinfosys_purpose" class=" font-weight-bold">Purpose<span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" name="dbinfosys_purpose" id="dbinfosys_purpose" rows="2" placeholder="Enter ..."
                                        style="resize: none;" required>{{ $all->dbinfosys_purpose }}</textarea>
                                    <div class="invalid-feedback">Missing purpose</div>
                                </div>

                                <div class="col-md-12 form-group buttons">
                                    <a href="{{ url('rdmc-dbinfosys-index') }}" class="btn btn-default">Back</a>
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
            $('#equipments_agency, #equipments_sof, #dbinfosys_title, #dbinfosys_date_created, #dbinfosys_purpose')
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
            const startDate = document.getElementById('dbinfosys_date_created').value;
            const endDate = document.getElementById('dbinfosys_date_created').value;
            if (!endDate) {
                event.preventDefault();
                document.getElementById('dbinfosys_date_created').classList.add('is-invalid');
            }
            if (!startDate) {
                event.preventDefault();
                document.getElementById('dbinfosys_date_created').classList.add('is-invalid');
            }
            if (!startDate && !endDate) {
                event.preventDefault();
                document.getElementById('dbinfosys_date_created').classList.add('is-invalid');
                document.getElementById('dbinfosys_date_created').classList.add('is-invalid');
            }
        });

        $(document).ready(function() {
            $('#techForm').on('submit', function(e) {

                var formData = new FormData(this);

                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('update-dbinfosys/' . $all->id) }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        // this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'DBIS Updated Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        }).then((result) => {
                            if (result.dismiss) {
                                window.location.href = '/rdmc-dbinfosys-index';
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
