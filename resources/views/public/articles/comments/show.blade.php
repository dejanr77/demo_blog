<div id="comment-{{ $comment->id }}">
    <div class="comment">
        <div class="comment_body">
            {!! $comment->body !!}
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
                            @if( $comment->like_count ){{ $comment->like_count }} @else 0 @endif
                        </span>
                    </a>
                </span>
                <span>
                    <a href="{{ route('public.comment.dislike',['comment' => $comment->id]) }}" data-type="dislike" class="text-danger" title="Dislike">
                        <i class="fa fa-{{ $currentUser && $comment->dislikes()->byUser($currentUser->id)->count() ? 'thumbs-down' : 'thumbs-o-down'}}"></i>
                        <span>
                            @if( $comment->dislike_count ){{ $comment->dislike_count }} @else 0 @endif
                        </span>
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>