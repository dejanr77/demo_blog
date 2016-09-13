@extends('layouts.public')

@section('description','Article - '. $article->title)

@section('author','dejanr77')

@section('title','article | '.$article->title)

@section('header')
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('{{ url('img/post-bg.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <a class="btn btn-default" href="{{ route('public.article.index') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back to Articles</a>
                        <h1>{{ $article->title }}</h1>
                        <span class="meta">
                            Posted by <a href="{{ route('public.article.user',['name' => $article->user->name ]) }}">{{ $article->user->present()->publicFullName() }}</a> on {{ $article->present()->publishedAtWithFormatForPublicShow()  }}<br/><br/>
                            @include('public.articles.partials.meta')
                        </span>
                        <br/>
                        @unless($article->is_published)
                            @can('article.update') @can('edit', $article)
                            <a class="btn btn-default btn-xs pull-left" href="{{ route('public.article.edit',['article' => $article->id]) }}"> <i class="fa fa-edit"></i> Update</a>
                            @endcan @endcan
                        @endunless
                        @can('article.delete') @can('delete', $article)
                        {!! Form::open(['method'=>'DELETE','url' => 'article/'.$article->id,'role' => 'form']) !!}
                        {!! Form::submit("Delete",['class' => 'btn btn-danger btn-xs pull-left']) !!}
                        {!! Form::close() !!}
                        @endcan @endcan
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <!-- Post Content -->
    <article>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    @include('public.articles.partials.tags',['setTagUrl' => true])
                    <br/>
                    {!! $article->body !!}
                    <hr/>
                    <div class="article_footer">
                        <div class="article_action">
                            <span>
                                <a href="{{ route('public.article.like',['article' => $article->id]) }}" class="text-primary like" title="Like">
                                    <i class="fa fa-{{ $currentUser && $article->likes()->byUser($currentUser->id)->count() ? 'thumbs-up' : 'thumbs-o-up'}}"></i>
                                    <span>
                                        {{ $article->like_count }}
                                    </span>
                                    likes
                                </a>
                            </span>
                            <span>
                                <a href="{{ route('public.article.dislike',['article' => $article->id]) }}" class="text-danger dislike" title="Dislike">
                                    <i class="fa fa-{{ $currentUser && $article->dislikes()->byUser($currentUser->id)->count() ? 'thumbs-down' : 'thumbs-o-down'}}"></i>
                                    <span>
                                        {{ $article->dislike_count }}
                                    </span>
                                    dislikes
                                </a>
                            </span>
                        </div>
                    </div>
                    @include('public.articles.partials.comments')
                </div>
            </div>
        </div>
    </article>
@endsection

@section('footer')
    @parent
    <script>
        (function() {
            demo_blog.comment.init();
            demo_blog.like.init();
        })();
    </script>
@endsection

