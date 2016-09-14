@extends('layouts.admin')

@section('title','Users')

@section('content')

    <div class="row">
        <div class="col-md-12">
            @include('flash::message')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        <i class="fa fa-users" aria-hidden="true"></i> Users
                    </h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6 search_form">
                            {!! Form::open(['method'=>'get','class' => 'form-inline']) !!}
                            {!! Form::select('role',$role_list,$selected_role,['class' => 'form-control']) !!}
                            {!! Form::select('dir', array('asc' => 'ascending', 'dsc' => 'descending'),$dir,['class' => 'form-control']) !!}
                            <div class="input-group">
                            {!! Form::text('search',null,['class' => 'form-control', 'placeholder' => 'Search for user...']) !!}
                            <span class="input-group-btn">
                            {!! Form::submit('Go',['class' => 'btn btn-default btn-block']) !!}
                            </span>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    @if(count($users) > 0)
                        <div class="table-responsive">
                            <table class="table  table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th></th>
                                    <th>Creation date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->roles[0]->name }}</td>
                                    <td>
                                        <a class="btn btn-default btn-xs" href="{{ route('admin.user.show',['user' => $user->id]) }}">
                                            <i class="fa fa-eye" aria-hidden="true"></i> show
                                        </a>
                                    </td>
                                    <td>{{ $user->created_at->format('F j, Y') }}</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="well">
                            there are no users.
                        </p>
                    @endif
                </div>

                <div class="panel-footer">
                    {{ $users->appends(['role' => $role_name,'dir' => $dir, 'search' => $search])->render() }}
                    &nbsp;
                </div>
            </div>
        </div>
    </div>

@endsection
