@extends('layouts.admin')

@section('title','Tags')

@section('content')

    <div class="row">
        <div class="col-md-10">
            @include('flash::message')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        <i class="fa fa-tags" aria-hidden="true"></i> Tags
                    </h1>
                </div>
                <div class="panel-body">
                    @can('tag.create')
                    <p>
                        <a class="btn btn-default" href="{{ route('admin.article.tag.create') }}">
                            Create Tag
                        </a>
                    </p>
                    @endcan
                    @if(count($tags) > 0)
                        <div class="table-responsive">
                            <table class="table  table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Article number</th>
                                    <th></th>
                                    <th>action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>
                                            {{ $tag->id }}
                                        </td>
                                        <td>
                                            {{ $tag->name }}
                                        </td>
                                        <td>
                                            {{ $tag->articles_count }}
                                        </td>
                                        <td>
                                            <i class="fa fa-calendar"></i>
                                            {{ $tag->created_at->diffForHumans() }}
                                        </td>
                                        <td>
                                            <div class="btn-group-xs" role="group">
                                                <a class="btn btn-default" href="{{ route('admin.article.tag.edit',['tag' => $tag->slug]) }}">
                                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                                <a class="btn btn-danger" href="{{ route('admin.article.tag.delete',['article' => $tag->slug]) }}">
                                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {{ $tags->render() }}
                        </div>
                    @else
                        <div class="well">
                            there are no tag.
                        </div>
                    @endif
                </div>
                <div class="panel-footer">
                    &nbsp;
                </div>
            </div>
        </div>
    </div>

@endsection



