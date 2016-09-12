@extends('layouts.public')

@section('title','User center | home')

@section('header')
    @include('public.userCenters.partials.header',['headingText' => 'User Center | Home'])
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

                        @if(count($activities) > 0)
                            <div class="table-responsive table_activity">
                                <table class="table  table-hover">
                                    <thead>
                                    <tr>
                                        <th>Activity</th>
                                        <th class="text-right">Modified at</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($activities as $activity)
                                        <tr class="small">
                                            <td>
                                                {!! $activity->content !!}
                                            </td>
                                            <td class="text-right">
                                                <i class="fa fa-calendar"></i> {{ $activity->updated_at->diffForHumans() }}
                                            </td>

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="2">
                                            {!! $activities->render() !!} &nbsp;
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>
                                Sorry, by now you have no activities.
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection