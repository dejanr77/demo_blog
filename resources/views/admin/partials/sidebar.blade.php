<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="http://secure.gravatar.com/avatar/{{ md5($currentUser->email) }}?s=40" class="img-rounded" alt="{{ $currentUser->name }}">
            </div>
            <div class="pull-left info">
                <p>{{ $currentUser->present()->publicFullName() }}</p>
                <a href="#"> {{ $currentUser->roles[0]->name }}</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header">Main Navigation</li>
            <li class="treeview {{ set_active('admin') }}">
                <a href="#">
                    <i class="fa fa-dashboard" aria-hidden="true"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class=" {{ set_active('admin') }}">
                        <a href="{{ route('admin.dashboard.index') }}">
                            <i class="fa fa-circle-o"></i> home
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside><!-- ./main-sidebar -->