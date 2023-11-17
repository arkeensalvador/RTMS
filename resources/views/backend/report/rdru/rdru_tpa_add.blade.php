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
                                    <h2 class="font-weight-bold">Technology Promotion Approaches</h2>
                                    <h5 class="mt-0"> Kindly fill-out the fields needed.</h5>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="ttp_sof" class=" font-weight-bold">Agency<span
                                            class="text-danger">*</span></label>
                                    <select id="agencySelect" name="tpa_agency" class="form-control r-agency" required>
                                        <option value=""></option>
                                        @foreach ($agency as $row)
                                            <option value="{{ $row->abbrev }}"> {{ $row->agency_name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing proponent</div>
                                </div>


                                <div class="col-md-6 form-group">
                                    <label for="ttp_sof" class=" font-weight-bold">Researchers<span
                                            class="text-danger">*</span></label>
                                    <select id="researcherSelect" name="tpa_researchers[]" class="form-control researchers"
                                        multiple="multiple" required>
                                        <option value=""></option>
                                    </select>
                                    <div class="invalid-feedback">Missing researchers</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="ttm_title" class="font-weight-bold">Title<span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" name="tpa_title" id="tpa_title" rows="3" placeholder="Title" style="resize: none;"
                                        required></textarea>
                                    <div class="invalid-feedback">Missing title</div>
                                </div>

                                <div class="col-md-5">
                                    <label for="tpa_date" class=" font-weight-bold">Date<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="tpa_date" id="tpa_date" class="form-control date-range"
                                        placeholder="Enter date" required>
                                    <div class="invalid-feedback">Missing date</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="tpa_details" class="font-weight-bold">Details<span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" name="tpa_details" id="tpa_details" rows="3" placeholder="Details"
                                        style="resize: none;" required></textarea>
                                    <div class="invalid-feedback">Missing details</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="tpa_remarks" class="font-weight-bold">Remarks<span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" name="tpa_remarks" id="tpa_remarks" rows="3" placeholder="Remarks"
                                        style="resize: none;" required></textarea>
                                    <div class="invalid-feedback">Missing remarks</div>
                                </div>


                                <div class="col-md-12 form-group">
                                    <label for="" class="font-weight-bold">Information, Education and
                                        Communication (IEC) Approaches<span class="text-danger">*</span></label>
                                    <div class="ttm row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="Regional FIESTA" name="tpa_approaches[]"
                                                        id="customCheckbox1">
                                                    <label for="customCheckbox1" class="custom-control-label">Regional
                                                        FIESTA</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="Fairs" name="tpa_approaches[]"
                                                        id="customCheckbox2">
                                                    <label for="customCheckbox2" class="custom-control-label">Fairs</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="Exhibits" name="tpa_approaches[]"
                                                        id="customCheckbox3">
                                                    <label for="customCheckbox3"
                                                        class="custom-control-label">Exhibits</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="Media Conference" name="tpa_approaches[]"
                                                        id="customCheckbox4">
                                                    <label for="customCheckbox4" class="custom-control-label">Media
                                                        Conference</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="Farmers' Fora" name="tpa_approaches[]"
                                                        id="customCheckbox5">
                                                    <label for="customCheckbox5" class="custom-control-label">Farmers'
                                                        Fora</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="IEC Materials" name="tpa_approaches[]"
                                                        id="customCheckbox6">
                                                    <label for="customCheckbox6" class="custom-control-label">IEC
                                                        Materials</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="Press Release" name="tpa_approaches[]"
                                                        id="customCheckbox7">
                                                    <label for="customCheckbox7" class="custom-control-label">Press
                                                        Release</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="Publications in Newspaper"
                                                        name="tpa_approaches[]" id="customCheckbox8">
                                                    <label for="customCheckbox8" class="custom-control-label">Publications
                                                        in Newspaper</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="Magazines" name="tpa_approaches[]"
                                                        id="customCheckbox9">
                                                    <label for="customCheckbox9"
                                                        class="custom-control-label">Magazines</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="Comics" name="tpa_approaches[]"
                                                        id="customCheckbox10">
                                                    <label for="customCheckbox10"
                                                        class="custom-control-label">Comics</label>
                                                </div>
                                                {{-- <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="Others" id="is_others" name="tpa_approaches[]"
                                                        id="customCheckbox11">
                                                    <label for="customCheckbox11"
                                                        class="custom-control-label">Others</label>
                                                </div> --}}

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="Broadcast Media" name="tpa_approaches[]"
                                                        id="customCheckbox12">
                                                    <label for="customCheckbox12" class="custom-control-label">Broadcast
                                                        Media</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="Radio" name="tpa_approaches[]"
                                                        id="customCheckbox13">
                                                    <label for="customCheckbox13"
                                                        class="custom-control-label">Radio</label>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="Television" name="tpa_approaches[]"
                                                        id="customCheckbox14">
                                                    <label for="customCheckbox14"
                                                        class="custom-control-label">Television</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="News Features" name="tpa_approaches[]"
                                                        id="customCheckbox15">
                                                    <label for="customCheckbox15" class="custom-control-label">News
                                                        Features</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="School on the Air" name="tpa_approaches[]"
                                                        id="customCheckbox16">
                                                    <label for="customCheckbox16" class="custom-control-label">School on
                                                        the Air</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="Interview Guesting"
                                                        name="tpa_approaches[]" id="customCheckbox17">
                                                    <label for="customCheckbox17" class="custom-control-label">Interview
                                                        Guesting</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="ICT-based ICT" name="tpa_approaches[]"
                                                        id="customCheckbox18">
                                                    <label for="customCheckbox18" class="custom-control-label">ICT-based
                                                        ICT</label>
                                                </div>

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="CDs & Optimal Media"
                                                        name="tpa_approaches[]" id="customCheckbox19">
                                                    <label for="customCheckbox19" class="custom-control-label">CDs &
                                                        Optimal
                                                        Media</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-3">
                                            <div class="form-group">

                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="Web-based Formats" name="tpa_approaches[]"
                                                        id="customCheckbox20">
                                                    <label for="customCheckbox20" class="custom-control-label">Web-based
                                                        Formats</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input custom-control-input-success"
                                                        type="checkbox" value="Online Promotion" name="tpa_approaches[]"
                                                        id="customCheckbox21">
                                                    <label for="customCheckbox21" class="custom-control-label">Online
                                                        Promotion</label>
                                                </div>
                                                <div class="custom-control custom-checkbox form-check">
                                                    <input type="checkbox" id="is_others" name="tpa_approaches[]"
                                                        value="Others"
                                                        class="custom-control-input custom-control-input-success">
                                                    <label for="is_others" class="custom-control-label">Others</label>
                                                </div>
                                                <div class="form-group" style="display: none;" id="others-input">
                                                    <label for="others">Specify Others</label>
                                                    <input type="text" id="others" name="is_others"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @error('tpa_approaches')
                                        <p style="color: red;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-12 form-group buttons">
                                    <a href="{{ url('rdru-tpa') }}" class="btn btn-default">Back</a>
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
            $('#ttm_title, #ttm_agency, #ttm_status, #ttm_type, #tpa_date , #ttp_end_date, #tpa_approaches')
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
            const date = document.getElementById('tpa_date').value;

            if (!date) {
                event.preventDefault();
                document.getElementById('tpa_date').classList.add('is-invalid');
            }
            if (date) {
                event.preventDefault();
                document.getElementById('tpa_date').classList.add('is-valid');
            }

        });

        $(document).ready(function() {
            $('#techForm').on('submit', function(e) {

                var formData = new FormData(this);

                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('add-tpa') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        // this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'TPA Added Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        }).then((result) => {
                            if (result.dismiss) {
                                window.location.href = '/rdru-tpa';
                            }
                        })
                    },
                    error: function(data) {
                        Swal.fire({
                            icon: 'warning',
                            toast: true,
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

    <script>
        document.getElementById('is_others').addEventListener('change', function() {
            const othersInput = document.getElementById('others-input');
            othersInput.style.display = this.checked ? 'block' : 'none';
        });
    </script>
@endsection
