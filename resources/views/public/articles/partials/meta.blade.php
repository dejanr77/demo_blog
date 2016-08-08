<span class="article-meta-view"><i class="fa fa-eye" aria-hidden="true"></i> <span>{{ $article->view_count }}</span> views</span>
@if($article->status_comment)
<span class="article-meta-comments"><i class="fa fa-comments-o" aria-hidden="true"></i> <span>{{ $article->comment_count }}</span> comments</span>
@endif
<span class="article-meta-like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <span>{{ $article->like_count }}</span>  </span>
<span class="article-meta-dislike"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> <span>{{ $article->dislike_count }}</span>  </span>

