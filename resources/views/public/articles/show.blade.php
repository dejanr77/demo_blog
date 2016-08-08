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
                    <hr/>
                    <div class="article_footer">
                        <div class="article_action">
                            <span>
                                <a href="{{ route('public.article.like',['article' => $article->id]) }}" data-type="like" class="text-primary" title="Like">
                                    <i class="fa fa-{{ auth()->user() && $article->likes()->byUser(auth()->user()->id)->count() ? 'thumbs-up' : 'thumbs-o-up'}}"></i>
                                    <span>
                                        {{ $article->like_count }}
                                    </span>
                                    likes
                                </a>
                            </span>
                            <span>
                                <a href="{{ route('public.article.dislike',['article' => $article->id]) }}" data-type="dislike" class="text-danger" title="Dislike">
                                    <i class="fa fa-{{ auth()->user() && $article->dislikes()->byUser(auth()->user()->id)->count() ? 'thumbs-down' : 'thumbs-o-down'}}"></i>
                                    <span>
                                        {{ $article->dislike_count }}
                                    </span>
                                    dislikes
                                </a>
                            </span>
                        </div>
                    </div>
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
            $( '#comment_form' ).on( 'submit', function( e ){
                e.preventDefault();
                var self = $(this),
                        comment_list = $('.comment_list'),
                        button = self.find('input[type="submit"]'),
                        comment_body = self.find('textarea[name="body"]').val(),
                        url = self.attr('action'),
                        data = self.serialize(),
                        el_meta_count = $('.article-meta-comments').find('span');



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
                        var count = parseInt(el_meta_count.html());
                        el_meta_count.html(count+1);
                        comment_list.prepend(data);
                        $('body').animate( {
                            scrollTop: comment_list.offset().top - 10
                        }, 1200);
                        button.attr('disabled', false).fadeTo('slow', 1);
                    }).fail(function() {
                        self.find('p').remove();
                        self.prepend('<p class="text-danger">Sorry, there was a problem!</p>');
                        setTimeout(function(){
                            self.find('p').slideUp();
                        },2000);
                    });
                }
            });

            $( '.article_action' ).on( 'click', 'a', function( e ){
                e.preventDefault();

                var self = $( this ),
                        type = self.data( 'type' );

                if( type === 'like' ){
                    up_or_down( self , 'fa-thumbs-up', 'fa-thumbs-o-up' , function( count ){
                        $( '.article-meta-like').find( 'span' ).html( count );
                    });
                } else {
                    up_or_down( self , 'fa-thumbs-down', 'fa-thumbs-o-down' , function( count ){
                        $( '.article-meta-dislike').find( 'span' ).html( count );
                    });
                }

            });

            $( '.comment_action' ).on( 'click', 'a', function( e ){
                e.preventDefault();

                var self = $( this ),
                        type = self.data( 'type' );

                if( type === 'like' ){
                    up_or_down( self , 'fa-thumbs-up', 'fa-thumbs-o-up' );
                } else {
                    up_or_down( self , 'fa-thumbs-down', 'fa-thumbs-o-down' );
                }

            });

            function up_or_down( el , icon, icon_o , f ){
                var url = el.attr( 'href' ),
                        el_icon = el.find( 'i' ),
                        el_count = el.find( 'span' ),
                        div = el.closest( "div" );


                el.attr('disabled',true);
                el_icon.removeClass( icon + ' ' + icon_o ).addClass('fa-spinner fa-spin');

                $.ajax({
                    type: 'get',
                    url: url,
                    dataType: 'json'
                }).done( function( data ){
                    var count = parseInt( el_count.html() );

                    if( data.action == 'up' ){
                        count += 1;
                        el_icon.removeClass( 'fa-spinner fa-spin' ).addClass( icon );
                        el_count.html( count );
                        if( f !== undefined ) f( count );
                    }else{
                        count -= 1;
                        el_icon.removeClass( 'fa-spinner fa-spin' ).addClass( icon_o );
                        el_count.html( count );
                        if( f !== undefined ) f( count );
                    }
                    el.attr( 'disabled', false );

                }).fail( function( data ) {
                    div.find( 'p' ).remove();
                    if( data.status === 401 ){
                        div.prepend( '<p class="text-danger">Sorry, You have to be login!</p>' );
                        setTimeout( function(){
                            div.find( 'p' ).slideUp();
                        }, 2000 );
                    }
                    el_icon.removeClass( 'fa-spinner fa-spin' ).addClass( icon_o );
                });

            }


        });
    </script>
@endsection

