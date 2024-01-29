<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('backend/dist/img/favicon.ico') }}" type="image/x-icon" />
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}" />

    <title>RTMS | Login</title>
</head>

<body class="login-body">

    <div class="container login" id="container">
        <div class="form-container forgot">
            <form action="{{ route('password.email') }}" method="POST"
                onsubmit="showAlert('Sending request. This may take a moment.');">
                @csrf
                <h1 class="font-weight-bold">Forgot Password</h1>
                <span class="text-center mb-3">Please enter your registered email to reset your password, then check
                    your email inbox.</span>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    autocomplete="email" autofocus placeholder="Email" required>

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
                <a href="#" id="forgot">Forgot password?</a>

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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function showAlert(message) {
            Swal.fire({
                // icon: 'info',
                imageUrl: "https://i.ibb.co/1q3p6Cg/loading.gif",
                text: message,
                allowOutsideClick: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                }
            });
            setTimeout(function() {

            }, 15000);
        }
    </script>
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
                case 'error':
                    Swal.fire({
                        icon: 'error',
                        position: 'center',
                        title: "{{ Session::get('message') }}",
                        timerProgressBar: true,
                        // toast: true,
                        showConfirmButton: false,
                        timer: 1000
                    })
                    // toastr.error("{{ Session::get('message') }}");
                    break;

                case 'success':
                    Swal.fire({
                        icon: 'success',
                        title: "{{ Session::get('message') }}",
                        // timerProgressBar: true,
                        // toast: true,
                        // showConfirmButton: false,
                        // timer: 1000
                    })
                    // toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
</body>

</html>
