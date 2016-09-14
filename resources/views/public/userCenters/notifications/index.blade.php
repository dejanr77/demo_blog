@extends('layouts.public')

@section('title','User Center | notifications')

@section('header')
    @include('public.userCenters.partials.header',['headingText' => 'User Center | Notifications'])
@endsection

@section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
            @include('public.userCenters.partials.sidebar')
            </div>
            <div class="col-md-9">
                <div class="panel panel-default panel-user-info">
                    <div class="panel-body">
                        @include('public.userCenters.partials.nav')

                        @if(count($notifications) > 0)
                            <div class="table-responsive table_articles">
                                <table class="table  table-hover">
                                    <thead>
                                    <tr>
                                        <th>From</th>
                                        <th>Notification</th>
                                        <th>Read</th>
                                        <th>Details</th>
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
                                                <a class="text-info" href="{{ route('public.userCenters.showNotification',['notification' => $notification->id]) }}">show more</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4">
                                            {!! $notifications->render() !!}&nbsp;
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="well">
                                Sorry, You don't have any notifications.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

