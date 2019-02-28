<div class="form-group {{ $errors->has('machine_category_id') ? 'has-error' : ''}}">
    {!! Form::label('machine_category_id', 'Select Machine Category', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('machine_category_id', $machineCats, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('machine_category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('machine_token') ? 'has-error' : ''}}">
    {!! Form::label('machine_token', 'Machine Token', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('machine_token', null, ['class'=>'form-control','placeholder'=>'Enter Machine Serial Number']) !!}
        {!! $errors->first('machine_token', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
