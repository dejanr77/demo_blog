<div class="form-group">
    {!! Form::label('name','Name: ') !!}
    {!! Form::text('name',null,['class' => 'form-control']) !!}
    @if ($errors->has('name'))
        <span class="help-block">
            <strong class="text-danger">{{ $errors->first('name') }}</strong>
        </span>
    @endif
</div>

<div class="form-group">
    {!! Form::submit($submitText,['class' => 'btn btn-primary btn-block']) !!}
</div>
