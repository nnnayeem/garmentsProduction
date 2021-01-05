<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    {!! Form::label('name', 'Order Serial', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('master_lc') ? 'has-error' : ''}}">
    {!! Form::label('master_lc', 'Master LC', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('master_lc', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('master_lc', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('buyer_id') ? 'has-error' : ''}}">
    {!! Form::label('buyer_id', 'Buyer Id', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('buyer_id', [0=>'Select Buyer']+$buyers, null,['class' => 'form-control']) !!}
        {!! $errors->first('buyer_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('qty') ? 'has-error' : ''}}">
    {!! Form::label('qty', 'Qty', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('qty', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('qty', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('amount') ? 'has-error' : ''}}">
    {!! Form::label('amount', 'amount(tk.)', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::number('amount', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('amount', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('start_date') ? 'has-error' : ''}}">
    {!! Form::label('start_date', 'Startind Date', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::input('datetime', 'start_date', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('ending_date') ? 'has-error' : ''}}">
    {!! Form::label('ending_date', 'Ending Date', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::input('datetime', 'ending_date', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('ending_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
