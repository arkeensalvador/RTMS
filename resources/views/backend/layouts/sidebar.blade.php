<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home" class="brand-link">
        <img src="{{ asset('img/claarrdec.png') }}" alt="CLAARRDEC Logo" class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text font-weight-light">RTMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 flex">
            <div class="image">
                @if (auth()->user()->role == 'Admin')
                    <img src="{{ asset(auth()->user()->profile_picture) }}" class="img-circle elevation-9 mb-2"
                        alt="User Image">
                @else
                    {{-- <img src="{{ asset('img/avatar4.png') }}" class="img-circle elevation-2" alt="User Image"> --}}
                    <img src="{{ asset(auth()->user()->profile_picture) }}" class="img-circle elevation-2"
                        alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{ URL::to('profile/' . auth()->user()->id) }}" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        {{-- ACTIVE MENU QUERY --}}
        @php
            $segment1 = Request::segment(1);
            $pages = [
                'report-index',
                'rdmc-index',
                'rdmc-monitoring-evaluation',
                'aihrs',
                'rdmc-projects',
                'rdmc-activities',
                'rdmc-linkages-index',
                'rdmc-dbinfosys-index',
                'strategic-activities',
                'rdru-index',
                'rdru-ttp',
                'rdru-ttm',
                'rdru-tta',
                'cbg-index',
                'cbg-training',
                'cbg-awards',
                'cbg-equipment',
                'projects-add',
                'edit-activity',
                'edit-activity',
                'rdmc-activities-add',
                'edit-no-program-project',
                'project-upload-file',
                'add-project-personnel',
                'rdmc-linkages-add',
                'edit-linkages',
                'rdmc-dbinfosys-add',
                'edit-dbinfosys',
                'add-strategic-index',
                'edit-strategic',
                'rdru-add',
                'rdru-ttm-add',
                'rdru-tpa-add',
                'edit-ttp',
                'edit-ttm',
                'edit-tpa',
                'cbg-training-add',
                'cbg-awards-add',
                'cbg-equipment-add',
                'edit-training',
                'edit-award',
                'edit-equipment',
                'view-project-index',
                'sub-projects-view',
                'view-subprojects',
                'sub-projects-add',
                'sub-project-upload-file',
                'add-sub-project-personnel',
                'projects-under-program',
                'cbg-meetings',
                'edit-meeting',
                'cbg-meetings-add',
                'rdru-tpa',
                'policy-index',
                'policy-prc',
                'policy-prc-add',
                'edit-prc',
                'policy-formulated',
                'policy-formulated-add',
                'edit-formulated',
                'cbg-contributions',
                'cbg-initiatives',
                'rdru-ttm-index',
                'rdru-tech-deployed',
                'rdru-add-tech-deployed-index',
                'rdru-edit-tech-deployed-index',
                'strategic-index',
                'strategic-tech-list',
                'add-strategic-tech-list-index',
                'edit-strategic-tech-list-index',
                'strategic-collaborative-list',
                'add-strategic-collaborative-list-index',
                'edit-strategic-collaborative-list-index',
                'rdmc-regional-add',
                'edit-regional',
                'rdmc-regional',
                'edit-strategic-program-list-index',
                'add-strategic-program-list-index',
                'strategic-program-list',
                'edit-project',
                'rdmc-regional-participants',
            ];
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
                        class="nav-link {{ Request::is('researcher-index', 'edit-researcher/*', 'view-researcher/*', 'researcher-add') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Researchers
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ URL::to('/all-templates') }}"
                        class="nav-link {{ Request::is('all-templates') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-scroll"></i>
                        <p>
                            Templates
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
                <li class="nav-item has-treeview">
                    <a class="nav-link" href="{{ route('logout') }}" id="btn-logout">
                        <i class="nav-icon fas fa-solid fa-right-from-bracket"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none" hidden>
                        @csrf

                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
