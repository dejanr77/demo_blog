@extends('layouts.preview')

@section('title','Preview article | '.$article->title)

@section('header')
    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('{{ url('img/post-bg.jpg') }}')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="post-heading">
                        <div class="post-heading">
                            <a class="btn btn-default" href="#"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back to Articles</a>
                            <h1>{{ $article->title }}</h1>
                            <span class="meta">
                                Posted by <a href="#">{{ $article->user->present()->publicFullName() }}</a> on {{ $article->present()->publishedAtWithFormatForPublicShow()  }}<br/><br/>
                                @include('public.articles.partials.meta')
                            </span>
                            <br/>
                            <a class="btn btn-default btn-xs pull-left" href="#"> <i class="fa fa-edit"></i> Update</a>
                            <a class="btn btn-danger btn-xs pull-left" href="#"> Delete</a>
                            <div class="clearfix"></div>
                        </div>
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
                                <a class="btn btn-default" href="#">{{ $tag->name }} <sup>({{ $tag->articles_count }})</sup></a>
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



