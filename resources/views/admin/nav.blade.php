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
            <li class="{{ (request()->is('admin')) ? 'active' : '' }}">
                <a href="{{ url('/admin') }}"><i class="fa fa-th-large"></i> <span
                        class="nav-label">Dashboards</span></a>
            </li>
            <li class="{{ (request()->is('admin/doctors') || request()->is('admin/doctors/*')) ? 'active' : '' }}">
                <a href="#"><i class="fa fa-stethoscope"></i>
                    <span class="nav-label">Doctors</span>
                    <span class="float-right label label-primary">500</span>
                </a>
                <ul class="nav nav-second-level">
                    <li class="{{ (request()->is('admin/doctors')) ? 'active' : '' }}">
                        <a href="{{ url('admin/doctors/view-all') }}">View</a>
                    </li>
                    <li class="{{ (request()->is('admin/add-doctor')) ? 'active' : '' }}">
                        <a href="{{ url('admin/doctors/add') }}">Add</a>
                    </li>
                </ul>
            </li>
            <li class="{{ (request()->is('admin/patients/*')) ? 'active' : '' }}">
                <a href="{{ url('/admin') }}"><i class="fa fa-th-large"></i> <span
                        class="nav-label">Patients</span></a>
            </li>
            {{--            <li class="{{ (request()->is('admin/patients/*')) ? 'active' : '' }}">--}}
            {{--                <a href="#"><i class="fa fa-user-circle-o"></i>--}}
            {{--                    <span class="nav-label">Patients</span>--}}
            {{--                    <span class="float-right label label-primary">500</span>--}}
            {{--                </a>--}}
            {{--                <ul class="nav nav-second-level">--}}
            {{--                    <li class="{{ (request()->is('admin/patients/view-all')) ? 'active' : '' }}">--}}
            {{--                        <a href="{{ url('admin/patients/view-all') }}">View</a>--}}
            {{--                    </li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}
            <li class="{{ (request()->is('admin/posts/*') || request()->is('admin/posts')) ? 'active' : '' }}">
                <a href="{{ route('view_all_posts') }}"><i class="fa fa-newspaper-o"></i>
                <span class="nav-label">Posts</span>
            </a>
            </li>
            <li class="{{ (request()->is('admin/messages/*')) ? 'active' : '' }}">
                <a href="{{ url('/admin/view/messages/all') }}">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="nav-label">Messages</span>
                    <span class="float-right label label-primary">{{ getTotalMessages() }}</span>
                </a>
            </li>
            <li class="{{ (request()->is('admin/view/medicine/*')) ? 'active' : '' }}">
                <a href="{{ url('/admin/view/medicine/all') }}">
                    <i class="fa fa-newspaper-o"></i>
                    <span class="nav-label">Medicine</span>
                </a>
            </li>
            <li class="{{ (request()->is('admin/view/category/*')) ? 'active' : '' }}">
                <a href="{{ url('/admin/view/category/all') }}">
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
