@extends('layouts.admin')

@section('title','Comments')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @include('flash::message')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        <i class="fa fa-comments-o" aria-hidden="true"></i> Comments
                    </h1>
                </div>
                <div class="panel-body">
                    @if(count($comments) > 0)

                        <div class="table-responsive">
                            <table class="table  table-hover">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Content</th>
                                    <th>Author</th>
                                    <th>Articles</th>
                                    <th>published on</th>
                                    <th>action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($comments as $comment)
                                    <tr>
                                        <td>
                                            {{ $comment->id }}</td>
                                        <td>
                                            <a href="{{ route('admin.comment.show',['comment' => $comment->id]) }}">
                                                {{  shortenText($comment->body, 32) }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.user.show',['user' => $comment->user->id]) }}">
                                                {{ $comment->user->name }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($comment->article)
                                            <a href="{{ route('admin.article.show',['article' => $comment->article_id]) }}" target="_blank">
                                                {{ $comment->article->present()->shortenTitle() }}
                                            </a>
                                            @else
                                            <a href="{{ route('admin.article.show',['article' => $comment->article_id]) }}" target="_blank">
                                                The article has been deleted
                                            </a>
                                            @endif
                                        </td>
                                        <td>
                                            <i class="fa fa-calendar"></i> {{ $comment->created_at->diffForHumans() }}
                                        </td>
                                        <td>
                                            <div class="btn-group-xs" role="group">
                                                <a class="btn btn-default preview_comment" href="{{ route('admin.comment.show',['comment' => $comment->id]) }}">
                                                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                </a>
                                                @can('comment.trash')
                                                <a class="btn btn-danger delete_comment" href="{{ route('admin.comment.delete',['comment' => $comment->id]) }}">
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



