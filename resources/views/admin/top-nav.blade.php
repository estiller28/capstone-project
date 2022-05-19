<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link active">Barangay {{ auth()->user()->barangay->barangay_name  }}</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">No new notifications</span>
                <div class="dropdown-divider"></div>
                {{--                <a href="#" class="dropdown-item">--}}
                {{--                    <i class="fas fa-envelope mr-2"></i> 4 new messages--}}
                {{--                    <span class="float-right text-muted text-sm">3 mins</span>--}}
                {{--                </a>--}}
                {{--                <div class="dropdown-divider"></div>--}}
                {{--                <a href="#" class="dropdown-item">--}}
                {{--                    <i class="fas fa-users mr-2"></i> 8 friend requests--}}
                {{--                    <span class="float-right text-muted text-sm">12 hours</span>--}}
                {{--                </a>--}}
                {{--                <div class="dropdown-divider"></div>--}}
                {{--                <a href="#" class="dropdown-item">--}}
                {{--                    <i class="fas fa-file mr-2"></i> 3 new reports--}}
                {{--                    <span class="float-right text-muted text-sm">2 days</span>--}}
                {{--                </a>--}}
                {{--                <div class="dropdown-divider"></div>--}}
                {{--                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>--}}
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>

        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle px-2" data-toggle="dropdown">
                <span class="d-none d-md-inline">{{auth()->user()->name}}</span>
                <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="user-image img-circle elevation-2">
            </a>
            <ul class="dropdown-menu dropdown-menu-sm-left">
                <span class="dropdown-header font-weight-bold"><h6 class="mt-2">{{ Auth::user()->name }}</h6></span>

                <a href="{{ route('my.profile') }}" class="dropdown-item">
                    <i class="nav-icon fas fa-user mr-3"></i> My Profile
                </a>

                <a href="#" class="dropdown-item">
                    <i class="fas fa-cog mr-3"></i> Settings
                </a>

                <div class="dropdown-divider"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="dropdown-item"
                       onclick="event.preventDefault();
                    this.closest('form').submit();">
                        <i class="fas fa-sign-out mr-3"></i>
                        Log out
                    </a>
                </form>
                <div class="dropdown-divider"></div>
            </ul>
        </li>
    </ul>
</nav>


<style>
    .navbar-nav>.user-menu>.dropdown-menu{
        width: 230px !important;
    }
</style>
