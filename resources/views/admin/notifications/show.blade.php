@extends('layouts.admin')

@section('title','Notification')

@section('content')


    <div class="row">
        <div class="col-md-10">
            @include('flash::message')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        <i class="fa fa-flag-o" aria-hidden="true"></i> Notification
                    </h1>
                </div>
                <div class="panel-body">
                    <p>
                        <strong>
                            From:
                        </strong>
                        <a href="{{ route('admin.user.show',['user' => $notification->notificationFrom->id]) }}" class="btn btn-default">
                            {{ $notification->notificationFrom->name }}
                        </a>
                    </p>
                    <p class="well">
                        {!! $notification->body !!}
                    </p>
                    <p>
                        <a class="btn btn-default" href="{{ route('admin.notification.create',['user_id' => $notification->notificationFrom->id]) }}">
                            notify user
                        </a>
                    </p>
                </div>
                <div class="panel-footer">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>

@endsection