<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RMTS | Login</title>

    <link rel="icon" href="{{ asset('backend/dist/img/favicon.ico') }}" type="image/x-icon" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
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


<body class="login">
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
                <div class="col-6 card-login">
                    <div class="card card-outline card-primary">
                        <div class="card-header text-center">
                            <a href="{{ route('login') }}" class="h1"><b>RTMS Login</b></a>
                        </div>
                        <div class="card-body">
                            <p class="login-box-msg">Sign in to start your session</p>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="email" name="email" class="form-control" placeholder="Email">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" name="password" class="form-control" placeholder="Password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-login">

                                    <!-- /.col -->
                                    <div class="col-4">
                                        <button type="submit" id="login" class="btn btn-primary btn-block">Sign
                                            In</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>

                            <p class="mb-0 mt-3">
                                @if (Route::has('password.request'))
                                <a class="text-center" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </p>
                            {{-- <p class="mb-0">
                                <a href="{{ route('register') }}" class="text-center">Register a new membership</a>
                            </p> --}}
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
        @if(Session::has('message'))
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