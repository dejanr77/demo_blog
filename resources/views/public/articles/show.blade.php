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
                        <a class="btn btn-default" href="{{ route('public.article.index') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back to Articles</a>
                        <h1>{{ $article->title }}</h1>
                        <span class="meta">
                            Posted by <a href="{{ route('public.article.user',['name' => $article->user->name ]) }}">{{ $article->user->present()->publicFullName() }}</a> on {{ $article->present()->publishedAtWithFormatForPublicShow()  }}<br/><br/>
                            @include('public.articles.partials.meta')
                        </span>
                        <br/>
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
                    @include('public.articles.partials.tags',['setTagUrl' => true])
                    <br/>
                    {!! $article->body !!}
                    @include('public.articles.partials.comments')
                </div>
            </div>
        </div>
    </article>
@endsection

@section('footer')
    @parent
    <script>
        $(function(){
            $('#comment_form').on('submit',function(e){
                e.preventDefault();
                var self = $(this),
                        comment_list = $('.comment_list'),
                        button = self.find('input[type="submit"]'),
                        comment_body = self.find('textarea[name="body"]').val(),
                        url = self.attr('action'),
                        data = self.serialize();

                if(comment_body === '') {
                    self.find('p').remove();
                    self.prepend('<p class="text-danger">Please enter your comment.</p>');
                    setTimeout(function(){
                        self.find('p').slideUp();
                    },2000);
                }else{
                    button.attr('disabled', true).fadeTo('slow', 0.5);

                    $.ajax({
                        'url': url,
                        'type': 'POST',
                        'dataType': 'json',
                        'data': data
                    }).done(function(data){
                        comment_list.prepend(data);
                        $('body').animate( {
                            scrollTop: comment_list.offset().top - 10
                        }, 1200);
                        button.attr('disabled', false).fadeTo('slow', 1);
                    }).fail(function() {
                        self.find('p').remove();
                        self.prepend('<p class="text-danger">Sorry, there was a problem!.</p>');
                        setTimeout(function(){
                            self.find('p').slideUp();
                        },2000);
                    });
                }
            });
        });
    </script>
@endsection

