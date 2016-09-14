@extends('layouts.admin')

@section('title','Create Notification')

@section('content')


    <div class="row">
        <div class="col-md-6">
            @include('flash::message')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        <i class="fa fa-plus-square-o" aria-hidden="true"></i> Create a new Notification
                    </h1>
                </div>
                <div class="panel-body">
                    {!! Form::open(['url' => 'admin/notification','role' => 'form']) !!}

                    <div class="form-group">
                        {!! Form::label('user_id','User ID:*') !!}
                        {!! Form::text('user_id',$user_id,['class' => 'form-control']) !!}
                        @if ($errors->has('user_id'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('user_id') }}</strong>
                            </span>
                        @endif
                        <span> * If you do not enter ID, you will send notification to all users.</span>
                    </div>

                    <div class="form-group">
                        {!! Form::label('body','Body: ') !!}
                        {!! Form::textarea('body',null,['class' => 'form-control editor', 'rows' => 4]) !!}
                        @if ($errors->has('body'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('body') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Notify',['class' => 'btn btn-primary btn-block']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="panel-footer">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>

@endsection







