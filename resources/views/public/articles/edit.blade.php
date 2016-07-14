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

@section('footer')
    @parent
    <script src="{{ url('js/dropzone.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".selectTags").select2({
                placeholder: "Select a tag",
                maximumSelectionLength: 5
            });
            tinymce.init({
                selector: '.editor',
                theme: 'modern',
                plugins: [
                    'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
                    'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                    'save table contextmenu directionality emoticons template paste textcolor'
                ],
                toolbar: 'insertfile undo redo |  bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image print preview media fullpage | code | forecolor backcolor emoticons '
            });

        });
    </script>
@endsection

