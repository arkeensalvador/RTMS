<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home" class="brand-link">
        <img src="{{ asset('backend/dist/img/CLAARRDEC.png') }}" alt="CLAARRDEC Logo" class="brand-image img-circle"
            style="opacity: .8">
        <span class="brand-text font-weight-light">RTMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (auth()->user()->role == 'Admin')
                    <img src="{{ asset('backend/dist/img/AdminLTElogo.png') }}" class="img-circle elevation-2"
                        alt="User Image">
                @else
                    <img src="{{ asset('backend/dist/img/avatar4.png') }}" class="img-circle elevation-2"
                        alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ auth()->user()->name }} - {{ auth()->user()->role }}</a>
            </div>
        </div>

        {{-- ACTIVE MENU QUERY --}}
        @php
            $segment1 = Request::segment(1);
            $pages = ['report-index', 'rdmc-index', 'rdmc-monitoring-evaluation', 'aihrs', 'rdmc-projects', 'rdmc-activities', 'rdmc-linkages-index', 'rdmc-dbinfosys-index', 'strategic-activities', 'rdru-index', 'rdru-ttp', 'rdru-ttm', 'rdru-tta', 'cbg-index', 'cbg-training', 'cbg-awards', 'cbg-equipment', 'projects-add', 'edit-activity', 'edit-activity', 'rdmc-activities-add', 'edit-no-program-project', 'project-upload-file', 'add-project-personnel', 'rdmc-linkages-add', 'edit-linkages', 'rdmc-dbinfosys-add', 'edit-dbinfosys', 'add-strategic-index', 'edit-strategic', 'rdru-add', 'rdru-ttm-add', 'rdru-tpa-add', 'edit-ttp', 'edit-ttm', 'edit-tpa', 'cbg-training-add', 'cbg-awards-add', 'cbg-equipment-add', 'edit-training', 'edit-award', 'edit-equipment', 'view-project-index', 'sub-projects-view', 'view-subprojects', 'sub-projects-add', 'sub-project-upload-file', 'add-sub-project-personnel'];
        @endphp



        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ URL::to('home') }}" class="nav-link {{ set_active(['home']) }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ URL::to('report-index') }}"
                        class="nav-link @if (in_array($segment1, $pages)) active @endif">
                        <i class="nav-icon fa-solid fa-book-journal-whills"></i>
                        <p>
                            Add Report
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ URL::to('rdmc-programs') }}"
                        class="nav-link  {{ Request::is(
                            'rdmc-programs',
                            'rdmc-choose-program',
                            'rdmc-create-program',
                            'projects-u-program-add',
                            'view-program-index/*',
                            'upload-file/*',
                            'edit-program-index/*',
                            'add-program-personnel-index/*',
                            'projects-u-program-add/*',
                        )
                            ? 'active'
                            : '' }}">
                        <i class="nav-icon fas fa-diagram-project"></i>
                        <p>
                            Programs
                        </p>
                        {{-- <i class="fas fa-angle-left right"></i> --}}
                    </a>
                </li>
                @if (auth()->user()->role == 'Admin')
                    <li class="nav-item">
                        <a href="{{ URL::to('report-list') }}"
                            class="nav-link {{ Request::is('report-list') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-list-ul"></i>
                            <p>
                                Reports
                            </p>
                        </a>
                    </li>
                @endif
                
                <li class="nav-item">
                    <a href="{{ URL::to('/researcher-index') }}"
                        class="nav-link {{ Request::is('researcher-index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Researchers
                        </p>
                    </a>
                </li>

                {{-- (auth()->user()->agencyID == 'CLSU') --}}
                
                @if (auth()->user()->role == 'Admin')
                    <li class="nav-item">
                        <a href="{{ URL::to('/all-agency') }}"
                            class="nav-link {{ Request::is('all-agency', 'edit-agency/*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>
                                Agency
                            </p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="{{ URL::to('/all-user') }}"
                            class="nav-link {{ Request::is('all-user', 'add-user-index', 'edit-user/*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-users-gear"></i>
                            <p>
                                Manage Accounts
                            </p>
                        </a>
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
