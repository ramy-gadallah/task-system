<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo"
           href="{{ auth()->guard('admin')->check() ? route('admin.home') : route('user.home') }}">
            <img src="{{ asset('admin/assets/images/Rectangle_626-removebg-preview.png') }}" alt="logo" />
        </a>
    </div>
    <ul class="nav">
        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">
                            @auth('admin')
                                {{ Auth::guard('admin')->user()->name }}
                                {{ Auth::guard('admin')->user()->email }}
                            @endauth
                            @auth('user')
                                {{ Auth::guard('user')->user()->name }}
                                {{ Auth::guard('user')->user()->email }}
                            @endauth
                        </h5>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('admin.home') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-speedometer"></i>
                </span>
                <span class="menu-title">Home</span>
            </a>
        </li>
        @auth('user')
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('users_tasks.index') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-account"></i>
                    </span>
                    <span class="menu-title">Tasks User</span>
                </a>
            </li>
        @endauth
        @auth('admin')
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('admins.index') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-account"></i>
                    </span>
                    <span class="menu-title">Admin</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-account"></i>
                    </span>
                    <span class="menu-title">Users</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('tasks.index') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-account"></i>
                    </span>
                    <span class="menu-title">Tasks</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('sub.index') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-account"></i>
                    </span>
                    <span class="menu-title">Sub Tasks</span>
                </a>
            </li>
            <li class="nav-item menu-items">
                <a class="nav-link" href="{{ route('assign.index') }}">
                    <span class="menu-icon">
                        <i class="mdi mdi-account"></i>
                    </span>
                    <span class="menu-title">Assign Tasks</span>
                </a>
            </li>
        @endauth
    </ul>
</nav>
