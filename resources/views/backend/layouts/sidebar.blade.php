<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home" class="brand-link">
        <img src="{{asset('backend/dist/img/CLAARRDEC.png')}}" alt="CLAARRDEC Logo" class="brand-image img-circle"
            style="opacity: .8">
        <span class="brand-text font-weight-light">RTMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(auth()->user()->role == 'Admin')
                <img src="{{asset('backend/dist/img/AdminLTElogo.png')}}" class="img-circle elevation-2"
                    alt="User Image">
                @else
                <img src="{{asset('backend/dist/img/avatar4.png')}}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}} - {{auth()->user()->role}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="home" class="nav-link {{ Route::current()->getName() == 'home' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @if(auth()->user()->role == 'Admin')

                <li class="nav-item">
                    <a href="publications-index" class="nav-link {{ Request::is('publications-index') ? 'active' : ''}}">
                       
                        <i class="nav-icon fa-solid fa-book-journal-whills"></i>
                        <p>
                            Publications
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="index" class="nav-link {{ Request::is('index', 'add-programs-index', 'edit-program-index/') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Programs
                        </p>
                        <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{URL::to('/index')}}"
                                class="nav-link {{ Request::is('index', 'view-program-index/') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Programs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{URL::to('/add-projects-index')}}"
                                class="nav-link {{ Request::is('') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Projects</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{URL::to('/add-projects-index')}}"
                                class="nav-link {{ Request::is('') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub Project</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{URL::to('/add-projects-index')}}"
                                class="nav-link {{ Request::is('') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Other</p>
                                <i class="fas fa-angle-left right"></i>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{URL::to('/all-projects')}}"
                                        class="nav-link {{ Request::is('') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Awards</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{URL::to('/add-projects-index')}}"
                                        class="nav-link {{ Request::is('') ? 'active' : '' }}">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Training</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link {{ Request::is('all-projects','add-projects-index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-diagram-project"></i>
                        <p>
                            Projects
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{URL::to('/all-projects')}}"
                                class="nav-link {{ Request::is('all-projects') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Projects</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{URL::to('/add-projects-index')}}"
                                class="nav-link {{ Request::is('add-projects-index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Project</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{URL::to('/all-agency')}}"
                        class="nav-link {{ Request::is('all-agency', 'edit-agency/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-building"></i>
                        <p>
                            Agency
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Manage Site
                        </p>
                    </a>

                </li>
                <li class="nav-item has-treeview">
                    <a href="{{URL::to('/all-user')}}" class="nav-link {{ Request::is('all-user','add-user-index', 'edit-user/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            User Management
                            {{-- <span class="right badge badge-danger">New</span> --}}
                            {{-- <i class="fas fa-angle-left right"></i> --}}
                        </p>
                    </a>
                    {{-- <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href=""
                                class="nav-link {{ Request::is('all-user') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>View Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{URL::to('/add-user-index')}}"
                                class="nav-link {{ Request::is('add-user-index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add User</p>

                            </a>
                        </li>
                    </ul> --}}
                </li>


                @endif
                {{-- logout --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                         Swal.fire({
                            title: 'Are you sure you want to Logout?',
                            icon: 'warning',
                            buttons: true,
                            confirmButtonText: 'Yes',
                            showCancelButton: true,
                            dangerMode: true,
                            allowEscapeKey: false,
                            allowOutsideClick: false,
                            })
                            .then((result) => {
                            if (result.value===true) {
                                Swal.fire({
                                    text: 'Logging out...',
                                    buttons: false,      
                                    allowEscapeKey: false,
                                    allowOutsideClick: false,
                                    timer: 1000,
                                    didOpen: () => {
                                    Swal.showLoading()
                                },
                                willClose: () => {
                                    document.getElementById('logout-form').submit();
                                }
                                })
                                
                            }
                        });">

                        <i class="nav-icon fas fa-solid fa-right-from-bracket"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf

                    </form>
                </li>
                <li class="nav-item">



                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>