<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('backend/dist/img/favicon.ico') }}" type="image/x-icon" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ mix('resources/css/app.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>RTMS | Login</title>
</head>

<body class="login">

    <div class="container login" id="container">
        <div class="form-container forgot">
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <h1 class="font-weight-bold">Forgot Password</h1>
                <span class="text-center mb-3">Please enter your registered email to reset your password, then check
                    your email inbox.</span>
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email" required>

                <button type="submit">{{ __('Send Link') }}</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1 style="color: #0DA603;" class="font-weight-bold">Welcome!</h1>
                {{-- <h1 class="font-weight-bold mb-1">Sign In</h1> --}}
                <span class="mb-1">Enter your email and password to log in!</span>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <a href="#" id="forgot">Forget Your Password?</a>

                <button type="submit">Sign In</button>
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <img src="{{ asset('backend/dist/img/claarrdec.png') }}" style=" height: 30%;">
                    <h1 class="font-weight-bold">CLAARRDEC</h1>
                    <h2>Real-Time Monitoring System</h2>
                    <!-- <h1 class="font-weight-bold">Forgot Password</h1> -->
                    <button class="hidden" id="login"><i class="fa-solid fa-circle-left"></i> Back to Sign
                        In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <img src="{{ asset('backend/dist/img/claarrdec.png') }}" style=" height: 30%;">
                    <h1 class="font-weight-bold">CLAARRDEC</h1>
                    <h2>Real-Time Monitoring System</h2>
                </div>
            </div>
        </div>
    </div>

    <script>
        const container = document.getElementById('container');
        const forgotBtn = document.getElementById('forgot');
        const loginBtn = document.getElementById('login');

        forgotBtn.addEventListener('click', () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener('click', () => {
            container.classList.remove("active");
        });
    </script>

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
                        toast: true,
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
                    });
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
