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
                                    <h2 class="font-weight-bold">Meetings</h2>
                                    <h5 class="mt-0"> Kindly fill-out the fields needed.</h5>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="meeting_type" class=" font-weight-bold">Type of Meeting/Activity<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="meeting_type" value="{{ $all->meeting_type }}"
                                        class="form-control" id="meeting_type" placeholder="Type/Activity" required>
                                    <div class="invalid-feedback"> Missing type of meeting/activity</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="meeting_host" class=" font-weight-bold">Host Agency<span
                                            class="text-danger">*</span></label>
                                    <select id="meeting_host" name="meeting_host" class="form-control agency" required>
                                        <option value=""></option>
                                        @foreach ($agency as $row)
                                            <option value="{{ $row->abbrev }}"
                                                {{ $row->abbrev == $all->meeting_host ? 'selected' : '' }}>
                                                {{ $row->agency_name }} -
                                                {{ $row->abbrev }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing host agency</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="meeting_venue" class=" font-weight-bold">Venue<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ $all->meeting_venue }}"
                                        name="meeting_venue" id="meeting_venue" placeholder="Enter venue" required>
                                    <div class="invalid-feedback">Missing venue</div>
                                </div>


                                <div class="col-md-3 form-group">
                                    <label for="trainings_start" class=" font-weight-bold">Date<span
                                            class="text-danger">*</span></label>

                                    <input type="number" name="meeting_date" value="{{ $all->meeting_date }}"
                                        id="meeting_date" class="form-control date" placeholder="Enter start date" required>
                                    <div class="invalid-feedback">Missing start date</div>
                                </div>



                                <div class="col-md-12 form-group buttons">
                                    <a href="{{ url('cbg-meetings') }}" class="btn btn-default">Back</a>
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
            $('#meeting_type, #meeting_host, #meeting_venue, #meeting_date')
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
            const startDate = document.getElementById('meeting_date').value;

            if (!startDate) {
                event.preventDefault();
                document.getElementById('meeting_date').classList.add('is-invalid');
            }

        });

        $(document).ready(function() {
            $('#techForm').on('submit', function(e) {

                var formData = new FormData(this);

                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('update-meetings/' . $all->id) }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Meeting Updated Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        }).then((result) => {
                            if (result.dismiss) {
                                // this.reset();
                                window.location.href = '/cbg-meetings';
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
