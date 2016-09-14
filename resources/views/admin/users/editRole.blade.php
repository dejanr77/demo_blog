@extends('layouts.admin')

@section('title','Role | '.$role->name)

@section('content')

    <div class="row">
        <div class="col-md-6">
            @include('flash::message')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Role: {{ $role->name }}
                    </h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        {!! Form::model($role,['url' => 'admin/user/roles/'.$role->id,'method'=>'patch','role' => 'form']) !!}
                        <div class="form-group col-md-12">
                            {!! Form::label('description','Description: ') !!}
                            {!! Form::textarea('description',null,['class' => 'form-control', 'rows' => 2]) !!}
                            @if ($errors->has('description'))
                            <span class="help-block">
                                <strong class="text-danger">{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-md-12">
                            {!! Form::label('permission_id','Permissions: ') !!}
                        </div>
                        @foreach($permissions as $permission)
                            <div class="form-group col-md-6">
                                {!! Form::checkbox('permission_ids[]', $permission->id, $role->permissions->pluck('name','name')->has($permission->name)) !!}
                                <span> {!! $permission->name !!}</span>
                                @if ($errors->has($permission->name))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first($permission->name) }}</strong>
                                    </span>
                                @endif
                            </div>
                        @endforeach
                        <div class="col-md-12">
                            <hr/>
                        </div>
                        <div class="col-md-12">
                            {!! Form::submit('Update',['class' => 'btn btn-default']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="panel-footer">
                    <a class="btn btn-default" href="{{ url()->previous() }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
