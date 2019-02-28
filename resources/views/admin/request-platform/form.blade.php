
<div class="form-group {{ $errors->has('machine_category_id') ? 'has-error' : ''}}">
    {!! Form::label('machine_category_id', 'Machine Category', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('machine_category_id', [0 => 'Select Machine Category']+$cats, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','id'=>'machineCat'] : ['class' => 'form-control','id'=>'machineCat']) !!}
        {!! $errors->first('machine_category_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div id="machineWrap" style="display: none;">
    <div class="form-group {{ $errors->has('machine_id') ? 'has-error' : ''}}">
        {!! Form::label('machine_id', 'Machine Serial', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            <select id="machines" name="machine_id" class="form-control">

            </select>
            {!! $errors->first('machine_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('parts_id') ? 'has-error' : ''}}">
        {!! Form::label('parts_id', 'Select Parts', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            <select id="parts" name="parts_id" class="form-control">

            </select>
            {!! $errors->first('parts_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
