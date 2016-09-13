@extends('layouts.admin')

@section('title','Trash')

@section('content')


    <div class="row">
        <div class="col-md-10">
            @include('flash::message')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        <i class="fa fa-trash-o" aria-hidden="true"></i> Trash
                    </h1>
                </div>
                <div class="panel-body">
                    @if(count($articles) > 0)

                        <div class="table-responsive">
                            <table class="table  table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Published date</th>
                                    <th>deleted date</th>
                                    <th>action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($articles as $article)
                                    <tr>
                                        <td>{{ $article->id }}</td>
                                        <td>{{ $article->present()->shortenTitle() }}</td>
                                        <td>
                                            <a href="#">
                                                {{ $article->user->name }}
                                            </a>
                                        </td>
                                        <td>@if($article->published_at)
                                                {{ $article->published_at->diffForHumans()}}
                                            @else
                                                ...
                                            @endif
                                        </td>
                                        <td>
                                            {{ $article->deleted_at->diffForHumans() }}
                                        </td>
                                        <td>
                                            <div class="btn-group-xs trash" role="group">
                                                <a class="btn btn-default preview_article" href="{{ route('admin.article.preview',['article' => $article->slug]) }}" target="_blank">
                                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                </a>
                                                @can('article.restore')
                                                <a class="btn btn-danger delete_article" href="{{ route('admin.article.restore',['article' => $article->id]) }}">
                                                    <i class="fa fa-recycle" aria-hidden="true"></i>
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
                            {{ $articles->render() }}
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






