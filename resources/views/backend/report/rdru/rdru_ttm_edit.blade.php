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
                                    <h2 class="font-weight-bold">Technologies Commercialized or Pre-Commercialization
                                        Initiatives</h2>
                                    <h5 class="mt-0"> Kindly fill-out the fields needed.</h5>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="ttm_title" class="font-weight-bold">Title of Technology<span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" name="ttm_title" id="ttm_title" rows="3" placeholder="Title" style="resize: none;"
                                        required>{{ $all->ttm_title }}</textarea>
                                    <div class="invalid-feedback">Missing title</div>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="ttm_type" class=" font-weight-bold">Type of IPR Applies<span
                                            class="text-danger">*</span></label>
                                    <select name="ttm_type" class="form-control others" id="ttm_type" required>
                                        <option value=""></option>
                                        <option value="Copyright" {{ 'Copyright' == $all->ttm_type ? 'selected' : '' }}>
                                            Copyright</option>
                                        <option value="Utility" {{ 'Utility' == $all->ttm_type ? 'selected' : '' }}>Utility
                                            Model</option>
                                        <option value="Trademark" {{ 'Trademark' == $all->ttm_type ? 'selected' : '' }}>
                                            Trademark</option>
                                    </select>
                                    <div class="invalid-feedback">Missing type IPR applies</div>
                                </div>

                                {{-- AGENCY OF THE USER WHO INPUTTED THIS DATA --}}
                                <input type="text" hidden name="ttm_agency" value="{{ $all->ttm_agency }}">

                                <div class="col-md-6 form-group">
                                    <label for="ttm_status" class="font-weight-bold">Status<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="ttm_status" id="ttm_status" value="{{ $all->ttm_status }}"
                                        class="form-control" placeholder="Enter status" required>
                                    {{-- <select name="ttm_status" id="ttm_status" class="form-control others" required>
                                        <option value="" selected disabled></option>
                                        <option value="Commercialized"
                                            {{ 'Commercialized' == $all->ttm_status ? 'selected' : '' }}>Commercialized
                                        </option>
                                        <option value="Pre-Commercialized"
                                            {{ 'Pre-Commercialized' == $all->ttm_status ? 'selected' : '' }}>
                                            Pre-Commercialized</option>
                                    </select> --}}
                                    <div class="invalid-feedback">Missing status</div>
                                </div>
                                @php
                                    $sof = json_decode($all->ttm_sof);
                                @endphp
                                <div class="col-md-12 form-group">
                                    <label for="ttm_sof" class=" font-weight-bold">Source of Fund<span
                                            class="text-danger">*</span></label>
                                    <select id="ttm_sof" name="ttm_sof[]" multiple class="form-control agency" required>
                                        <option value=""></option>
                                        @foreach ($agency as $row)
                                            <option value="{{ $row->abbrev }}"
                                                {{ in_array($row->abbrev, $sof) ? 'selected' : '' }}>

                                                {{ $row->agency_name }} </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing agency</div>
                                </div>

                                <div class="col-md-12 form-group buttons">
                                    <a href="{{ url('rdru-ttm') }}" class="btn btn-default">Back</a>
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
            $('#ttm_title, #ttm_sof, #ttm_status, #ttm_type, #ttp_end_date, #ttp_priorities')
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
            const ttm_type = document.getElementById('ttm_type').value;
            const ttm_status = document.getElementById('ttm_status').value;
            if (!ttm_status) {
                event.preventDefault();
                document.getElementById('ttm_status').classList.add('is-invalid');
            }
            if (!ttm_type) {
                event.preventDefault();
                document.getElementById('ttm_type').classList.add('is-invalid');
            }
            if (!ttm_type && !ttm_status) {
                event.preventDefault();
                document.getElementById('ttm_type').classList.add('is-invalid');
                document.getElementById('ttm_status').classList.add('is-invalid');
            }
        });

        $(document).ready(function() {
            $('#techForm').on('submit', function(e) {

                var formData = new FormData(this);

                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('update-ttm/' . $all->id) }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        // this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Updated Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        }).then((result) => {
                            if (result.dismiss) {
                                window.location.href = '/rdru-ttm';
                            }
                        })
                    },
                    error: function(data) {
                        //   Swal.fire({
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
