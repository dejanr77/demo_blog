@extends('layouts.admin')

@section('title','Articles')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @include('flash::message')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        <i class="fa fa-files-o" aria-hidden="true"></i> Articles
                    </h1>
                </div>
                <div class="panel-body">
                    @if(count($articles) > 0)
                    <div class="row">
                        <div class="col-md-6 search_form">
                            {!! Form::open(['method'=>'get','class' => 'form-inline']) !!}
                            {!! Form::select('filter', array('created_at' => 'created','published_at' => 'published','status_active' => 'status','view_count' => 'view','comment_count' => 'comment','like_count' => 'like'),$filter,['class' => 'form-control']) !!}
                            {!! Form::select('dir', array('asc' => 'ascending', 'dsc' => 'descending'),$dir,['class' => 'form-control']) !!}
                            <div class="input-group">
                            {!! Form::text('search',null,['class' => 'form-control', 'placeholder' => 'Search for title...']) !!}
                            <span class="input-group-btn">
                            {!! Form::submit('Go',['class' => 'btn btn-default btn-block']) !!}
                            </span>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table  table-hover">
                            <thead>
                            <tr>
                                <th>title</th>
                                <th>author</th>
                                <th>status</th>
                                <th>published on</th>
                                <th></th>
                                <th>action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                            <tr>
                                <td>{{ $article->present()->shortenTitle() }}</td>
                                <td>
                                    <a href="{{ route('admin.user.show',['user' => $article->user->id]) }}">
                                        {{ $article->user->name }}
                                    </a>
                                </td>
                                <td>@if($article->status_active) <i class="fa fa-check text-success" aria-hidden="true"></i> @else <i class="fa fa-times text-danger" aria-hidden="true"></i>@endif</td>
                                <td>@if($article->is_published) {{ $article->present()->publishedAtWithFormatForPublicShow() }} @else @can('article.publish')@if($article->status_active)<a href="{{ route('admin.article.editPublishingForm',['article' => $article->id]) }}" class="btn btn-default btn-xs">Publish</a>@else <a href="#" class="btn btn-default btn-xs" disabled="disabled">publish</a>@endif @endcan @endif</td>
                                <td>
                                    <span title="likes">
                                        <i class="fa fa-heart"></i> {{ $article->like_count }}
                                    </span>
                                    <span title="views">
                                         <i class="fa fa-eye"></i> {{ $article->view_count }}
                                    </span>
                                    <span title="comments">
                                        <i class="fa fa-comments"></i> {{ $article->comment_count }}
                                    </span>
                                    <span title="created at">
                                        <i class="fa fa-calendar"></i> {{ $article->created_at->diffForHumans() }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group-xs" role="group">
                                        <a class="btn btn-default preview_article" href="{{ route('admin.article.preview',['article' => $article->slug]) }}" target="_blank">
                                            <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                        </a>
                                        @can('article.update')
                                        <a class="btn btn-primary edit_article" href="{{ route('admin.article.edit',['article' => $article->id]) }}">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        @endcan
                                        @can('article.delete')
                                        <a class="btn btn-danger delete_article" href="{{ route('admin.article.delete',['article' => $article->id]) }}">
                                            <i class="fa fa-ban" aria-hidden="true"></i>
                                        </a>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div>
                        {{ $articles->appends(['filter' => $filter,'dir' => $dir, 'search' => $search])->render() }}
                    </div>
                    @else
                        <div class="well">
                            there are no article.
                        </div>
                    @endif
                </div>
                <div class="panel-footer">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>

@endsection



