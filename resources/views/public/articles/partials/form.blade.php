<!-- Name Form Input -->
                <div class="form-group">
                    {!! Form::label('title','Title: ') !!}
                    {!! Form::text('title',null,['class' => 'form-control']) !!}
                    @if ($errors->has('title'))
                    <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('title') }}</strong>
                    </span>
                    @endif
                </div>
                <!-- Excerpt Form Input -->
                <div class="form-group">
                    {!! Form::label('excerpt','Excerpt: ') !!}
                    {!! Form::textarea('excerpt',null,['class' => 'form-control', 'rows' => 2]) !!}
                    @if ($errors->has('excerpt'))
                    <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('excerpt') }}</strong>
                    </span>
                    @endif
                </div>

                <!-- Tags Form Input -->
                <div class="form-group">
                    {!! Form::label('tags','Tags: ') !!}
                    {!! Form::select('tags[]',$tag_list,$article->tag_list,[  'class' => 'form-control selectTags','multiple']) !!}
                    @if ($errors->has('tags'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('tags') }}</strong>
                        </span>
                    @endif
                </div>

                <!-- Comments Form Input -->
                <div class="form-group">
                    {!! Form::checkbox('comments', 1, null,['id' => 'comments_article']) !!}
                    {!! Form::label('comments_article',' Set Comments') !!}
                    @if ($errors->has('status'))
                        <span class="help-block">
                            <strong class="text-danger">{{ $errors->first('status') }}</strong>
                        </span>
                    @endif
                </div>

                <!-- Body Form Input -->
                <div class="form-group">
                    {!! Form::label('body','Body: ') !!}
                    {!! Form::textarea('body',null,['class' => 'form-control editor', 'rows' => 10]) !!}
                    @if ($errors->has('body'))
                    <span class="help-block">
                        <strong class="text-danger">{{ $errors->first('body') }}</strong>
                    </span>
                    @endif
                </div>
                <!-- Add Site  Form Input -->
                <div class="form-group">
                    {!! Form::submit($submitText,['class' => 'btn btn-primary btn-block']) !!}
                </div>