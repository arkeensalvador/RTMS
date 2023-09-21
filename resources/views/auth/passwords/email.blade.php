<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RMTS | Login</title>

    <link rel="icon" href="{{ asset('backend/dist/img/favicon.ico') }}" type="image/x-icon" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ mix('resources/css/app.css') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>


<body class="reset">
    <div class="container-xl text-center">
        <div class="row" style="align-items: center;">
            <div class="col-6 left-wrapper">
                <div class="img-logo-left-wrap">
                    <img src="{{ asset('backend/dist/img/claarrdec.png') }}" class="img-fluid" alt="claarrdec.png">
                </div>

                <div class="page-title-description">
                    <h1 class="page-title-desktop">CLAARRDEC</h1>
                    <p class="page-description-desktop">REAL TIME MONITORING SYSTEM</p>
                </div>
            </div>

            <div class="col-6">
                <div class="col-9 card-reset">
                    <div class="card card-outline card-primary">
                        <div class="card-header text-center">
                            <a href="{{ route('password.request') }}" class="h1"><b>Reset Password</b></a>
                        </div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="email"
                                            class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                        <div class="col-md-7">
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Send Link') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                       
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    Swal.fire({
                        icon: 'info',
                        title: "{{ Session::get('message') }}",
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 900
                    })
                    // toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    Swal.fire({
                        icon: 'success',
                        title: "{{ Session::get('message') }}",
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 900
                    })
                    // toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    Swal.fire({
                        icon: 'warning',
                        title: "{{ Session::get('message') }}",
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 900
                    })

                    // toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    Swal.fire({
                        icon: 'error',
                        title: "{{ Session::get('message') }}",
                        timerProgressBar: true,
                        showConfirmButton: false,
                        timer: 900
                    })

                    // toastr.error("{{ Session::get('message') }}");
                    break;

                case 'test':
                    Swal.fire({
                        icon: 'success',
                        title: "{{ Session::get('message') }}",
                        text: 'Are there any Project associated with this Program?',
                        // type: 'success',
                        showDenyButton: true,
                        showCloseButton: true,
                        confirmButtonText: 'Yes',
                        denyButtontext: 'No',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = 'program-projects-add';
                        }
                        // else {
                        //     window.location.href = 'projects-add';
                        // }
                    });

                    // toastr.error("{{ Session::get('message') }}");
                    break;

                case 'project':
                    Swal.fire({
                        icon: 'success',
                        title: "{{ Session::get('message') }}",
                        text: 'Are there any studies/sub-projects associated with this Project?',
                        // type: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'None',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = 'sub-projects-add';
                        }
                        // else {
                        //     window.location.href = 'projects-add';
                        // }
                    });

                    // toastr.success("{{ Session::get('message') }}");
                    break;

                case 'project':
                    Swal.fire({
                        icon: 'success',
                        title: "{{ Session::get('message') }}",
                        text: 'Are there any studies/sub-projects associated with this Project?',
                        // type: 'success',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'None',
                        allowEscapeKey: false,
                        allowOutsideClick: false,
                        reverseButtons: true
                    }).then((result) => {
                        if (result.value) {
                            window.location.href = 'sub-projects-add';
                        }
                        // else {
                        //     window.location.href = 'projects-add';
                        // }
                    });

                    // toastr.success("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
</body>

</html>
