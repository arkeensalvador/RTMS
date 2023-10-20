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
    <title>RTMS | Login</title>
</head>

<body class="login">

    <div class="container login" id="container">
        <div class="form-container sign-in">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <h1 class="font-weight-bold mb-1">Reset Password</h1>
                <span class="mb-1">{{ __('Email Address') }}</span>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ $email ?? old('email') }}" required readonly autocomplete="email"
                    autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <span class="mb-1">{{ __('Password') }}</span>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password" placeholder="Password">


                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password" placeholder="Confirm Password">

                <button type="submit"> {{ __('Reset Password') }}</button>
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


</body>

</html>
