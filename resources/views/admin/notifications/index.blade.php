@extends('layouts.admin')

@section('title','Notifications')

@section('content')


    <div class="row">
        <div class="col-md-10">
            @include('flash::message')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        <i class="fa fa-flag-o" aria-hidden="true"></i> Notifications
                    </h1>
                </div>
                <div class="panel-body">
                    @if(count($notifications) > 0)

                        <div class="table-responsive">
                            <table class="table  table-hover">
                                <thead>
                                <tr>
                                    <th>From</th>
                                    <th>Notification</th>
                                    <th>Read</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($notifications as $notification)
                                    <tr @if($notification->new) class="bg-danger" @endif>
                                        <td>
                                            {!! $notification->notificationFrom->name !!}
                                        </td>
                                        <td>
                                            {!! $notification->body !!}
                                        </td>
                                        <td>
                                            @if($notification->new) <i class="fa fa-times" aria-hidden="true"></i> @else <i class="fa fa-check" aria-hidden="true"></i> @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-default btn-xs text-info" href="{{ route('admin.notification.show',['notification' => $notification->id]) }}">show</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>

                        </div>
                    @else
                        <p class="well">
                            there are no notifications.
                        </p>
                    @endif
                </div>
                <div class="panel-footer">
                    {!! $notifications->render() !!}
                    &nbsp;
                </div>
            </div>
        </div>
    </div>

@endsection



