@extends('layouts.public')

@section('title','User Center | articles')

@section('header')
    @include('public.userCenters.partials.header',['headingText' => 'User Center | Articles'])
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
                        @can('article.create')
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
                                                @if($article->is_published)
                                                    <td class="text-success">
                                                        published
                                                    </td>
                                                @else
                                                    @if($article->status_active)
                                                        <td class="status">
                                                            <a href="{{ route('public.article.status',['article' => $article->id, 'value' => 0]) }}" class="text-success article-opt"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                        </td>
                                                    @else
                                                        <td class="status">
                                                            <a href="{{ route('public.article.status',['article' => $article->id, 'value' => 1]) }}" class="article-opt"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                        </td>
                                                    @endif
                                                @endif

                                                @if($article->status_comment)
                                                    <td class="comments" >
                                                        <a href="{{ route('public.article.comments',['article' => $article->id, 'value' => 0]) }}" class="text-success article-opt"><i class="fa fa-check" aria-hidden="true"></i></a>
                                                    </td>
                                                @else
                                                    <td class="comments">
                                                        <a href="{{ route('public.article.comments',['article' => $article->id, 'value' => 1]) }}" class="article-opt"><i class="fa fa-times" aria-hidden="true"></i></a>
                                                    </td>
                                                @endif
                                                <td>
                                                    <i class="fa fa-heart"></i> {{ $article->like_count }}
                                                    <i class="fa fa-eye"></i> {{ $article->view_count }}
                                                    <i class="fa fa-comments"></i> {{ $article->comment_count }}
                                                    <i class="fa fa-calendar"></i> {{ $article->created_at->diffForHumans() }}
                                                </td>
                                                <td class="text-right">
                                                    @can('show',$article)
                                                    <a class="preview_article" href="{{ route('public.article.preview',['article' => $article->slug]) }}" target="_blank">
                                                        <i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                    @endcan
                                                    @unless($article->is_published)
                                                    @can('edit',$article)
                                                    <a class="edit_article" href="{{ route('public.article.edit',['article' => $article->id]) }}" target="_blank">
                                                        <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    @endcan
                                                    @endunless
                                                    @can('delete',$article)
                                                    <a href="{{ route('public.article.delete',['article' => $article->id]) }}">
                                                        <i class="fa fa-ban"></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="5">
                                                {!! $articles->render() !!}&nbsp;
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <p class="well">
                                        * - When you change the contents of the field status to 'check' and after approval by the administrator of your article will be published.
                                    </p>
                                    <a class="btn btn-default" href="{{ route('public.article.create') }}">
                                        Add a new Article
                                    </a>
                                </div>
                            @else
                            <p class="well">
                                Sorry, You don't have any article.
                            </p>
                            <a class="btn btn-default" href="{{ route('public.article.create') }}">
                                Add a new Article
                            </a>
                            @endif
                        @else
                            @unless($user->author_request)
                            <p>
                                If you want to create articles on this blog, send the request. It would be nice to create your own profile.
                            </p>
                            <a class="btn btn-default" href="{{ route('public.userCenters.authorRequest') }}">send the request</a>
                            @endunless
                            @if($user->author_request)
                            <p class="well small">
                                It will take some time to allow you  ability to create articles.
                            </p>
                            @endif
                        @endcan
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

        demo_blog.article_opt.init();

        });
    </script>
@endsection
