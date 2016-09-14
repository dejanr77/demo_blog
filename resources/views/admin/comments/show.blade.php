@extends('layouts.admin')

@section('title','Comment')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        <i class="fa fa-comment-o" aria-hidden="true"></i> Comment
                    </h1>
                </div>
                <div class="panel-body">
                    <div class="comment_body">
                        {{ $comment->body }}
                    </div>
                    <hr/>
                    <p>
                        <span><b>Article: </b>{{ $comment->article->title }}</span><br/>
                        <span><b>From </b>{{ $comment->user->name }}</span><br/>
                        <span><b>Published at </b>{{ $comment->created_at->diffForHumans() }}</span>
                    </p>
                    <p>
                        <i class="fa fa-{{ $currentUser && $comment->present()->likesCount( $comment, $currentUser ) ? 'thumbs-up' : 'thumbs-o-up'}}"></i>
                        {{ $comment->like_count }}

                        <i class="fa fa-{{ $currentUser && $comment->present()->disLikesCount( $comment, $currentUser )  ? 'thumbs-down' : 'thumbs-o-down'}}"></i>
                        <span>
                            {{ $comment->dislike_count }}
                        </span>
                    </p>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-default" href="{{ url()->previous() }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection



