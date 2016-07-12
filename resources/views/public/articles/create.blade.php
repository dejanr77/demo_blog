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
                        <h1>Create a new Article</h1>
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
            {!! Form::model($article = new App\Models\Article(),['url' => 'articles','role' => 'form']) !!}
            @include('partials.article_form',['submitText' => 'Add Article'])
            {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection



