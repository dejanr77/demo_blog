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
            <span>
                <a href="#" class="text-primary">
                    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> +12
                </a>
            </span>
            <span>
                <a href="#" class="text-danger">
                    <i class="fa fa-thumbs-o-down" aria-hidden="true"></i> -3
                </a>
            </span>
        </div>
    </div>
</div>