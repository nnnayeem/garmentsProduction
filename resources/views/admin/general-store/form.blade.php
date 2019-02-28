<div class="form-group {{ $errors->has('order_id') ? 'has-error' : ''}}">
    {!! Form::label('order_id', 'Order Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('order_id', [0=>'select order']+$orders, null, ('' == 'required') ? ['class' => 'form-control select2', 'required' => 'required'] : ['class' => 'form-control select2']) !!}
        {!! $errors->first('order_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('accessoriese_id') ? 'has-error' : ''}}">
    {!! Form::label('accessoriese_id', 'Accessories', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <div id="accessories">
            {!! Form::select('accessoriese_id', [], null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control','disabled','select2']) !!}
        </div>
        {!! $errors->first('accessoriese_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('qty') ? 'has-error' : ''}}">
    {!! Form::label('qty', 'Quantity', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('qty', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('qty', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
