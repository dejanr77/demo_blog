@extends('layouts.public')

@section('title','Blog')

@section('header')
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('{{ url('img/home-bg.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Clean Blog</h1>
                        <hr class="small">
                        <span class="subheading">A Clean Blog Theme by Start Bootstrap</span>
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection

@section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                @if(count($articles) > 0)
                    @foreach($articles as $article)
                        <div class="post-preview">
                            <a href="{{ route('public.article.show',['slug' => $article->slug]) }}">
                                <h2 class="post-title">
                                    {{ $article->title }}
                                </h2>
                                <h3 class="post-subtitle">
                                    {{ $article->excerpt }}
                                </h3>
                            </a>
                            <p class="post-meta">Posted by <a href="{{ route('public.article.user',['name' => $article->user->name ]) }}">{{ $article->user->present()->publicFullName() }}</a> on {{ $article->present()->publishedAtWithFormatForPublicShow() }}</p>
                        </div>
                        <hr>
                    @endforeach
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
                @else
                   There are no posts.
                @endif
            </div>
        </div>
    </div>
@endsection



