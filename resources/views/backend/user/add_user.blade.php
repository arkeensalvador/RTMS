@extends('backend.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-lg-1">

                </div>
                <div class="col-lg-12">

                    {{-- card start --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Add User
                            </h5>
                        </div>

                        {{-- card body start --}}
                        <div class="card-body">
                            <form id="techForm" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <img id="preview" src="#" alt="Preview"
                                        style="display: none; max-width: 400px; max-height: 400px;">
                                </div>

                                <div class="form-group row">
                                    <label for="profile_picture" class="col-sm-2 col-form-label">Profile Picture</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="profile_picture" id="profile_picture" accept="image/*"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Enter your name" required autocomplete="false">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Enter Email Address" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="agency" class="col-sm-2 col-form-label">Agency</label>
                                    <div class="col-sm-10">
                                        <select class="form-control agency" name="agencyID" id="" required>
                                            <option></option>
                                            @foreach ($all as $key)
                                                <option value="{{ $key->abbrev }}">{{ $key->agency_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="agency" class="col-sm-2 col-form-label">Role</label>
                                    <div class="col-sm-10">
                                        <select class="form-control others" name="role" id="" required>
                                            <option value="">--Select Role--</option>
                                            <option value="CMI">CMI</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" name="password" placeholder="Password"
                                            required>
                                    </div>
                                </div>

                                <a href="{{ url('all-user') }}" class="btn btn-default">Back</a>
                                <button type="submit" class="btn btn-success">Submit</button>

                            </form>
                        </div> {{-- card body end --}}
                    </div>{{-- card end --}}
                </div>
                <div class="col-lg-1">

                </div>
            </div>
        </section>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        // Preview uploaded image
        document.getElementById('profile_picture').addEventListener('change', function(event) {
            const preview = document.getElementById('preview');
            preview.style.display = 'block';
            preview.src = URL.createObjectURL(event.target.files[0]);
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#techForm').on('submit', function(e) {

                var formData = new FormData(this);

                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('insert-user') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: (data) => {
                        // this.reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'User Added Successfully',
                            timerProgressBar: true,
                            showConfirmButton: false,
                            timer: 900
                        }).then((result) => {
                            if (result.dismiss) {
                                window.location.href = '/all-user';
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
