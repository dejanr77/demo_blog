@extends('layouts.public')

@section('title','Create article')

@section('style')
    @parent
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

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
            {!! Form::model($article = new App\Models\Article(),['url' => 'article','role' => 'form']) !!}
            @include('public.articles.partials.form',['submitText' => 'Add Article'])
            {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('footer')
    @parent
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{ url('js/article.js') }}"></script>
@endsection



