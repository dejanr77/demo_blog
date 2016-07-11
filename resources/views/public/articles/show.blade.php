@extends('layouts.public')

@section('title','article | '.$article->title)

@section('header')
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('{{ url('img/post-bg.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <h1>{{ $article->title }}</h1>
                        <p class="post-meta">Posted by <a href="{{ route('public.articles.user',['name' => $article->user->name ]) }}">{{ $article->user->name }}</a> on {{ $article->published_at->format('F j, Y') }}</p>
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
                    {!! $article->body !!}
                </div>
            </div>
        </div>
    </article>
@endsection



