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
                                    <h2 class="font-weight-bold">R&D Programs/ Projects Packaged, Approved and Implemented
                                    </h2>
                                    <h5 class="mt-0"> Kindly fill-out the fields needed.</h5>
                                </div>

                                @if (!$imgs->isEmpty())
                                    <div class="col-md-12">
                                        <label for="strategic_program" class="font-weight-bold">Uploaded Images<span
                                                class="text-danger"></span></label><br>
                                        @foreach ($imgs as $img)
                                            <div style="display: inline-block; margin-right: 10px;">
                                                <a href="{{ asset($img->filename) }}" data-lightbox="photos">
                                                    <img src="{{ asset($img->filename) }}" alt=""
                                                        style="width: 200px; height: 200px;" class="img-thumbnail">
                                                </a>
                                                <p style="text-align: center">
                                                    <a href="{{ url('delete-image/' . $img->id) }}" id="delete"
                                                        style="color: red; text-decoration: underline; font-size: 13px">remove</a>
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="col-md-3 form-group">
                                    <label for="strategic_program" class="font-weight-bold">Program/Project Type<span
                                            class="text-danger">*</span></label>
                                    <select name="str_p_type" id="strategic_program" class="form-control type" required>
                                        <option value=""></option>
                                        <option value="Proposals" {{ 'Proposals' == $all->str_p_type ? 'selected' : '' }}>
                                            Proposals Packaged</option>
                                        <option value="Approved" {{ 'Approved' == $all->str_p_type ? 'selected' : '' }}>
                                            Approved and Implemented</option>
                                    </select>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">Missing type of technology</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="agencySelect" class=" font-weight-bold">Program/Project Title<span
                                            class="text-danger">*</span></label>
                                    <textarea name="str_p_title" id="" cols="30" rows="5" class="form-control"
                                        placeholder="Enter program/project title">{{ $all->str_p_title }}</textarea>

                                    <div class="invalid-feedback">Missing program/project title</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="ttp_sof" class=" font-weight-bold">Researchers<span
                                            class="text-danger">*</span></label>
                                    <textarea name="str_p_researchers" id="strategic_title" class="form-control" rows="3" style="resize: none"
                                        required placeholder="Researchers">{{ $all->str_p_researchers }}</textarea>
                                    <div class="invalid-feedback">Missing researchers</div>
                                </div>

                                @php
                                    $imp = json_decode($all->str_p_imp_agency);
                                @endphp

                                <div class="col-md-12 form-group">
                                    <label for="awards_recipients" class=" font-weight-bold">Implementing Agency<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control implementing_agency" id="awards_recipients"
                                        name="str_p_imp_agency[]" multiple="multiple" required>

                                        @foreach ($agency as $key)
                                            <option value="{{ $key->abbrev }}"
                                                {{ in_array($key->abbrev, $imp) ? 'selected' : '' }}>
                                                {{ $key->agency_name }} -
                                                ({{ $key->abbrev }})
                                                </b></option>
                                        @endforeach

                                    </select>
                                    <div class="invalid-feedback">Missing implementing agency</div>
                                </div>

                                @php
                                    $collab = json_decode($all->str_p_collab_agency);
                                @endphp

                                <div class="col-md-12 form-group">
                                    <label for="awards_recipients" class=" font-weight-bold">Collaborating Agency</label>
                                    <select class="form-control collaborating_agency" id=""
                                        name="str_p_collab_agency[]" multiple="multiple">
                                        @if (!empty($collab))
                                            @foreach ($agency as $key)
                                                <option value="{{ $key->abbrev }}"
                                                    {{ in_array($key->abbrev, $collab) ? 'selected' : '' }}>
                                                    {{ $key->agency_name }} -
                                                    ({{ $key->abbrev }})
                                                    </b></option>
                                            @endforeach
                                        @else
                                            <option value="{{ $key->abbrev }}">{{ $key->agency_name }} -
                                                ({{ $key->abbrev }})
                                                </b></option>
                                        @endif
                                    </select>
                                </div>

                                <div class="col-md-5">
                                    <label for="tpa_date" class=" font-weight-bold">Duration<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="str_p_date" id="tpa_date" value="{{ $all->str_p_date }}"
                                        class="form-control date-range" placeholder="Enter date" required>
                                    <div class="invalid-feedback">Missing date</div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="approved_budget" class=" font-weight-bold">Proposed Budget<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="str_p_budget" oninput="validateInput(this)"
                                        value="{{ number_format($all->str_p_budget) }}" class="form-control" id=""
                                        placeholder="Budget" required>
                                    <div class="invalid-feedback">Missing budget</div>
                                </div>
                                @php
                                    $sof = json_decode($all->str_p_sof);
                                @endphp
                                <div class="col-md-12 form-group">
                                    <label for="funding_agency" class=" font-weight-bold">Source of Fund<span
                                            class="text-danger">*</span></label>
                                    <select id="funding_agency" name="str_p_sof[]" multiple class="form-control agency"
                                        required>
                                        <option></option>
                                        @foreach ($agency as $key)
                                            <option value="{{ $key->abbrev }}"
                                                {{ in_array($key->abbrev, $sof) ? 'selected' : '' }}>
                                                {{ $key->agency_name }} -
                                                ({{ $key->abbrev }})
                                                </b></option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing source of fund</div>
                                </div>


                                <div class="col-md-12 form-group">
                                    <label for="strategic_implementing_agency" class=" font-weight-bold">Regional Priority
                                        Commodities<span class="text-danger">*</span></label>
                                    <textarea name="str_p_regional" id="strategic_title" class="form-control" rows="4" style="resize: none"
                                        required placeholder="Enter commodities">{{ $all->str_p_regional }}</textarea>
                                    <div class="invalid-feedback">Missing regional priotity commodities</div>
                                </div>

                                <div class="col-md-12 form-group buttons">
                                    <a href="{{ url('strategic-program-list') }}" class="btn btn-default">Back</a>
                                    <button type="submit" id="submit" class="btn btn-primary btn-m ">Submit</button>
                                </div>
                            </form>

                        </div>

                        <hr>
                        <div class="d-flex justify-content-center mt-3">
                            <div class="col-md-12 form-group">
                                <label for="ttp_sof" class=" font-weight-bold">Photo-documentation upload<span
                                        class="text-danger">*</span></label>
                                <form action="{{ url('/image/upload/store') }}" method="POST"
                                    enctype="multipart/form-data" class="dropzone" id="dropzone">
                                    @csrf
                                    <input type="text" name="strategic_programs_list_id" value="{{ $all->id }}"
                                        hidden>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        Dropzone.options.dropzone = {
            maxFilesize: 12,
            renameFile: function(file) {
                var dt = new Date();
                var time = dt.getTime();
                return time + file.name;
            },
            acceptedFiles: ".jpeg, .jpg, .png, .gif",
            addRemoveLinks: true,
            timeout: 5000,
            success: function(file, response) {
                console.log(response);
            },
            queuecomplete: function() {
                // Reload the page after all uploads are complete
                Swal.fire({
                    icon: 'success',
                    title: 'Images Added Successfully',
                    toast: true,
                    position: 'top-right',
                    timerProgressBar: true,
                    showConfirmButton: false,
                    timer: 500,
                }).then((result) => {
                    if (result.dismiss) {
                        location.reload();
                    }
                })
            },
            error: function(file, response) {
                return false;
            }
        };
    </script>

    <script>
        $(document).ready(function() {
            $('.r-agency').select2({
                placeholder: 'Select Agency'
            });

            $('#agencySelect').on('change', function() {
                var agencyId = $(this).val();
                if (agencyId) {
                    $.ajax({
                        url: '/get-researchers',
                        type: 'GET',
                        data: {
                            agency_id: agencyId
                        },
                        success: function(data) {
                            $('#researcherSelect').empty();
                            $('#researcherSelect').append(
                                '<option value="">Select a Researcher</option>'
                            );
                            data.forEach(function(researcher) {
                                $('#researcherSelect').append($('<option>', {
                                    value: researcher.name,
                                    text: researcher.name
                                }));
                            });
                            $('#researcherSelect').select2({
                                placeholder: "Select researchers"
                            });
                        }
                    });
                } else {
                    $('#researcherSelect').empty();
                    $('#researcherSelect').append(
                        '<option value="">Select a Researcher</option>');
                    $('#researcherSelect').select2();
                }
            });
        });
    </script>
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
                    url: "{{ url('update-strategic-program-list/' . $all->id) }}",
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
                                window.location.href = '/strategic-program-list';
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
