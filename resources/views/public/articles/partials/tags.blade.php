@if(count($tag_list_with_count) > 0)
    <h4>Tags:</h4>
    <div>
        @foreach($tag_list_with_count as $tag)
            <a class="btn btn-default" href="@if($setTagUrl){{ route('public.tags.articles',['slug' => $tag->slug]) }}@else#@endif">
                <i class="fa fa-tag" aria-hidden="true"></i> {{ $tag->name }} <sup>({{ $tag->articles_count }})</sup>
            </a>
        @endforeach
    </div>
@else
    There are no tags.
@endif