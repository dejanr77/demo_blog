@extends('layouts.public')

@section('title','Articles | articles')

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
                        @include('public.userCenters.partials.nav')

                        @if(count($articles) > 0)
                            <div class="table-responsive table_articles">
                                <table class="table  table-hover">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Status*</th>
                                        <th>Comments</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($articles as $article)
                                        <tr>
                                            <td>
                                                {{ $article->present()->shortenTitle() }}
                                            </td>
                                            @if($article->status)
                                                <td class="status">
                                                    <a href="{{ route('public.article.status',['article' => $article->id]) }}" class="text-success article-opt"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                </td>
                                            @else
                                                <td class="status">
                                                    <a href="{{ route('public.article.status',['article' => $article->id]) }}" class="article-opt"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                </td>
                                            @endif
                                            @if($article->comments)
                                                <td class="comments" >
                                                    <a href="{{ route('public.article.comments',['article' => $article->id]) }}" class="text-success article-opt"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                </td>
                                            @else
                                                <td class="comments">
                                                    <a href="{{ route('public.article.comments',['article' => $article->id]) }}" class="article-opt"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                </td>
                                            @endif
                                            <td>
                                                <i class="fa fa-heart"></i> 6
                                                <i class="fa fa-eye"></i> 21
                                                <i class="fa fa-comments"></i> 3
                                                <i class="fa fa-calendar"></i> {{ $article->created_at->diffForHumans() }}
                                            </td>
                                            <td class="text-right">
                                                <a class="preview_article" href="#" target="_blank"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                <a class="edit_article" href="#" target="_blank"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-ban"></i> </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5">
                                            {!! $articles->render() !!}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <p class="small col-sm-12">* - When you change the contents of the field status to 'check' and after approval by the administrator of your article will be published.</p>
                            </div>
                        @else
                            <p>
                                Sorry, You don't have any article.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('footer')
    @parent
    <script>
        $(function(){

            $('.article-opt').on('click',function(e){
                e.preventDefault();

                var self = $(this),
                        child = self.children('i'),
                        url = self.attr('href'),
                        td = self.parent('td');

                if(child.hasClass('fa-times')) {
                    child.removeClass('fa-times').addClass('fa-spinner fa-spin');
                    value = 1;
                } else {
                    child.removeClass('fa-check').addClass('fa-spinner fa-spin');
                    value = 0;
                }


                $.ajax({
                    type: 'get',
                    url: url,
                    data: {
                        value: value
                    },
                    dataType: 'json'
                }).done(function(json){
                    if(json == 200){
                        if(value){
                            child.removeClass('fa-spinner fa-spin').addClass('fa-check');
                        } else {
                            child.removeClass('fa-spinner fa-spin').addClass('fa-times');
                        }

                    }else{
                        if(value){
                            child.removeClass('fa-spinner fa-spin').addClass('fa-times');
                        } else {
                            child.removeClass('fa-spinner fa-spin').addClass('fa-check');
                        }
                    }
                });

            });

        });
    </script>
@endsection
