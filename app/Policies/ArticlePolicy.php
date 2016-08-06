<?php

namespace App\Policies;

use App\Models\Article;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function active(User $user, Article $article)
    {
        return $user->own($article);
    }

    public function comment(User $user, Article $article)
    {
        return $user->own($article);
    }

    public function show(User $user, Article $article)
    {
        return $user->own($article);
    }

    public function edit(User $user, Article $article)
    {
        return $user->own($article);
    }

    public function update(User $user, Article $article)
    {
        return $user->own($article);
    }

    public function delete(User $user, Article $article)
    {
        return $user->own($article);
    }
}
