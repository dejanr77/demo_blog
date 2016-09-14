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
                    @if(count($comments) > 0)

                        <div class="table-responsive">
                            <table class="table  table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>content</th>
                                    <th>Author</th>
                                    <th>Article</th>
                                    <th>created date</th>
                                    <th>deleted date</th>
                                    <th>action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($comments as $comment)
                                    <tr>
                                        <td>{{ $comment->id }}</td>
                                        <td>{{ $comment->body }}</td>
                                        <td>
                                            <a href="{{ route('admin.user.show',['user' => $comment->user->id]) }}">
                                                {{ $comment->user->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.article.show',['article' => $comment->article_id]) }}" target="_blank">
                                                {{ $comment->article->present()->shortenTitle() }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $comment->created_at->diffForHumans() }}
                                        </td>
                                        <td>
                                            {{ $comment->deleted_at->diffForHumans() }}
                                        </td>
                                        <td>
                                            <div class="btn-group-xs trash" role="group">
                                                <a class="btn btn-default preview_comment" href="{{ route('admin.comment.show',['comment' => $comment->id]) }}" target="_blank">
                                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                </a>
                                                @can('comment.restore')
                                                <a class="btn btn-danger restore_comment" href="{{ route('admin.comment.restore',['comment' => $comment->id]) }}">
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
                            {{ $comments->render() }}
                        </div>
                    @else
                        <div class="well">
                            there are no comments.
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






