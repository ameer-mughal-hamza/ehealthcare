<div class="navbar-wrapper">
    <nav
        class="navbar navbar-default navbar-fixed-top navbar-expand-md"
        role="navigation"
    >
        <div class="container">
            <a class="navbar-brand" href="index.html">E Health Care</a>
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
                        <a class="nav-link page-scroll" href="{{ url('/contact') }}">Contact</a>
                    </li>
                    @if(!auth()->check())
                        <li>
                            <a class="nav-link page-scroll" href="{{ url('/login') }}">Login</a>
                        </li>
                    @else
                        <li style="margin-top: 23px;">
                            <form action="{{ url('/logout') }}" id="logout" method="post">
                                @csrf
                                <a type="submit" href="#" onclick="document.getElementById('logout').submit();"
                                   class="nav-link page-scroll">Logout</a>
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>
