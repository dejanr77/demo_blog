@extends('layouts.public')

@section('title','Edit Profile | '.$currentUser->name)

@section('header')
    @include('public.userCenters.partials.header',['headingText' => 'Edit Profile'])
@endsection

@section('content')
    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @include('public.userCenters.partials.sidebar')
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="panel-body">
                            {!! Form::model($profile,['method'=>'PATCH','url' => 'profile/'.$profile->id,'role' => 'form']) !!}
                            @include('public.userCenters.profiles.partials.form',['submitText' => 'Update Profile'])
                            {!! Form::close()!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection