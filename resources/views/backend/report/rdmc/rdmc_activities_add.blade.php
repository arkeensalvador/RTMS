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
                        <div class="d-flex mt-3">
                            <form id="techForm" class="row g-3 needs-validation" novalidate>
                                @csrf
                                <div class="form-title col-12">
                                    <h2 class="font-weight-bold">RDMC Activities</h2>
                                    <h5 class="mt-0"> Kindly fill-out the fields needed.</h5>
                                </div>

                                <div class="col-md-8 form-group">
                                    <label for="funding_agency" class=" font-weight-bold">Donor/Source<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="donor" class="form-control" list="donorList" required
                                        placeholder="Enter donor/source">
                                    <datalist id="donorList">
                                        @foreach ($agency as $key)
                                            <option value="{{ $key->abbrev }}">{{ $key->agency_name }} -
                                                ({{ $key->abbrev }})
                                                </b></option>
                                        @endforeach
                                    </datalist>
                                    <div class="invalid-feedback">Missing donor/source</div>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="fund_code" class="font-weight-bold">Activity type<span
                                            class="text-danger">*</span></label>
                                    <input name="activity_type" class="form-control" list="titledtlist" required
                                        placeholder="Activity type">
                                    <datalist id="titledtlist">
                                        <option
                                            value="Implementation of Consortium-led R&D and Technology Transfer-related Programs/Activities">
                                        </option>
                                        <option value="HRD Activities"></option>
                                        <option value="Improvement of Consortium's or Member-institution's Facilities">
                                        </option>
                                        <option value="Planning/Consultation Activities"></option>
                                        <option value="AIHRS/Sectoral Reviews"></option>
                                        <option value="RSRDH"></option>
                                        <option value="Regional Fairs/Exhibits(e.g. Fiesta, etc)"></option>
                                        <option value="Annual Contribution"></option>
                                    </datalist>
                                    <div class="invalid-feedback">Missing activity type</div>
                                </div>


                                <div class="col-md-12 form-group">
                                    <label for="program_title" class=" font-weight-bold">Activity Title<span
                                            class="text-danger">*</span></label></label>
                                    <textarea class="form-control" id="program_title" name="activity_title" style="height: 100px"
                                        placeholder="Enter activity title" required></textarea>
                                    <div class="invalid-feedback">Missing title</div>
                                </div>


                                <div class="col-md-4 form-group">
                                    <label for="approved_budget" class=" font-weight-bold">Shared Amount<span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="shared_amount" id="shared_amount" class="form-control"
                                        placeholder="Amount" required>
                                    <div class="invalid-feedback">Missing shared amount</div>
                                </div>


                                <div class="col-md-12 form-group">
                                    <label for="program_title" class=" font-weight-bold">Remarks<span
                                            class="text-danger">*</span></label></label>
                                    <textarea class="form-control" id="program_title" name="remarks" style="height: 100px" placeholder="Enter N/A if none."
                                        required></textarea>
                                    <div class="invalid-feedback">Missing remarks</div>
                                </div>


                                <div class="col-md-4 form-group float-right">
                                    <a href="{{ url('rdmc-activities') }}" class="btn btn-default">Back</a>
                                    <button type="submit" id="submit" class="btn btn-primary btn-m ">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        var selectBox = document.getElementById("year");
        selectBox.onchange = function() {
            var textbox = document.getElementById("textYear");
            textbox.value = this.value;
        };
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        function formatNumber(e) {
            var rex = /(^\d{2})|(\d{1,3})(?=\d{1,3}|$)/g,
                val = this.value.replace(/^0+|\.|,/g, ""),
                res;

            if (val.length) {
                res = Array.prototype.reduce.call(val, (p, c) => c + p) // reverse the pure numbers string
                    .match(rex) // get groups in array
                    .reduce((p, c, i) => i - 1 ? p + "," + c : p + "." + c); // insert (.) and (,) accordingly
                res += /\.|,/.test(res) ? "" : ".0"; // test if res has (.) or (,) in it
                this.value = Array.prototype.reduce.call(res, (p, c) => c + p); // reverse the string and display
            }
        }

        var ni = document.getElementById("numin");
        var ni2 = document.getElementById("numin2");

        ni.addEventListener("keyup", formatNumber);
        ni2.addEventListener("keyup", formatNumber);
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#form_of_development, #address, #year')
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
            const startDate = document.getElementById('year').value;
            const endDate = document.getElementById('year').value;
            if (!endDate) {
                event.preventDefault();
                document.getElementById('form_of_development').classList.add('is-invalid');
            }
            if (!startDate) {
                event.preventDefault();
                document.getElementById('year').classList.add('is-invalid');
            }
            if (!startDate && !endDate) {
                event.preventDefault();
                document.getElementById('year').classList.add('is-invalid');
                document.getElementById('form_of_development').classList.add('is-invalid');
            }
        });

        $(document).ready(function() {
            $('#techForm').on('submit', function(e) {

                var formData = new FormData(this);

                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('add-activities') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Activity Added Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        }).then((result) => {
                            if (result.dismiss) {
                                window.location.href = '/rdmc-activities';
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
