<ul class="nav nav-tabs nav-justified">
    <li role="presentation" class="{{ set_active('user/home/*') }}"><a href="{{ route('public.userCenters.show',['id' => $currentUser->id]) }}">Home</a></li>
    <li role="presentation" class="{{ set_active('user/articles/*') }}"><a href="{{ route('public.userCenters.articles',['id' => $currentUser->id]) }}">Articles</a></li>
    <li role="presentation" class="{{ set_active('user/images/*') }}"><a href="{{ route('public.userCenters.images',['id' => $currentUser->id]) }}">Images</a></li>
    <li role="presentation" class="{{ set_active('user/files/*') }}"><a href="{{ route('public.userCenters.files',['id' => $currentUser->id]) }}">Files</a></li>
</ul>