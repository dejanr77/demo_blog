@extends('layouts.public')

@section('title','User Center | notification')

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
                        <div class="panel-heading">
                            <h1>
                                {!! $notification->body !!}
                            </h1>
                        </div>
                        <div class="panel-body">
                            <p><strong>From:</strong> {{ $notification->notificationFrom->name }}</p>
                            <div>
                                @if(isset($comment))
                                    <p>
                                        Comment:
                                    </p>
                                    <div class="well">
                                        {!! $comment->body !!}
                                    </div>
                                @endif
                                <p>Article:</p>
                                <div class="well">
                                    <h2>
                                        {!! $article->title !!}
                                    </h2>
                                    {!! $article->body !!}
                                </div>

                            </div>
                            <a class="btn btn-default" href="{{ url()->previous() }}">
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection