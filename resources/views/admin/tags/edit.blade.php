@extends('layouts.admin')

@section('title','Edit Tag')

@section('content')

    <div class="row">
        <div class="col-md-6">
            @include('flash::message')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit: {{ $tag->name }}
                    </h1>
                </div>
                <div class="panel-body">
                    {!! Form::model($tag,['method'=>'PATCH','url' => 'admin/article/tag/'.$tag->slug,'role' => 'form']) !!}
                    @include('admin.tags.partials.form',['submitText' => 'Update Tag'])
                    {!! Form::close() !!}
                </div>
                <div class="panel-footer">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>

@endsection