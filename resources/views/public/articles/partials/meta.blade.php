<span class="article-meta-view"><i class="fa fa-eye" aria-hidden="true"></i> {{ $article->view_count }} views</span>
@if($article->status_comment)
<span class="article-meta-comments"><i class="fa fa-comments-o" aria-hidden="true"></i> {{ $article->comment_count }} comments</span>
@endif
<span class="article-meta-like"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> 6 likes</span>
