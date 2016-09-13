@extends('layouts.admin')

@section('title','Edit this '.$article->title)

@section('style')
    @parent
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit: {{ $article->title }}
                    </h1>
                </div>
                <div class="panel-body">
                    {!! Form::model($article,['method'=>'PATCH','url' => 'admin/article/'.$article->id,'role' => 'form']) !!}
                    @include('public.articles.partials.form',['submitText' => 'Update Article'])
                    {!! Form::close() !!}
                    <a class="btn btn-default" href="{{ url()->previous() }}">
                        Back
                    </a>
                </div>
                <div class="panel-footer">
                    &nbsp;
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