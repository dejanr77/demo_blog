<div class="post-preview">
    <a href="{{ route('public.article.show',['slug' => $article->slug]) }}">
        <h2 class="post-title">
            {{ $article->title }}
        </h2>
        <span>
            @include('public.articles.partials.meta')
        </span>
        <br/><br/>
        <h3 class="post-subtitle">
            {{ $article->excerpt }}
        </h3>
    </a>
    <p class="post-meta">
        Posted
        @if($showUser)
        by
        <a href="{{ route('public.article.user',['name' => $article->user->name ]) }}">
            {{ $article->user->present()->publicFullName() }}
        </a>
        @endif
        on {{ $article->present()->publishedAtWithFormatForPublicShow() }}
    </p>
</div>