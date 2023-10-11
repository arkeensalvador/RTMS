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
                                    <h2 class="font-weight-bold">Equipment and Facilities</h2>
                                    <h5 class="mt-0"> Kindly fill-up the fields needed.</h5>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="awards_type" class=" font-weight-bold">Equipment Type<span
                                            class="text-danger">*</span></label>

                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" value="Endorsed"
                                            name="equipments_type" id="customRadio1"
                                            {{ 'Endorsed' == $all->equipments_type ? 'checked' : '' }}>
                                        <label for="customRadio1" class="custom-control-label"
                                            style="font-weight: bold;">Endorsed</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" value="Approved"
                                            name="equipments_type" id="customRadio2"
                                            {{ 'Approved' == $all->equipments_type ? 'checked' : '' }}>
                                        <label for="customRadio2" class="custom-control-label"
                                            style="font-weight: bold;">Approved</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" value="Upgraded"
                                            name="equipments_type" id="customRadio3"
                                            {{ 'Upgraded' == $all->equipments_type ? 'checked' : '' }}>
                                        <label for="customRadio3" class="custom-control-label"
                                            style="font-weight: bold;">Facilities Upgraded</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" value="Established"
                                            name="equipments_type" id="customRadio4"
                                            {{ 'Established' == $all->equipments_type ? 'checked' : '' }}>
                                        <label for="customRadio4" class="custom-control-label"
                                            style="font-weight: bold;">Facilities Established</label>
                                    </div>

                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" value="Purchased"
                                            name="equipments_type" id="customRadio5"
                                            {{ 'Purchased' == $all->equipments_type ? 'checked' : '' }}>
                                        <label for="customRadio5" class="custom-control-label"
                                            style="font-weight: bold;">Facilities Purchased</label>
                                    </div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="equipments_name" class=" font-weight-bold">Equipment Name<span
                                            class="text-danger">*</span></label>

                                    <input type="text" name="equipments_name" value="{{ $all->equipments_name }}"
                                        id="equipments_name" class="form-control" placeholder="Equipment name" required>
                                    <div class="invalid-feedback">Missing name</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="equipments_total" class=" font-weight-bold">Expenditures<span
                                            class="text-danger">*</span></label>

                                    <input type="text" name="equipments_total" value="{{ $all->equipments_total }}"
                                        id="equipments_total" class="form-control" placeholder="Expenditures" required>
                                    <div class="invalid-feedback">Missing expenditures</div>
                                </div>


                                <div class="col-md-6 form-group">
                                    <label for="equipments_sof" class=" font-weight-bold">Source of Fund<span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="equipments_sof" value="{{ $all->equipments_sof }}"
                                        name="equipments_sof" class="form-control" placeholder="Source of fund" required>
                                    <div class="invalid-feedback">Missing source of fund</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="equipments_agency" class=" font-weight-bold">Agency<span
                                            class="text-danger">*</span></label>
                                    <select id="equipments_agency" name="equipments_agency" class="form-control agency"
                                        required>
                                        <option value=""></option>
                                        @foreach ($agency as $row)
                                            <option value="{{ $row->abbrev }}"
                                                {{ $row->abbrev == $all->equipments_agency ? 'selected' : '' }}>
                                                {{ $row->agency_name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing agency</div>
                                </div>


                                <div class="col-md-12 form-group buttons">
                                    <a href="{{ url('cbg-awards') }}" class="btn btn-default">Back</a>
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
            $('#equipments_agency, #equipments_sof, #equipments_total, #equipments_name')
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
            const startDate = document.getElementById('awards_date').value;
            const endDate = document.getElementById('awards_recipients').value;
            if (!endDate) {
                event.preventDefault();
                document.getElementById('awards_recipients').classList.add('is-invalid');
            }
            if (!startDate) {
                event.preventDefault();
                document.getElementById('awards_date').classList.add('is-invalid');
            }
            if (!startDate && !endDate) {
                event.preventDefault();
                document.getElementById('awards_date').classList.add('is-invalid');
                document.getElementById('awards_recipients').classList.add('is-invalid');
            }
        });

        $(document).ready(function() {
            $('#techForm').on('submit', function(e) {

                var formData = new FormData(this);

                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('update-equipment/' . $all->id) }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Equipment Updated Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        }).then((result) => {
                            if (result.dismiss) {
                                window.location.href = '/cbg-equipment';
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
