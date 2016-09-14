<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Notify;
use App\Repositories\Articles\ArticleRepositoryInterface;
use App\User;
use App\Http\Requests;
use Auth;

class UserCentersController extends Controller
{
    public function __construct()
    {
        $this->middleware('acl:upload.file', ['only' => ['images','files']]);

        view()->share('currentUser', Auth::user());
    }


    public function show(User $user)
    {
        $this->authorize('self',$user);

        $activities = $user->activities()->orderBy('created_at','dsc')->paginate(6);

        $notifications_count = $user->notifyTo()->where('new','=',1)->count();

        return view('public.userCenters.show',compact('activities','notifications_count','user'));
    }

    public function articles(User $user, ArticleRepositoryInterface $articleRepository)
    {
        $this->authorize('self',$user);

        $articles = $articleRepository->allArticlesForUser($user,8);

        $notifications_count = $user->notifyTo()->where('new','=',1)->count();

        return view('public.userCenters.articles',compact('articles','notifications_count','user'));
    }

    public function images(User $user)
    {
        $this->authorize('self',$user);

        $notifications_count = $user->notifyTo()->where('new','=',1)->count();

        return view('public.userCenters.images',compact('notifications_count','user'));
    }

    public function files(User $user)
    {
        $this->authorize('self',$user);

        $notifications_count = $user->notifyTo()->where('new','=',1)->count();

        return view('public.userCenters.files',compact('notifications_count','user'));
    }

    public function notifications(User $user)
    {
        $this->authorize('self',$user);

        $notifications = $user->notifyTo()->orderBy('created_at','dsc')->paginate(8);

        $notifications_count = $user->notifyTo()->where('new','=',1)->count();

        return view('public.userCenters.notifications.index',compact('notifications','notifications_count','user'));
    }

    public function showNotification(Notify $notification)
    {
        $notification->update(['new' => 0]);

        $type = $notification->type;
        $model = 'App\Models\\'.$type;
        $id = $notification->type_id;

        $user = $notification->notificationTo;

        if($type == 'Comment')
        {
            $comment = $model::find($id);
            $article = $comment->article;

            return view('public.userCenters.notifications.show.comment',compact('notification','comment','article','user'));
        }
        else if($type == 'Article')
        {
            $article = $model::find($id);

            return view('public.userCenters.notifications.show.article',compact('notification','article','user'));
        }
        else if($type == 'User')
        {
            return view('public.userCenters.notifications.show.user',compact('notification','user'));
        }


    }

    public function authorRequest()
    {
        $user = auth()->user();

        $user->update([
            'author_request' => 1
        ]);

        Notify::notify($user->id, 1, $user , '<i class="text-primary fa fa-user-plus" aria-hidden="true"></i> User '. $user->name .' has sent a request to become an <a href="'. route("admin.user.show",["user" => $user->id]).'">author</a> ');

        return redirect()->route('public.userCenters.articles',['user' => $user->id]);
    }

}
