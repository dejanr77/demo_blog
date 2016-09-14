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
            <li class="treeview {{ set_active('admin/article*') }}">
                <a href="#">
                    <i class="fa fa-file-o" aria-hidden="true"></i> <span>Articles</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class=" {{ set_active('admin/article') }}">
                        <a href="{{ route('admin.article.index') }}">
                            <i class="fa fa-circle-o"></i> list of articles
                        </a>
                    </li>
                    @can('tag.menage')
                    <li class=" {{ set_active('admin/article/tag*') }}">
                        <a href="{{ route('admin.article.tag.index') }}">
                            <i class="fa fa-circle-o"></i> list of tags
                        </a>
                    </li>
                    @endcan
                    @can('article.trash')
                    <li class=" {{ set_active('admin/trash') }}">
                        <a href="{{ route('admin.article.trash') }}">
                            <i class="fa fa-circle-o"></i> trash
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            <li class="treeview {{ set_active('admin/comment*') }}">
                <a href="#">
                    <i class="fa fa-comments-o" aria-hidden="true"></i></i> <span>Comments</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class=" {{ set_active('admin/comment') }}">
                        <a href="{{ route('admin.comment.index') }}">
                            <i class="fa fa-circle-o"></i> comments
                        </a>
                    </li>
                    @can('comment.trash')
                    <li class=" {{ set_active('admin/comment/trash') }}">
                        <a href="{{ route('admin.comment.trash') }}">
                            <i class="fa fa-circle-o"></i> trash
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            <li class="treeview {{ set_active('admin/notification*') }}">
                <a href="#">
                    <i class="fa fa-flag-o" aria-hidden="true"></i>
                    <span>
                        Notifications @if($notifications_count)<sup class="label label-danger">{{ $notifications_count }}</sup>@endif
                    </span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class=" {{ set_active('admin/notification') }}">
                        <a href="{{ route('admin.notification.index') }}">
                            <i class="fa fa-circle-o"></i> list of notifications @if($notifications_count)<sup class="label label-danger">{{ $notifications_count }}</sup>@endif
                        </a>
                    </li>
                    <li class=" {{ set_active('admin/notification/create') }}">
                        <a href="{{ route('admin.notification.create') }}">
                            <i class="fa fa-circle-o"></i> create notification
                        </a>
                    </li>
                </ul>
            </li>
            @can('user.menage')
            <li class="treeview {{ set_active('admin/user*') }}">
                <a href="#">
                    <i class="fa fa-users" aria-hidden="true"></i> <span>Users</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class=" {{ set_active('admin/user') }}">
                        <a href="{{ route('admin.user.index') }}">
                            <i class="fa fa-circle-o"></i> list of users
                        </a>
                    </li>
                    <li class=" {{ set_active('admin/user/roles') }}">
                        <a href="{{ route('admin.user.roles') }}">
                            <i class="fa fa-circle-o"></i> roles
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
        </ul>
    </section>
</aside><!-- ./main-sidebar -->