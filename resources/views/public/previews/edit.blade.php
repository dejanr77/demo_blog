@extends('layouts.public')

@section('title','User Center | Edit article')

@section('style')
    @parent
            <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

@section('header')
    @include('public.userCenters.partials.header',['headingText' => 'User Center - Articles'])
@endsection

@section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('public.userCenters.partials.sidebar')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default panel-user-info">
                    <div class="panel-body">
                        {!! Form::model($article,['method'=>'PATCH','url' => 'previews/'.$article->id,'role' => 'form']) !!}
                        @include('public.articles.partials.form',['submitText' => 'Update Article'])
                        {!! Form::close() !!}
                        <a class="btn btn-default" href="{{ route('public.userCenters.articles',['user' => $article->user_id]) }}">
                            Back to Articles
                        </a>
                    </div>
                </div>
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

