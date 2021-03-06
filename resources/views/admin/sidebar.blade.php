<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{url('/dashboard')}}" class="brand-link text-center logo-padding">Barangay Logo</a><br>

    <div class="sidebar" >
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header text-white">MAIN MENU</li>

                <li class="nav-item mb-2">
                    <a href="{{ route('adminDashboard') }}" class="nav-link {{ Request::is('admin/dashboard')? 'active': '' }}">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header mt-2 text-white">BARANGAY SETTINGS</li>
                @can('Settings')
                    <li class="nav-item mb-2">
                        <a href="#" class="nav-link {{ Request::is('settings/*')? 'active': '' }}">
                            <i class="nav-icon fas fa-gears"></i>
                            <p>Settings<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('barangay') }}" class="nav-link">
                                    <i class="ml-4 nav-icon fas fa-address-card"></i>
                                    <p>Barangay Profile</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('barangay') }}" class="nav-link">
                                    <i class="ml-4 nav-icon fa-solid fa-elevator"></i>
                                    <p>Barangay Officials</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('purok') }}" class="nav-link">
                                    <i class="ml-4 nav-icon fas fa-chart-area"></i>
                                    <p>Purok</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endcan

                <li class="nav-header mt-2 text-white">BARANGAY MANAGEMENT</li>

                <li class="nav-item mb-2">
                    <a href="#" class="nav-link {{ Request::is('users/*')? 'active': '' }}">
                        <i class=" nav-icon fa-solid fa-user"></i>
                        <p>User Management<i class="fas fa-angle-left right"></i></p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="ml-4 nav-icon fa-solid fa-user"></i>
                                <p>
                                    Manage Users
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="" class="nav-link">
                                <i class="ml-4 nav-icon fa-solid fa-book"></i>
                                <p>
                                    User Logs
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>


                @can('Citizens')
                    <li class="nav-item mb-2">
                        <a href="{{ route('citizens') }}" class="nav-link {{ Request::is('citizen/*')? 'active': '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Citizens
                            </p>
                        </a>
                    </li>
                @endcan

                @can('Household Profiling')
                    <li class="nav-item mb-2">
                        <a href="" class="nav-link">
                            <i class="nav-icon fa-solid fa-people-roof"></i>
                            <p>Household Profiling</p>
                        </a>
                    </li>
                @endcan

                @can('Blotter Management')
                    <li class="nav-item"><li class="nav-item mb-2">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-tasks-alt"></i>
                            <p>
                                Blotter Management
                            </p>
                        </a>
                    </li>
                @endcan

                @can('Events')
                    <li class="nav-item"><li class="nav-item mb-2">
                        <a href="{{ route('events') }}" class="nav-link {{ Request::is('events/*')? 'active': '' }}">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>
                                Events
                            </p>
                        </a>
                    </li>
                @endcan

                @can('Certificates')
                    <li class="nav-item mb-2">
                        <a href="{{ route('form') }}" class="nav-link {{ Request::is('generate/certificates')? 'active': '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>
                                Certificates
                            </p>
                        </a>
                    </li>
                @endcan

                @can('Visitors Logbook')
                    <li class="nav-item"><li class="nav-item mb-2">
                        <a href="{{ route('visitor.get') }}" class="nav-link {{ Request::is('visitor/all')? 'active': '' }}">
                            <i class='nav-icon bx bxs-book-content'></i>
                            <p>
                                Visitors Log Book
                            </p>
                        </a>
                    </li>
                @endcan

                @can('Citizens Request')
                    <li class="nav-item"><li class="nav-item mb-2">
                        <a href="" class="nav-link">
                            <i class="nav-icon fas fa-user-edit"></i>
                            <p>
                                Citizens Requests
                            </p>
                        </a>
                    </li>
                @endcan

                <li class="nav-item"><li class="nav-item mb-2">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Generate Reports
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

<style>
    .nav-link{
        font-size: 15px !important;
    }

    .sidebar-dark-primary, .main-sidebar, .brand-link{
        background-color: #215476 !important;
    }
    .logo-padding{
        padding: 30px;
    }
    i, .fas fa-circle{
        width: 10px;
    }
    .text-white{
        color: #fff !important;
        opacity: 1 !important;
    }

</style>
