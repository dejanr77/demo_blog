<ul class="nav nav-tabs nav-justified">
    <li role="presentation" class="{{ set_active('user/home/*') }}">
        <a href="{{ route('public.userCenters.show',['id' => $currentUser->id]) }}">
            <i class="fa fa-home" aria-hidden="true"></i> Home
        </a>
    </li>
    <li role="presentation" class="{{ set_active('user/articles/*') }}">
        <a href="{{ route('public.userCenters.articles',['id' => $currentUser->id]) }}">
            <i class="fa fa-th" aria-hidden="true"></i> Articles
        </a>
    </li>
    @can('upload.file')
    <li role="presentation" class="{{ set_active('user/images/*') }}">
        <a href="{{ route('public.userCenters.images',['id' => $user->id]) }}">
            <i class="fa fa-picture-o" aria-hidden="true"></i> Images
        </a>
    </li>
    <li role="presentation" class="{{ set_active('user/files/*') }}">
        <a href="{{ route('public.userCenters.files',['id' => $user->id]) }}">
            <i class="fa fa-files-o" aria-hidden="true"></i> Files
        </a>
    </li>
    @endcan
</ul>