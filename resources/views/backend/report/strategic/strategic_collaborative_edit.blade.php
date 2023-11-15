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
                                    <h2 class="font-weight-bold">Collaborative R&D Programs/Projects implemented
                                    </h2>
                                    <h5 class="mt-0"> Kindly fill-out the fields needed.</h5>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="strategic_program" class="font-weight-bold">Program/Project Type<span
                                            class="text-danger">*</span></label>
                                    <select name="str_collab_type" id="strategic_program" class="form-control type"
                                        required>
                                        <option value=""></option>
                                        <option value="Agency-led"
                                            {{ 'Agency-led' == $all->str_collab_type ? 'selected' : '' }}>Agency-led
                                        </option>
                                        <option value="Consortium-led"
                                            {{ 'Consortium-led' == $all->str_collab_type ? 'selected' : '' }}>Consortium-led
                                        </option>
                                    </select>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">Missing type</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="ttp_sof" class=" font-weight-bold">Program<span
                                            class="text-danger">*</span></label>
                                    <select id="programSelect" name="str_collab_program" class="form-control programs"
                                        required>
                                        <option value=""></option>
                                        @foreach ($programs as $row)
                                            <option value="{{ $row->programID }}"
                                                {{ $row->programID == $all->str_collab_program ? 'selected' : '' }}>
                                                {{ $row->program_title }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing program</div>
                                </div>

                                {{-- PROGRAM TITLE --}}
                                <input type="text" name="str_collab_program_title" id="programTitle"
                                    value="{{ $all->str_collab_program_title }}" hidden>

                                @php
                                    $proj = json_decode($all->str_collab_project);
                                    $string = 'N/A';
                                    $proj = array_merge([$string], $proj);
                                @endphp

                                <div class="col-md-12 form-group">
                                    <label for="ttp_sof" class=" font-weight-bold">Projects<span
                                            class="text-danger">*</span></label>
                                    <select id="projectSelect" name="str_collab_project[]" class="form-control projects"
                                        multiple="multiple" required>
                                        <option value=""></option>

                                        @foreach ($projects as $key)
                                            <option value="{{ $key->project_title }}"
                                                {{ in_array($key->project_title, $proj) ? 'selected' : '' }}>
                                                {{ $key->project_title }}
                                                </b></option>
                                        @endforeach

                                        @foreach ($projects as $key)
                                            <option value="{{ $key->sub_project_title }}"
                                                {{ in_array($key->sub_project_title, $proj) ? 'selected' : '' }}>
                                                {{ $key->sub_project_title }}
                                                </b></option>
                                        @endforeach
                                    </select>

                                    <div class="invalid-feedback">Missing projects</div>
                                </div>

                                @php
                                    $imp = json_decode($all->str_collab_imp_agency);
                                @endphp

                                <div class="col-md-12 form-group">
                                    <label for="awards_recipients" class=" font-weight-bold">Implementing Agency<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control implementing_agency" id="awards_recipients"
                                        name="str_collab_imp_agency[]" multiple="multiple" required>

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
                                    $collab = json_decode($all->str_collab_agency);
                                @endphp


                                <div class="col-md-12 form-group">
                                    <label for="awards_recipients" class=" font-weight-bold">Collaborating Agency<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control collaborating_agency" id=""
                                        name="str_collab_agency[]" multiple="multiple" required>

                                        @foreach ($agency as $key)
                                            <option value="{{ $key->abbrev }}"
                                                {{ in_array($key->abbrev, $collab) ? 'selected' : '' }}>
                                                {{ $key->agency_name }} -
                                                ({{ $key->abbrev }})
                                                </b></option>
                                        @endforeach

                                    </select>
                                    <div class="invalid-feedback">Missing collaborating agency</div>
                                </div>

                                <div class="col-md-5">
                                    <label for="tpa_date" class=" font-weight-bold">Date<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="str_collab_date" value="{{ $all->str_collab_date }}"
                                        id="tpa_date" class="form-control date-range" placeholder="Enter date" required>
                                    <div class="invalid-feedback">Missing date</div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="approved_budget" class=" font-weight-bold">Budget<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="str_collab_budget" value="{{ $all->str_collab_budget }}"
                                        class="form-control" id="" placeholder="Budget" required>
                                    <div class="invalid-feedback">Missing budget</div>
                                </div>

                                <div class="col-md-8 form-group">
                                    <label for="funding_agency" class=" font-weight-bold">Source of Fund<span
                                            class="text-danger">*</span></label>
                                    <select id="funding_agency" name="str_collab_sof" class="form-control agency" required>
                                        <option></option>
                                        @foreach ($agency as $key)
                                            <option value="{{ $key->abbrev }}"
                                                {{ $key->abbrev == $all->str_collab_sof ? 'selected' : '' }}>
                                                {{ $key->agency_name }} -
                                                ({{ $key->abbrev }})
                                                </b></option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing source of fund</div>
                                </div>


                                <div class="col-md-12 form-group">
                                    <label for="strategic_implementing_agency" class=" font-weight-bold">Role of
                                        Consortium<span class="text-danger">*</span></label>
                                    <textarea name="str_collab_roc" id="strategic_title" class="form-control" rows="4" style="resize: none"
                                        required placeholder="Role of consortium">{{ $all->str_collab_roc }}</textarea>
                                    <div class="invalid-feedback">Missing role of consortium</div>
                                </div>


                                <div class="col-md-12 form-group buttons">
                                    <a href="{{ url('strategic-collaborative-list') }}" class="btn btn-default">Back</a>
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

    <script></script>
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

            // Program Select & Projects 
            $('#programSelect').on('change', function() {
                var selectedText = $('#programSelect option:selected').text().trim();
                $('#programTitle').val(selectedText);

                var programID = $(this).val();
                if (programID) {
                    $.ajax({
                        url: '/get-projects',
                        type: 'GET',
                        data: {
                            program_id: programID
                        },
                        success: function(data) {
                            $('#projectSelect').empty();
                            $('#projectSelect').append(
                                '<option value="">Select projects</option>'
                            );
                            data.forEach(function(projects) {
                                $('#projectSelect').append($('<option>', {
                                    value: projects.project_title,
                                    text: projects.project_title
                                }));
                                $('#projectSelect').append($('<option>', {
                                    value: projects.sub_project_title,
                                    text: projects.sub_project_title
                                }));
                            });

                            $('#projectSelect').append(
                                '<option value="N/A">N/A</option>'
                            );
                        }
                    });
                } else {
                    $('#projectSelect').empty();
                    $('#projectSelect').append(
                        '<option value="">Select projects</option>');
                    $('#projectSelect').select2();
                }
            });
        });
    </script>
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
                    url: "{{ url('update-strategic-collaborative-list/' . $all->id) }}",
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
                                window.location.href = '/strategic-collaborative-list';
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
