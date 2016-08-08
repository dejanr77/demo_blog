@if($article->status_comment)
<hr/>
<div id="comment_area">
    @if(auth()->user())
    {!! Form::open(['url' => 'comment', 'id' => 'comment_form']) !!}
        {!! Form::hidden('article_id',$article->id) !!}
        <!-- Body Form Input -->
        <div class="form-group">
            {!! Form::textarea('body',null,['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Enter your comment...']) !!}
            @if ($errors->has('body'))
                <span class="help-block">
                    <strong class="text-danger">{{ $errors->first('body') }}</strong>
                </span>
            @endif
        </div>
        <!-- Add Site  Form Input -->
        <div class="form-group">
        {!! Form::submit('Send',['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
    <hr/>
    @else
    <a href="{{ url('/login') }}" class="btn btn-default">Login to post comments</a>
    <hr/>
    @endif
    <div class="comment_list">
        @foreach($comments as $comment)
            <div id="comment-{{ $comment->id }}">
                <div class="comment">
                    <div class="comment_body">
                        {{ $comment->body }}
                    </div>
                    <div class="comment_user">
                        <img src="http://secure.gravatar.com/avatar/{{ md5($comment->user->email) }}?s=40" alt="{{ $comment->user->name }}">
                    <span>
                        ( <b>{{ $comment->user->name }} </b> , <small>{{ $comment->created_at->diffForHumans() }}</small> )
                    </span>
                    </div>
                    <div class="comment_footer">
                        <div class="comment_action">
                            <span>
                                <a href="{{ route('public.comment.like',['comment' => $comment->id]) }}" data-type="like" class="text-primary" title="Like">
                                    <i class="fa fa-{{ $currentUser && $comment->likes()->byUser($currentUser->id)->count() ? 'thumbs-up' : 'thumbs-o-up'}}"></i>
                                    <span>
                                        {{ $comment->like_count }}
                                    </span>
                                </a>
                            </span>
                            <span>
                                <a href="{{ route('public.comment.dislike',['comment' => $comment->id]) }}" data-type="dislike" class="text-danger" title="Dislike">
                                    <i class="fa fa-{{ $currentUser && $comment->dislikes()->byUser($currentUser->id)->count() ? 'thumbs-down' : 'thumbs-o-down'}}"></i>
                                    <span>
                                        {{ $comment->dislike_count }}
                                    </span>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {!! $comments->fragment('comment_area')->render() !!}
    </div>
</div>
@endif