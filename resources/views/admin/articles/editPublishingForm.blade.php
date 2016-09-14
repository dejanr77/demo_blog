@extends('layouts.admin')

@section('title','Publish this '.$article->title)


@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                         {{ $article->title }}
                    </h1>
                </div>
                <div class="panel-body">
                    @include('public.articles.partials.tags',['setTagUrl' => false])
                    <br/>
                    {!! $article->body !!}
                </div>
                <div class="panel-footer">
                    <a class="btn btn-default" href="{{ url()->previous() }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        Publish this article
                    </h1>
                </div>
                <div class="panel-body">
                    {!! Form::open( ['method'=>'PATCH','url' => 'admin/article/'.$article->id.'/publish','role' => 'form']) !!}
                    {!! Form::hidden('is_published',1) !!}
                    <!-- Published on Form Input -->
                    <div class="form-group">
                        {!! Form::label('published_at','Published on: ') !!}
                        {!! Form::input('date','published_at',$article->published_at->format('Y-m-d'),['class' => 'form-control']) !!}
                        @if ($errors->has('published_at'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('published_at') }}</strong>
                        </span>
                        @endif
                    </div>
                    <!-- Add Site  Form Input -->
                    <div class="form-group">
                        {!! Form::submit('Publish',['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                    {!! Form::close() !!}

                </div>
                <div class="panel-footer">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>
@endsection







