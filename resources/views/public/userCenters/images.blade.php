@extends('layouts.public')

@section('title','User center | images')

@section('header')
    @include('public.userCenters.partials.header',['headingText' => 'User Center | Images'])
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
                        <br/>
                        <div class="user-images">
                            <iframe src="{{ url('laravel-filemanager?field_name=mceu_50-inp&type=Images') }}" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection