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
                                    <h2 class="font-weight-bold">Awards</h2>
                                    <h5 class="mt-0"> Kindly fill-out the fields needed.</h5>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="awards_type" class=" font-weight-bold">Award Type<span
                                            class="text-danger">*</span></label>
                                    <select id="awards_type" name="awards_type" class="form-control others" required>
                                        <option value=""></option>
                                        <option value="Local" {{ 'Local' == $all->awards_type ? 'selected' : '' }}>Local
                                        </option>
                                        <option value="Regional" {{ 'Regional' == $all->awards_type ? 'selected' : '' }}>
                                            Regional</option>
                                        <option value="National" {{ 'National' == $all->awards_type ? 'selected' : '' }}>
                                            National</option>
                                        <option value="International"
                                            {{ 'International' == $all->awards_type ? 'selected' : '' }}>International
                                        </option>
                                    </select>
                                    <div class="invalid-feedback">Missing award type</div>
                                </div>


                                <div class="col-md-8 form-group">
                                    <label for="awards_agency" class=" font-weight-bold">Agency<span
                                            class="text-danger">*</span></label>
                                    <select id="awards_agency" name="awards_agency" class="form-control agency" required>
                                        <option value=""></option>
                                        @foreach ($agency as $row)
                                            <option value="{{ $row->abbrev }}"
                                                {{ $row->abbrev == $all->awards_agency ? 'selected' : '' }}>
                                                {{ $row->agency_name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing agency</div>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="awards_date" class=" font-weight-bold">Date<span
                                            class="text-danger">*</span></label>

                                    <input type="number" name="awards_date" value="{{ $all->awards_date }}"
                                        id="awards_date" class="form-control date" placeholder="Enter date" required>
                                    <div class="invalid-feedback">Missing date</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="awards_title" class=" font-weight-bold">Award Ttitle<span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" name="awards_title" id="awards_title" rows="3" placeholder="Enter ..."
                                        style="resize: none;" required>{{ $all->awards_title }}</textarea>
                                    <div class="invalid-feedback">Missing title</div>
                                </div>
                                @php
                                    $rec = json_decode($all->awards_recipients);
                                @endphp
                                <div class="col-md-6 form-group">
                                    <label for="awards_recipients" class="font-weight-bold">Recipient(s)<span
                                            class="text-danger">*</span></label>

                                    <select class="form-control js-example-basic-single" id="awards_recipients"
                                        name="awards_recipients[]" multiple="multiple" required>
                                        @foreach ($agency as $row)
                                            <option value="{{ $row->abbrev }}"
                                                {{ in_array($row->abbrev, $rec) ? 'selected' : '' }}>
                                                {{ $row->agency_name }}
                                            </option>
                                        @endforeach
                                        @foreach ($researchers as $row)
                                            <option value="{{ $row->name }}"
                                                {{ in_array($row->name, $rec) ? 'selected' : '' }}>
                                                {{ $row->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing recipients</div>
                                </div>


                                <div class="col-md-6 form-group">
                                    <label for="awards_sponsor" class=" font-weight-bold">Sponsor<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="awards_sponsor" value="{{ $all->awards_sponsor }}"
                                        class="form-control" placeholder="Sponsor" list="sponsor" required>
                                    <datalist id="sponsor">
                                        @foreach ($agency as $key)
                                            <option value="{{ $key->abbrev }}">{{ $key->agency_name }}
                                            </option>
                                        @endforeach
                                    </datalist>
                                    <div class="invalid-feedback">Missing sponsor</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="awards_event" class=" font-weight-bold">Event/Activity<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="awards_event" value="{{ $all->awards_event }}"
                                        class="form-control" id="awards_event" placeholder="Event" required>
                                    <div class="invalid-feedback"> Missing event</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="awards_place" class=" font-weight-bold">Place of Award<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="awards_place" value="{{ $all->awards_place }}"
                                        class="form-control" id="awards_place" placeholder="Event place" required>
                                    <div class="invalid-feedback"> Missing place of event</div>
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
            $('#awards_type, #awards_agency, #awards_date, #awards_title, #awards_recipients, #awards_sponsor')
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
                    url: "{{ url('update-award/' . $all->id) }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Award Updated Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        }).then((result) => {
                            if (result.dismiss) {
                                window.location.href = '/cbg-awards';
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
