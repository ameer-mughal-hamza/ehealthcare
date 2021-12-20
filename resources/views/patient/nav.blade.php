<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="{{ asset('img/profile_small_thumbnail.jpg') }}"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">{{ auth()->user()->name }}</span>
                        <span class="text-muted text-xs block">Patient </span>
                    </a>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="{{ (request()->is('patient/dashboard')) ? 'active' : '' }}">
                <a href="{{ url('/patient/dashboard') }}"><i class="fa fa-th-large"></i> <span
                        class="nav-label">Dashboards</span></a>
            </li>
            <li class="{{ (request()->is('patient/prescriptions/*') || request()->is('patient/prescription/*')) ? 'active' : '' }}">
                <a href="{{ url('/patient/prescriptions') }}"><i class="fa fa-file"></i> <span
                        class="nav-label">Prescriptions</span></a>
            </li>
            <li class="{{ (request()->is('patient/account-settings')) ? 'active' : '' }}">
                <a href="{{ url('/patient/change-password') }}">
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
