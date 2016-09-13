@extends('layouts.public')

@section('description','Articles that written by '.$user->name)

@section('author','dejanr77')

@section('title','Articles that written by '.$user->name)

@section('header')
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('{{ url('img/home-bg.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Articles</h1>
                        <hr class="small">
                        <span class="subheading"> written by {{ $user->present()->publicFullName() }}</span>
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
                        @include('public.articles.partials.article',['showUser' => false])
                        <hr>
                    @endforeach
                    @include('public.articles.partials.pagination')
                @else
                   There are no posts.
                @endif
            </div>
        </div>
    </div>
@endsection



