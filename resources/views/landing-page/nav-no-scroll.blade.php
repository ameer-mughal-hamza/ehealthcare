<div class="navbar-wrapper">
    <nav class="navbar navbar-default navbar-fixed-top navbar-expand-md navbar-scroll" role="navigation">
        <div class="container">
            <a class="navbar-brand" href="{{ url('home') }}">E Health Care</a>
            <div class="navbar-header page-scroll">
                <button
                    class="navbar-toggler"
                    type="button"
                    data-toggle="collapse"
                    data-target="#navbar"
                >
                    <i class="fa fa-bars"></i>
                </button>
            </div>
            <div class="collapse navbar-collapse justify-content-end" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a class="nav-link page-scroll" href="{{ url('/home') }}">Home</a></li>
                    <li>
                        <a class="nav-link page-scroll" href="{{ url('/find-a-doctor') }}">Find a Doctor</a>
                    </li>
                    <li>
                        <a class="nav-link page-scroll" href="{{ url('/become-a-doctor') }}">Become a Doctor</a>
                    </li>
                    <li>
                        <a class="nav-link page-scroll" href="{{ url('/contact') }}">Contact</a>
                    </li>
                    @if(!auth()->check())
                        <li>
                            <a class="nav-link page-scroll" href="{{ url('/login') }}">Login</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ url('logout') }}" class="nav-link page-scroll">Logout</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>
