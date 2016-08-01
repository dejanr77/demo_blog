@extends('layouts.public')

@section('title','Add Profile | '.$currentUser->name)

@section('header')
    @include('public.userCenters.partials.header',['headingText' => 'Add Profile'])
@endsection

@section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="avatar_img text-center">
                            <img src="http://secure.gravatar.com/avatar/{{ md5($currentUser->email) }}?s=100"  alt="avatar">
                        </div>
                        <h4 class="text-center">{{ $currentUser->name }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::model($profile = new \App\Models\Profile,['url' => 'profile','role' => 'form']) !!}
                        @include('public.userCenters.profiles.partials.form',['submitText' => 'Add Profile'])
                        {!! Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection