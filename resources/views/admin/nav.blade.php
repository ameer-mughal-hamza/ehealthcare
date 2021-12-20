<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="{{ asset('img/profile_small_thumbnail.jpg') }}"/>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">{{ auth()->user()->name }}</span>
                        <span class="text-muted text-xs block">Admin</span>
                    </a>
                </div>
            </li>
            <li class="{{ (request()->is('admin/dashboard')) ? 'active' : '' }}">
                <a href="{{ url('/admin/dashboard') }}"><i class="fa fa-th-large"></i> <span
                        class="nav-label">Dashboard</span></a>
            </li>
            <li class="{{ (request()->is('admin/doctors') || request()->is('admin/doctors/*') || request()->is('admin/become-a-doctor/requests')) ? 'active' : '' }}">
                <a href="{{ url('/admin/doctors') }}"><i class="fa fa-stethoscope"></i>
                    <span class="nav-label">Doctors</span>
                </a>
                <ul class="nav nav-second-level">
                    <li class="{{ (request()->is('admin/doctors')) ? 'active' : '' }}">
                        <a href="{{ url('admin/doctors/view') }}">View</a>
                    </li>
                    <li class="{{ (request()->is('admin/become-a-doctor/requests')) ? 'active' : '' }}">
                        <a href="{{ url('admin/become-a-doctor/requests') }}">Requests</a>
                    </li>
                </ul>
            </li>
            <li class="{{ (request()->is('admin/prescriptions/*')) ? 'active' : '' }}">
                <a href="{{ url('/admin/prescriptions') }}"><i class="fa fa-th-large"></i> <span
                        class="nav-label">Patients</span></a>
            </li>
            <li class="{{ (request()->is('admin/posts/*') || request()->is('admin/posts')) ? 'active' : '' }}">
                <a href="{{ route('view_all_posts') }}"><i class="fa fa-newspaper-o"></i>
                    <span class="nav-label">Posts</span>
                </a>
            </li>
            <li class="{{ (request()->is('admin/messages/*') || request()->is('admin/messages')) ? 'active' : '' }}">
                <a href="{{ url('/admin/messages') }}">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="nav-label">Messages</span>
                    <span class="float-right label label-primary">{{ getTotalMessages() }}</span>
                </a>
            </li>
            <li class="{{ (request()->is('admin/medicines') || request()->is('admin/view/medicine/*') ) ? 'active' : '' }}">
                <a href="{{ url('/admin/medicines') }}">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="nav-label">Medicine</span>
                </a>
            </li>
            <li class="{{ (request()->is('admin/view/category/*') || request()->is('admin/categories')) ? 'active' : '' }}">
                <a href="{{ url('/admin/categories') }}">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="nav-label">Category</span>
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
