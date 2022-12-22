<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <a href="/" class="navbar-brand">
        <img src="{{ asset('logo/logo-uiii.png') }}" class="brand-image" style="opacity: .8">
        </a>

        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="/" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="/contact-us" class="nav-link">Contact</a>
            </li>
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Menu</a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                    {{-- <li><a href="#" class="dropdown-item"></a></li> --}}
                    <li><a href="/news" class="dropdown-item">News</a></li>

                    @can('admin-list')
                        <li class="dropdown-divider"></li>

                    <!-- Level two dropdown-->
                    <li class="dropdown-submenu dropdown-hover">
                        <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Settings</a>
                        <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                            @can('quote-list')
                                <li><a href="/quotes" class="dropdown-item">Manage quote</a></li>
                            @endcan
                            @can('news-list')
                                <li><a href="/contents" class="dropdown-item">Manage Content</a></li>
                            @endcan
                            @can('user-list')
                                <li><a href="{{ route('users.index') }}" class="dropdown-item">Users</a></li>
                            @endcan
                            @can('position-list')
                            <li><a href="{{ route('positions.index') }}" class="dropdown-item">Positions</a></li>
                            @endcan
                            @can('role-list')
                            <li><a href="{{ route('roles.index') }}" class="dropdown-item">Roles</a></li>
                            @endcan
                            @can('permission-list')
                            <li><a href="{{ route('permissions.index') }}" class="dropdown-item">Permissions</a></li>
                            @endcan
                        </ul>
                    </li>
                    <!-- End Level two -->
                    @endcan
                </ul>
            </li>
        </ul>
        </div>

        <!-- Right navbar links -->
        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                {{-- <img src="{{ asset(Storage::url(session('user')->avatar ?? 'dist/img/user.png')) }}" class="user-image img-circle elevation-2"> --}}
                <span class="d-none d-md-inline">{{ session('user')->fullname }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header-1 bg-primary">
                    {{-- <img src="{{ asset(Storage::url(session('user')->avatar ?? 'dist/img/user.png')) }}" class="img-circle elevation-2"> --}}

                    <p>
                    {{ session('user')->fullname }}
                    <br>
                    <small>{{ session('user')->nrp }} -
                    @if (empty(session('user')->position))
                        No Jabatan
                    @else
                        {{ session('user')->position }}
                    @endif</small>
                    {{-- <small>Entry since {{ \Carbon\Carbon::parse(session('user')->created_at)->format('M Y') }}</small> --}}
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <a href="/profile/{{ session('user')->id }}/index" class="btn btn-default btn-flat">Profile</a>
                    <a class="d-inline float-right">
                    <form action="/logout" method="post">
                        @csrf
                        <button class="btn btn-danger" id="logout" name="logout" type="submit">Logout</button>
                    </form>
                    </a>
                </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
