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

                                <div class="col-md-6 form-group">
                                    <label for="trainings_sof" class=" font-weight-bold">Source of Funds<span
                                            class="text-danger">*</span></label>
                                    <select id="trainings_sof" name="trainings_sof" class="form-control agency" required>
                                        <option value=""></option>
                                        @foreach ($agency as $row)
                                            <option value="{{ $row->abbrev }}"
                                                {{ $row->abbrev == $all->trainings_sof ? 'selected' : '' }}>
                                                {{ $row->agency_name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing source of funds</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="trainings_agency" class=" font-weight-bold">Agency<span
                                            class="text-danger">*</span></label>
                                    <select id="trainings_agency" name="trainings_agency" class="form-control agency"
                                        required>
                                        <option value=""></option>
                                        @foreach ($agency as $row)
                                            <option value="{{ $row->abbrev }}"
                                                {{ $row->abbrev == $all->trainings_agency ? 'selected' : '' }}>
                                                {{ $row->agency_name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing agency</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="trainings_title" class=" font-weight-bold">Title of Activity/Training<span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" name="trainings_title" id="trainings_title" rows="3" placeholder="Enter ..."
                                        style="resize: none;" required>{{ $all->trainings_title }}</textarea>
                                    <div class="invalid-feedback">Missing title</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="trainings_expenditures" class=" font-weight-bold">Expenditures<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="trainings_expenditures"
                                        id="trainings_expenditures" placeholder="Enter ..."
                                        value="{{ $all->trainings_expenditures }}" required>
                                    <div class="invalid-feedback">Missing expenditures</div>
                                </div>


                                <div class="col-md-3 form-group">
                                    <label for="trainings_start" class=" font-weight-bold">Start Date<span
                                            class="text-danger">*</span></label>

                                    <input type="number" name="trainings_start" id="trainings_start"
                                        class="form-control date" placeholder="Enter start date"
                                        value="{{ $all->trainings_start }}" required>
                                    <div class="invalid-feedback">Missing start date</div>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="trainings_end" class="font-weight-bold">End Date <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="trainings_end" class="form-control date"
                                        value="{{ $all->trainings_end }}" id="trainings_end" placeholder="Enter end date"
                                        required>
                                    <div class="invalid-feedback">Missing end date</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="trainings_no_participants" class=" font-weight-bold">No. of
                                        Participants<span class="text-danger">*</span></label>
                                    <input type="number" name="trainings_no_participants" class="form-control"
                                        id="trainings_no_participants" placeholder="# of participants"
                                        value="{{ $all->trainings_no_participants }}" required>
                                    <div class="invalid-feedback"> Missing # of participants</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="trainings_no_participants" class=" font-weight-bold">Venue<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="trainings_venue" value="{{ $all->trainings_venue }}"
                                        class="form-control" id="training_venue" placeholder="Venue" required>
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
        $(document).ready(function() {
            $('#trainings_sof, #trainings_agency, #trainings_title, #trainings_start, #trainings_end, #trainings_title')
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
                    url: "{{ url('update-training/' . $all->id) }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Training Updated Successfully',
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
                        // Swal.fire({
                        //     icon: 'warning',
                        //     title: data.responseJSON.message,
                        //     // title: 'There is something wrong...',
                        //     timerProgressBar: false,
                        //     showConfirmButton: true,
                        // });
                    }
                });
            });
        });
    </script>
@endsection
