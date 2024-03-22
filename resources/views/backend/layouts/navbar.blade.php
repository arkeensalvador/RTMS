{{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/paper-dashboard.css?v=2.0.1') }}" /> --}}
<nav class="main-header navbar navbar-expand">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('home') }}" class="nav-link">Home</a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Contact</a>
        </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img src="{{ asset(auth()->user()->profile_picture) }}" alt="User Photo" class="rounded-circle mr-2"
                    style="width: 35px; height: 35px; border: 1.8px solid #4f5962">
                <span class="mr-2">{{ auth()->user()->name }}</span>
            </a>
            <div class="user-dropdown-menu dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                <a class="user-dropdown-item dropdown-item" href="{{ url('profile/' . auth()->user()->id) }}"><i
                        class="fa-regular fa-address-card"></i>&nbsp;&nbsp;Profile</a>
                <a class="user-dropdown-item dropdown-item" href="{{ route('logout') }}" id="btn-logout">
                    <i class="nav-icon fas fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;Logout
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" hidden>
                        @csrf
                    </form>
                </a>
                {{-- <a class="user-dropdown-item dropdown-item" href="#">Another action</a>
                <a class="user-dropdown-item dropdown-item" href="#">Something else here</a> --}}
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            {{-- {{ $agency->abbrev}} --}}
        </li>
    </ul>
</nav>
