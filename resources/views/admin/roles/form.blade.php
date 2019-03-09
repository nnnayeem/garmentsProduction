<div class="form-group{{$errors->has('name')?" has-error":''}}">
    {!!Form::label('name', 'Role*')!!}
    {!!Form::text('name', null, ['class'=>'form-control','placeholder'=>'please '])!!}
    {!! $errors->has('name')?"<small class='help-block pull-right'>".$errors->first('name')."</small>":'' !!}
</div>

@if(count($permissions) > 0)
    <div class = "form-group{{$errors->has('permissions')?" has-error":''}}">
        {!!Form::label('permission','Assign Permission')!!}
        <br>
        @if(is_null($id))
            @foreach($permissions as $permission)
                <div class="icheck-carrot">
                    @php $idPermission = "checkBox".$loop->iteration @endphp
                    {!!Form::checkbox('permissions[]', $permission->name,false,['class' => 'checkbox','id'=>$idPermission])!!}
                    <label for="{{$idPermission}}">{{$permission->name}}</label>
                </div>
            @endforeach
        @else
            @foreach($permissions as $permission)
                <div class="icheck-carrot">
                    @php

                        $idPermission = "checkBox".$loop->iteration;
                    if(in_array($permission->id,$perId)){
                        $check = true;
                    }
                    else
                        $check = false;
                            
                    @endphp
                    {!!Form::checkbox('permissions[]', $permission->name,false,['class' => 'checkbox','id'=>$idPermission,'checked'=>$check])!!}
                    <label for="{{$idPermission}}">{{$permission->name}}</label>
                </div>
            @endforeach
        @endif

    </div>
@endif

<div class = "form-group">
    {!!Form::submit('Submit',['class' => 'btn btn-success btn-flat' ])!!}
</div>
