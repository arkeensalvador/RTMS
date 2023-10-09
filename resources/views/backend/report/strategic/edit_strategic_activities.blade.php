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
                            <form id="activityForm" class="row g-3 needs-validation" novalidate>
                                @csrf
                                <div class="form-title col-12">
                                    <h2 class="font-weight-bold">Strategic R & D Activities</h2>
                                    <h5 class="mt-0"> Kindly fill-up the fields needed.</h5>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="strategic_program" class="font-weight-bold">Program/Project Type<span
                                            class="text-danger">*</span></label>
                                    <select name="strategic_program" id="strategic_program" class="form-control type"
                                        required>
                                        <option value="" selected disabled>--Select Type--</option>
                                        <option value="Agency-led"
                                            {{ 'Agency-led' == $all->strategic_program ? 'selected' : '' }}>Agency-led
                                        </option>
                                        <option value="Consortium-led"
                                            {{ 'Consortium-led' == $all->strategic_program ? 'selected' : '' }}>
                                            Consortium-led</option>
                                    </select>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">Missing program/project type</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="Researcher" class="font-weight-bold">Researcher<span
                                            class="text-danger">*</span></label>
                                    <select id="strategic_researcher" name="strategic_researcher"
                                        class="form-control researchers" required>
                                        <option value="" disabled selected>--Select Researcher--</option>
                                        @foreach ($researchers as $researcher)
                                            <option value="{{ $researcher->name }}"
                                                {{ $researcher->name == $all->strategic_researcher ? 'selected' : '' }}>
                                                {{ $researcher->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">Missing researcher</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="strategic_implementing_agency" class=" font-weight-bold">Implementing
                                        Agency<span class="text-danger">*</span></label>
                                    <select id="strategic_implementing_agency" name="strategic_implementing_agency"
                                        class="form-control agency" required>
                                        <option value=""></option>
                                        @foreach ($agency as $row)
                                            <option value="{{ $row->abbrev }}"
                                                {{ $row->abbrev == $all->strategic_implementing_agency ? 'selected' : '' }}>
                                                {{ $row->agency_name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing implementing agency</div>
                                </div>


                                <div class="col-md-6 form-group">
                                    <label for="strategic_funding_agency" class=" font-weight-bold">Funding
                                        Agency<span class="text-danger">*</span></label>
                                    <select id="strategic_funding_agency" name="strategic_funding_agency"
                                        class="form-control agency" required>
                                        <option value=""></option>
                                        @foreach ($agency as $row)
                                            <option value="{{ $row->abbrev }}"
                                                {{ $row->abbrev == $all->strategic_funding_agency ? 'selected' : '' }}>
                                                {{ $row->agency_name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing funding agency</div>
                                </div>


                                <div class="col-md-12 form-group">
                                    <label for="strategic_implementing_agency" class=" font-weight-bold">Title<span
                                            class="text-danger">*</span></label>
                                    <textarea name="strategic_title" id="strategic_title" class="form-control" rows="4" style="resize: none" required>{{ $all->strategic_title }}</textarea>
                                    <div class="invalid-feedback">Missing title</div>
                                </div>


                                <div class="col-md-3 form-group">
                                    <label for="start_date" class=" font-weight-bold">Start Date<span
                                            class="text-danger">*</span></label>

                                    <input type="number" name="strategic_start" id="strategic_start"
                                        class="form-control date" placeholder="Enter start date"
                                        value="{{ $all->strategic_start }}" required>
                                    <div class="invalid-feedback">Missing start date</div>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="end_date" class="font-weight-bold">End Date <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="strategic_end" class="form-control date"
                                        value="{{ $all->strategic_end }}" id="strategic_end" placeholder="Enter end date"
                                        required>
                                    <div class="invalid-feedback">Missing end date</div>
                                </div>


                                <div class="col-md-6 form-group">
                                    <label for="strategic_budget" class=" font-weight-bold">Budget</label>
                                    <input type="text" name="strategic_budget" value="{{ $all->strategic_budget }}"
                                        class="form-control" id="strategic_budget" placeholder="Budget" required>
                                    <div class="invalid-feedback">Missing budget</div>
                                </div>


                                <div class="col-md-6 form-group">
                                    <label for="strategic_commodities" class=" font-weight-bold">Commodities<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="strategic_commodities"
                                        value="{{ $all->strategic_commodities }}" class="form-control"
                                        id="strategic_commodities" placeholder="Commodities" required>
                                    <div class="invalid-feedback"> Missing commodities</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="strategic_consortium_role" class=" font-weight-bold">Role of
                                        Consortium</label>
                                    <input type="text" name="strategic_consortium_role"
                                        value="{{ $all->strategic_consortium_role }}" class="form-control"
                                        id="strategic_consortium_role" placeholder="Enter consortium role" required>
                                    <div class="invalid-feedback">Missing consortium role</div>
                                </div>
                                <div class="col-md-12 form-group buttons">
                                    <a href="{{ url('strategic-activities') }}" class="btn btn-default">Back</a>
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
            $('#strategic_program, #strategic_researcher, #strategic_implementing_agency, #strategic_funding_agency, #strategic_budget, #strategic_end, #strategic_start, #strategic_title')
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

        document.getElementById('activityForm').addEventListener('submit', function(event) {
            const startDate = document.getElementById('strategic_start').value;
            const endDate = document.getElementById('strategic_end').value;
            if (!endDate) {
                event.preventDefault();
                document.getElementById('strategic_end').classList.add('is-invalid');
            }
            if (!startDate) {
                event.preventDefault();
                document.getElementById('strategic_start').classList.add('is-invalid');
            }
            if (!startDate && !endDate) {
                event.preventDefault();
                document.getElementById('strategic_start').classList.add('is-invalid');
                document.getElementById('strategic_end').classList.add('is-invalid');
            }
        });

        $(document).ready(function() {
            $('#activityForm').on('submit', function(e) {

                var formData = new FormData(this);

                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('update-strategic/' . $all->id) }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'R & D Activity Updated Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        }).then((result) => {
                            if (result.dismiss) {
                                window.location.href = '/strategic-activities'
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
