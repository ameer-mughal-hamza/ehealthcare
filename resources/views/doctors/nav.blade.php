<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="{{ asset('img/profile_small.jpg') }}"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">Ameer Hamza</span>
                        <span class="text-muted text-xs block">Admin <b class="caret"></b></span>
                    </a>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="{{ (request()->is('doctor/dashboard')) ? 'active' : '' }}">
                <a href="{{ url('/doctor/dashboard') }}"><i class="fa fa-th-large"></i> <span
                        class="nav-label">Dashboard</span></a>
            </li>
            <li class="{{ (request()->is('doctor/prescriptions') || request()->is('doctor/prescriptions/*')) ? 'active' : '' }}">
                <a href="{{ url('/doctor/prescriptions') }}"><i class="fa fa-file"></i> <span
                        class="nav-label">Patients</span></a>
            </li>
            <li class="{{ (request()->is('doctor/account-settings')) ? 'active' : '' }}">
                <a href="{{ url('/doctor/account-settings') }}">
                    <i class="fa fa-user-circle"></i>
                    <span class="nav-label">Profile</span>
                </a>
            </li>
            <li class="{{ (request()->is('doctor/change-password')) ? 'active' : '' }}">
                <a href="{{ url('/doctor/change-password') }}">
                    <i class="fa fa-lock"></i>
                    <span class="nav-label">Change Password</span>
                </a>
            </li>
            <li class="landing_link">
                <a target="_blank" href="{{ url('/home') }}" aria-expanded="false">
                    <i class="fa fa-star"></i>
                    <span class="nav-label">Landing Page</span>
                </a>
            </li>
        </ul>

    </div>
</nav>
