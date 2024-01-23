@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <div class="d-flex mt-3">
                            <form id="techForm" class="row g-3 needs-validation" novalidate>
                                @csrf
                                <div class="form-title col-12">
                                    <h2 class="font-weight-bold">Regional Symposium Highlights</h2>
                                    <h5 class="mt-0"> Kindly fill-out the fields needed.</h5>
                                </div>

                                <div class="col-md-4 form-group">
                                    <label for="category" class=" font-weight-bold">Category<span
                                            class="text-danger">*</span></label>
                                    <select id="category" name="regional_category" class="form-control others" required>
                                        <option selected disabled value="">Select the project category</option>
                                        <option value="Research"
                                            {{ 'Research' == $all->regional_category ? 'selected' : '' }}>Research
                                            Category</option>
                                        <option value="Development"
                                            {{ 'Development' == $all->regional_category ? 'selected' : '' }}>Development
                                            Category</option>
                                    </select>
                                    <div class="invalid-feedback">Missing category</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="category" class=" font-weight-bold">Title<span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ $all->regional_title }}"
                                        name="regional_title" placeholder="Enter title" required>
                                    <div class="invalid-feedback">Missing title</div>
                                </div>

                                @php
                                    $imp = json_decode($all->regional_implementing_agency);
                                @endphp

                                <div class="col-md-12 form-group">
                                    <label for="awards_recipients" class=" font-weight-bold">Implementing Agency<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control implementing_agency" id="awards_recipients"
                                        name="regional_implementing_agency[]" multiple="multiple" required>
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
                                    $res = json_decode($all->regional_researchers);
                                @endphp
                                <div class="col-md-10 form-group">
                                    <label for="awards_recipients" class=" font-weight-bold">Researcher(s)<span
                                            class="text-danger">*</span></label>
                                    <select class="form-control researchers" id="regional_researchers"
                                        name="regional_researchers[]" multiple="multiple" required>
                                        @foreach ($researchers as $row)
                                            <option value="{{ $row->id }}"
                                                {{ in_array($row->id, $res) ? 'selected' : '' }}>
                                                {{ $row->first_name . ' ' . $row->middle_name . ' ' . $row->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Missing researchers</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="program_title" class=" font-weight-bold">Major Recommendations<span
                                            class="text-danger">*</span></label></label>
                                    <textarea class="form-control" id="program_title" name="regional_recommendations" style="height: 100px"
                                        placeholder="Enter recommendations" required>{{ $all->regional_recommendations }}</textarea>
                                    <div class="invalid-feedback">Missing recommendations</div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="program_title" class=" font-weight-bold">Winners<span
                                            class="text-danger">*</span></label></label>
                                    <input type="text" class="form-control" name="regional_winners"
                                        placeholder="Enter winners" value="{{ $all->regional_winners }}" required>
                                    <div class="invalid-feedback">Missing recommendations</div>
                                </div>

                                <div class="col-md-4 form-group float-right">
                                    <a href="{{ url('rdmc-regional') }}" class="btn btn-default">Back</a>
                                    <button type="submit" id="submit" class="btn btn-primary btn-m ">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script></script>

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
                                // toast: true,
                                // position: 'top-right',
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
                    url: "{{ url('update-regional/' . $all->id) }}",
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
                                window.location.href = '/rdmc-regional';
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
