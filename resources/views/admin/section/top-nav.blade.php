<!-- START HEADER-->
<header class="header">
    <div class="page-brand">
        <a class="link" href="{{ route('home') }}">
                    <span class="brand">Admin &nbsp;
                        <span class="brand-tip">MeroPasal</span>
                    </span>
            <span class="brand-mini">AMP</span>
        </a>
    </div>
    <div class="flexbox flex-1">
        <!-- START TOP-LEFT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            <li>
                <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
            </li>

        </ul>
        <!-- END TOP-LEFT TOOLBAR-->
        <!-- START TOP-RIGHT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            <li class="dropdown dropdown-user">
                <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
{{--                    <img src="./assets/img/admin-avatar.png" />--}}
                    <i class="fa fa-user fa-2x"></i>&nbsp;
                    <span></span>{{ auth()->user()->name }}<i class="fa fa-angle-down m-l-5"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <a href="{{ route('change-password',auth()->user()->role) }}" class="dropdown-item">
                       <i class="fa fa-key"></i>
                        Change Password
                    </a>
                    <a class="dropdown-item" href="{{route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <i class="fa fa-power-off"></i>Logout
                    </a>
                    <form action="{{ route('logout') }}" method="post" id="logout-form" class="d-none">
                        @csrf
                    </form>
                </ul>
            </li>
        </ul>
        <!-- END TOP-RIGHT TOOLBAR-->
    </div>
</header>
<!-- END HEADER-->
