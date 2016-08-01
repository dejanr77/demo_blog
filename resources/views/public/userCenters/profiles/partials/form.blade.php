<div class="form-group">
    {!! Form::label('first_name','First Name: ') !!}
    {!! Form::text('first_name',null,['class' => 'form-control']) !!}
    @if ($errors->has('first_name'))
        <span class="help-block">
            <strong class="text-danger">{{ $errors->first('first_name') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    {!! Form::label('last_name','Last Name: ') !!}
    {!! Form::text('last_name',null,['class' => 'form-control']) !!}
    @if ($errors->has('last_name'))
        <span class="help-block">
            <strong class="text-danger">{{ $errors->first('last_name') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    {!! Form::label('title','Title: ') !!}
    {!! Form::text('title',null,['class' => 'form-control']) !!}
    @if ($errors->has('title'))
        <span class="help-block">
            <strong class="text-danger">{{ $errors->first('title') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    {!! Form::label('description','Description: ') !!}
    {!! Form::textarea('description',null,['class' => 'form-control', 'rows' => 6]) !!}
    @if ($errors->has('description'))
        <span class="help-block">
            <strong class="text-danger">{{ $errors->first('description') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    {!! Form::submit($submitText,['class' => 'btn btn-primary btn-block']) !!}
</div>