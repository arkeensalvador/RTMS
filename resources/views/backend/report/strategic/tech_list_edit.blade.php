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
                                    <h2 class="font-weight-bold">Technologies Generated</h2>
                                    <h5 class="mt-0"> Kindly fill-out the fields needed.</h5>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label for="strategic_program" class="font-weight-bold">Type of Technology<span
                                            class="text-danger">*</span></label>
                                    <select name="tech_type" id="strategic_program" class="form-control type" required>
                                        <option value=""></option>
                                        <option value="Research" {{ 'Research' == $all->tech_type ? 'selected' : '' }}>
                                            Research</option>
                                        <option value="Development"
                                            {{ 'Development' == $all->tech_type ? 'selected' : '' }}>Development</option>
                                    </select>
                                    <div class="valid-feedback"></div>
                                    <div class="invalid-feedback">Missing type of technology</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="strategic_implementing_agency" class=" font-weight-bold">Title<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="tech_title" id="strategic_title" class="form-control"
                                        value="{{ $all->tech_title }}" placeholder="Title" required>
                                    <div class="invalid-feedback">Missing title</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="strategic_implementing_agency" class=" font-weight-bold">Description<span
                                            class="text-danger">*</span></label>
                                    <textarea name="tech_desc" id="strategic_title" class="form-control" rows="4" style="resize: none" required
                                        placeholder="Description">{{ $all->tech_desc }}</textarea>
                                    <div class="invalid-feedback">Missing title</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="agencySelect" class=" font-weight-bold">Agency<span
                                            class="text-danger">*</span></label>
                                    <select id="agencySelect" name="tech_agency" class="form-control agency" required>
                                        <option value=""></option>
                                        @foreach ($agency as $row)
                                            <option value="{{ $row->abbrev }}"
                                                {{ $row->abbrev == $all->tech_agency ? 'selected' : '' }}>
                                                {{ $row->agency_name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing agency</div>
                                </div>

                                @php
                                    $res = json_decode($all->tech_researchers);
                                @endphp

                                <div class="col-md-6 form-group">
                                    <label for="ttp_sof" class=" font-weight-bold">Researchers<span
                                            class="text-danger">*</span></label>
                                    <select id="researcherSelect" name="tech_researchers[]" class="form-control researchers"
                                        multiple="multiple" required>
                                        <option value=""></option>
                                        @foreach ($researchers as $key)
                                            <option value="{{ $key->name }}"
                                                {{ in_array($key->name, $res) ? 'selected' : '' }}>
                                                {{ $key->name }}
                                                </b></option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing researchers</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="agencySelect" class=" font-weight-bold">Program/Project Source<span
                                            class="text-danger">*</span></label>
                                    <select id="" name="tech_source" class="form-control source" required>
                                        <option value=""></option>
                                        <optgroup label="Programs">
                                            @foreach ($programs as $prog)
                                                <option value="{{ $prog->program_title }}"
                                                    {{ $prog->program_title == $all->tech_source ? 'selected' : '' }}>
                                                    {{ $prog->program_title }}
                                                </option>
                                            @endforeach
                                        </optgroup>

                                        <optgroup label="Projects">
                                            @foreach ($projects as $proj)
                                                <option value="{{ $proj->project_title }}"
                                                    {{ $proj->project_title == $all->tech_source ? 'selected' : '' }}>
                                                    {{ $proj->project_title }}
                                                </option>
                                            @endforeach
                                        </optgroup>

                                        <optgroup label="Sub Projects">
                                            @foreach ($sub_projects as $sub_proj)
                                                <option value="{{ $sub_proj->sub_project_title }}"
                                                    {{ $sub_proj->sub_project_title == $all->tech_source ? 'selected' : '' }}>
                                                    {{ $sub_proj->sub_project_title }} </option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                    <div class="invalid-feedback">Missing program/project source</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="strategic_implementing_agency" class=" font-weight-bold">Potential Impact or
                                        Contribution<span class="text-danger">*</span></label>
                                    <textarea name="tech_impact" id="strategic_title" class="form-control" rows="4" style="resize: none" required
                                        placeholder="Impact">{{ $all->tech_impact }}</textarea>
                                    <div class="invalid-feedback">Missing impact</div>
                                </div>

                                <div class="col-md-12 form-group buttons">
                                    <a href="{{ url('strategic-tech-list') }}" class="btn btn-default">Back</a>
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
                    url: "{{ url('update-strategic-tech-list/' . $all->id) }}",
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
                                window.location.href = '/strategic-tech-list';
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
