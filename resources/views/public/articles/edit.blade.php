@extends('layouts.public')

@section('title','Create article')

@section('header')
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('{{ url('img/home-bg.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Edit</h1>
                        <hr class="small">
                        <span class="post-meta">
                            {{ $article->title }}
                        </span>
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
            {!! Form::model($article,['method'=>'PATCH','url' => 'articles/'.$article->id,'role' => 'form']) !!}
            @include('partials.article_form',['submitText' => 'Update Article'])
            {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection



