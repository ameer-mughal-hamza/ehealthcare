<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
        </div>
        <ul class="nav navbar-top-links navbar-right">
            <li style="padding: 20px">
                <span class="m-r-sm text-muted welcome-message">Welcome {{ auth()->user()->name }}</span>
            </li>
            <li>
                <a href="{{ url('logout') }}">
                    <i class="fa fa-sign-out"></i> Log out
                </a>
            </li>
        </ul>
    </nav>
</div>
