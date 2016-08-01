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
                        <p class="post-meta">
                            Posted by <a href="{{ route('public.article.user',['name' => $article->user->name ]) }}">{{ $article->user->present()->publicFullName() }}</a> on {{ $article->present()->publishedAtWithFormatForPublicShow()  }}
                        </p>
                        @can('edit', $article)
                        <a class="btn btn-default btn-xs pull-left" href="{{ route('public.article.edit',['article' => $article->id]) }}"> <i class="fa fa-edit"></i> Update</a>
                        @endcan
                        @can('delete', $article)
                        {!! Form::open(['method'=>'DELETE','url' => 'article/'.$article->id,'role' => 'form']) !!}
                        {!! Form::submit("Delete",['class' => 'btn btn-danger btn-xs pull-left']) !!}
                        {!! Form::close() !!}
                        @endcan
                        <div class="clearfix"></div>
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
                    @if(count($tag_list_with_count) > 0)
                        <h4>Tags:</h4>
                        <div>
                            @foreach($tag_list_with_count as $tag)
                                <a class="btn btn-default" href="{{ route('public.tags.articles',[ 'slug' => $tag->slug ]) }}">{{ $tag->name }} <sup>({{ $tag->articles_count }})</sup></a>
                            @endforeach
                        </div>
                    @else
                        There are no tags.
                    @endif
                    <br/>
                    {!! $article->body !!}
                </div>
            </div>
        </div>
    </article>
@endsection



