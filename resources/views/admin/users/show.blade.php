@extends('layouts.admin')

@section('title','User | '.$user->name)

@section('content')

    <div class="row">
        <div class="col-md-12">
            @include('flash::message')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        <i class="fa fa-user" aria-hidden="true"></i> User: {{ $user->present()->publicFullName() }}
                    </h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h2 class="page-header">
                                Details:
                            </h2>
                            <div class="well">
                                <div>
                                    <span><b>Name: </b> {{ $user->present()->publicFullName() }}</span><br/>
                                    <span><b>E-mail: </b> {{ $user->email }}</span>
                                    <hr/>
                                </div>
                                @if($user->profile)
                                    <span><b>First name: </b>{{ $user->profile->first_name }}</span><br/>
                                    <span><b>Last name: </b>{{ $user->profile->last_name }}</span><br/>
                                    <span><b>Title: </b>{{ $user->profile->title }}</span><br/>
                                    <span><b>Description: </b></span>
                                    {!! $user->profile->description !!}
                                @endif
                                @can('user.menage')
                                <hr/>
                                {!! Form::model($user,['url' => 'admin/user/'.$user->id,'method'=>'patch','class' => 'form-inline','id' =>'change_role']) !!}
                                {!! Form::label('role_id','Role: ') !!}
                                {!! Form::select('role_id',$role_list,$user->roles[0]->id,['class' => 'form-control']) !!}
                                {!! Form::submit('Change',['class' => 'btn btn-default']) !!}
                                {!! Form::close() !!}
                                @endcan
                            </div>
                            <p>
                                <a class="btn btn-default" href="{{ route('admin.notification.create',['user_id' => $user->id]) }}">
                                    notify user
                                </a>
                            </p>
                            @can('user.menage')
                            <h2 class="page-header">
                                User Center:
                            </h2>
                            <span>
                                Go to your <a class="btn btn-default" href="{{ route('public.userCenters.show',['user' => $user->id]) }}">
                                    <i class="fa fa-user" aria-hidden="true"> User Center</i>
                                </a
                            </span>
                            @endcan
                        </div>
                        <div class="col-md-8">
                            <h2 class="page-header">
                                Articles:
                            </h2>
                            @if(count($articles) > 0)
                            <div class="table-responsive">
                                <table class="table  table-hover">
                                    <thead>
                                    <tr>
                                        <th>title</th>
                                        <th></th>
                                        <th>action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($articles as $article)
                                        <tr>
                                            <td>{{ $article->title }}</td>
                                            <td class="text-right">
                                                <span title="likes">
                                                    <i class="fa fa-heart"></i> {{ $article->like_count }}
                                                </span>
                                                <span title="views">
                                                     <i class="fa fa-eye"></i> {{ $article->view_count }}
                                                </span>
                                                <span title="comments">
                                                    <i class="fa fa-comments"></i> {{ $article->comment_count }}
                                                </span>
                                                <span title="created at">
                                                    <i class="fa fa-calendar"></i> {{ $article->created_at->diffForHumans() }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group-xs" role="group">
                                                    <a class="btn btn-default preview_article" href="{{ route('admin.article.show',['previews' => $article->id]) }}" target="_blank">
                                                        <i class="fa fa-eye-slash" aria-hidden="true"></i> preview
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                                <div class="well">
                                    there are no articles.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-default" href="{{ url()->previous() }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Role</h4>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection


