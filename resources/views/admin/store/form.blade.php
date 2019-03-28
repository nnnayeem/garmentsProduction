<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    {!! Form::label('type', 'Select Type', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('type', ['0'=>'select type',1=>'Machine',2=>'Parts'], null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','id'=>'type'] : ['class' => 'form-control','id'=>'type']) !!}
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('machine_category_id') ? 'has-error' : ''}}">
    {!! Form::label('machine_category_id', 'Select Machine', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('machine_category_id', ['0'=>'--select machine category--']+$cats, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','id'=>'machineCat','disabled'=>true] : ['class' => 'form-control','id'=>'machineCat','disabled'=>true]) !!}
        {!! $errors->first('machine_category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div id="partsWrap" style="display: none;">
    <div class="form-group {{ $errors->has('parts_id') ? 'has-error' : ''}}">
        {!! Form::label('parts_id', 'Machine Parts', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::select('parts_id', ['0'=>'--select machine parts--'], null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','id'=>'machineParts','disabled'] : ['class' => 'form-control','id'=>'machineParts','disabled']) !!}
            {!! $errors->first('parts_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    {!! Form::label('price', 'Price', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('price', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('qty') ? 'has-error' : ''}}">
    {!! Form::label('qty', 'Quantity', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('qty', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','id'=>'qty'] : ['class' => 'form-control', 'id'=>'qty']) !!}
        {!! $errors->first('qty', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input type="submit" id="submitButton" style="display: none" class="btn btn-primary">
    </div>
</div>
