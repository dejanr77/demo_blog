@extends('layouts.admin')

@section('title','Create Tag')

@section('content')

    <div class="row">
        <div class="col-md-6">
            @include('flash::message')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        <i class="fa fa-plus-square-o" aria-hidden="true"></i> Add a new Tag
                    </h1>
                </div>
                <div class="panel-body">
                    {!! Form::model($tag = new App\Models\Tag(),['url' => 'admin/article/tag','role' => 'form']) !!}
                    @include('admin.tags.partials.form',['submitText' => 'Add Tag'])
                    {!! Form::close() !!}
                </div>
                <div class="panel-footer">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>

@endsection



