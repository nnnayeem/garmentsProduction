<div class="form-group {{ $errors->has('order_id') ? 'has-error' : ''}}">
    {!! Form::label('order_id', 'Order Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('order_id', [0=>'select order']+$orders, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('order_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('floor_id') ? 'has-error' : ''}}">
    {!! Form::label('floor_id', 'Floor Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('floor_id', [0=>'select order']+$floors, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('floor_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('line') ? 'has-error' : ''}}">
    {!! Form::label('line', 'Line', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('line', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control','min'=>1]) !!}
        {!! $errors->first('line', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('day') ? 'has-error' : ''}}">
    {!! Form::label('day', 'Day', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        <div class="input-group date">
            <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </div>
            {!! Form::text('day', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required','id'=>'datepicker'] : ['class' => 'form-control','min'=>1,'id'=>'datepicker']) !!}
        </div>
        {!! $errors->first('day', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('target') ? 'has-error' : ''}}">
    {!! Form::label('target', 'Target', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('target', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control','min'=>1]) !!}
        {!! $errors->first('target', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
