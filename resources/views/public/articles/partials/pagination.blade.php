@if($articles->lastPage() > 1)
    <ul class="pager">
        @if($articles->CurrentPage() !== 1)
            <li class="prev pull-left">
                <a href="{{ $articles->previousPageUrl() }}">&larr; Newer Posts </a>
            </li>
        @endif

        @if($articles->CurrentPage() !== $articles->lastPage())
            <li class="next pull-right">
                <a href="{{ $articles->nextPageUrl() }}"> Older Posts &rarr;</a>
            </li>
        @endif
    </ul>
@endif