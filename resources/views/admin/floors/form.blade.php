<div class="form-group {{ $errors->has('floor') ? 'has-error' : ''}}">
    {!! Form::label('floor', 'Floor', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('floor', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('floor', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    {!! Form::label('title', 'Title', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('title', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('rows') ? 'has-error' : ''}}">
    {!! Form::label('rows', 'Number Of Rows', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('rows', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('rows', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('MachinePerRow') ? 'has-error' : ''}}">
    {!! Form::label('MachinePerRow', 'Machine Per Row', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('MachinePerRow', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('MachinePerRow', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
