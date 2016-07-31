<!-- Navigation -->
<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('public.home') }}">demo_blog.rs</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="{{ set_active('/') }}">
                    <a  href="{{ route('public.home') }}">Home</a>
                </li>
                <li class="{{ set_active('article') }}">
                    <a  href="{{ route('public.article.index') }}">Articles</a>
                </li>
                <li class="{{ set_active('about') }}">
                    <a  href="{{ route('public.about') }}">About</a>
                </li>
                <li class="{{ set_active('contact') }}">
                    <a  href="{{ route('public.contact') }}">Contact</a>
                </li>
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            {{ auth()->user()->name }} <i class="fa fa-caret-down"></i>
                        </a>
                        <ul id="dropdown-user" class="dropdown-menu">
                            <li class="{{ set_active('article/create') }}">
                                <a href="{{ route('public.article.create') }}"><i class="fa fa-plus-square-o fa-fw"></i> Add article</a>
                            </li>
                            <li>
                                <a href="{{ route('public.userCenters.show',['user' => auth()->user()->id]) }}"><i class="fa fa-user fa-fw"></i> User Centar</a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ url('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>