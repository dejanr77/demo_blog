<header class="main-header">
    <div class="logo">
        <a href="{{ route('public.home') }}">
            demo_blog
        </a>
    </div>

    <!-- Static navbar -->
    <nav class="navbar  navbar-static-top" role="navigation">
        <div class="sidebar-toggle">
            <a href="#">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </a>
        </div>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="{{ route('public.userCenters.show',['user' => $currentUser->id]) }}">
                                <i class="fa fa-user fa-fw"></i> User Center
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ url('logout') }}">
                                <i class="fa fa-sign-out fa-fw"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

</header><!-- ./main-header -->