<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laracasts\Presenter\PresentableTrait;

class Comment extends Model
{
    use PresentableTrait, SoftDeletes;

    protected $presenter = 'App\Presenters\CommentPresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'article_id',
        'body'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * An comment is owned by a article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }

    /**
     * An comment is owned by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get all of the comment's likes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function likes()
    {
        return $this->morphMany('App\Models\Like', 'likeable');
    }

    /**
     * Get all of the comment's dislikes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function dislikes()
    {
        return $this->morphMany('App\Models\Dislike', 'dislikeable');
    }
}
