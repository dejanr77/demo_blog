<div class="panel panel-default" xmlns="http://www.w3.org/1999/html">
    <div class="panel-body">
        <div class="avatar_img text-center">
            <img src="http://secure.gravatar.com/avatar/{{ md5($currentUser->email) }}?s=100"  alt="avatar">
        </div>
        @if(count($currentUser->profile) > 0)
            <div class="text-center">
                <h4>{{ $user->present()->fullName() }}</h4>
                @if($currentUser->profile->description)
                    <p> {{ $currentUser->profile->description }}</p>
                @endif
            </div>
            <hr/>
            <a class="btn btn-default btn-block" href="#"><i class="fa fa-pencil-square-o" ></i> edit profile</a>
        @else
            <h4 class="text-center">{{ $currentUser->name }}</h4>
            <div class="alert alert-info">
                Avatar this site use <a href="http://en.gravatar.com/">Gravatar avatar</a>
            </div>
            <hr/>
            <a class="btn btn-default btn-block" href="#"><i class="fa fa-user" ></i>  make profile</a>
        @endif
    </div>
</div>


