@extends('layouts.public')

@section('title','Articles | articles')

@section('header')
    @include('public.userCenters.partials.header',['headingText' => 'User Center - Articles'])
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

                        @if(count($articles) > 0)

                        @else
                            <p>
                                Sorry, You don't have any article.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

