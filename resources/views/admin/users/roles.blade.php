@extends('layouts.admin')

@section('title','Roles')

@section('content')

    <div class="row">
        <div class="col-md-10">
            @include('flash::message')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        <i class="fa fa-film" aria-hidden="true"></i> Roles
                    </h1>
                </div>
                <div class="panel-body">
                    @if(count($roles) > 0)
                        <div class="table-responsive">
                            <table class="table  table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
                                    <th>Competence</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->slug }}</td>
                                    <td>{{ $role->description }}</td>
                                    <td>
                                    @if(count($role->permissions))
                                        @foreach($role->permissions as $p)
                                            {{ $p->name  }}<br/>
                                        @endforeach
                                    @endif
                                    </td>
                                    <td>
                                        <div class="btn-group btn-group-xs pull-right" role="group">
                                            <a href="{{ route('admin.user.editRole',['role' => $role->id]) }}" class="btn btn-default">
                                                <i class="fa fa-edit"></i> modify role
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="alert alert-info">
                            there are no roles.
                        </p>
                    @endif
                </div>

                <div class="panel-footer">
                    {!! $roles->render() !!}
                    &nbsp;
                </div>
            </div>
        </div>
    </div>

@endsection
