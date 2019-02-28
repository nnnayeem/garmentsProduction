@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/skins/_all-skins.min.css')}}">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endsection

@section('script')
    <!-- Slimscroll -->
    <script src="{{asset('bower_resources/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>

    <script src="{{asset('bower_resources/fastclick/lib/fastclick.js')}}"></script>

    <script src="{{asset('bower_resources/admin-lte/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('bower_resources/admin-lte/dist/js/demo.js')}}"></script>

    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#machine_category_id').on('change',function () {
            var id = $('#machine_category_id').val();
            $.ajax({
                type:'POST',
                url:'/admin/machines/getMachines',
                data:{id:id},
                success:function(data){
                    console.log(data);
                    var option,status;
                    if(data.error == null){
                        status = '';
                    }else{
                        status = 'disabled';
                    }
                    if(data.success){
                        $.each(data.success,function (key,value) {
                            option += "<option value="+key+">"+value+"</option>"
                        });
                    }else{
                        option = "<option value='0'>No available machine</option>"
                    }
                    var things = "<div class='form-group'><label class='col-md-4 control-label'>Select Machine</label><div class='col-md-6'><select id='machines'"+status+" class='form-control select2' name = 'id'>"+option+"</select></div></div>";
                    $('div#machines').html(things);
                    if(status == 'disabled'){
                        $("#machines").fadeOut(1000);
                    }else{
                        $("#machines").fadeIn(1000);
                    }


                },
                error:function (data) {
                    console.log(data);
                }
            }).done(function () {
                // $('.select2').select2();
            });
        });

    </script>
@endsection

@section('main')
    <section class="content-header">
        <h1>Set Machine</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route("machines.index")}}">Machine</a></li>
            <li class="active">Set Create</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-danger">
            <div class="box-header">
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">

                        {!! Form::open(['method' => 'PATCH','route' => ['setMachine',$floor_id, $switch],'class' => 'form-horizontal','files' => false]) !!}

                                <div class="form-group {{ $errors->has('machine_category_id') ? 'has-error' : ''}}">
                                    {!! Form::label('machine_category_id', 'Select Machine Category', ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::select('machine_category_id', [0=>'Select Machine Category']+$machineCats, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('machine_category_id', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                <div id="machines" style="display: none">
                                    <div class="form-group {{ $errors->has('id') ? 'has-error' : ''}}">
                                        {!! Form::label('id', 'Select Machine', ['class' => 'col-md-4 control-label']) !!}
                                        <div class="col-md-6">
                                            {!! Form::select('id', []+$machines, null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control','id'=>'machine']) !!}
                                            {!! $errors->first('id', '<p class="help-block">:message</p>') !!}
                                        </div>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <div class="col-md-offset-4 col-md-4">
                                        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Add Machine', ['class' => 'btn btn-success']) !!}
                                    </div>
                                </div>


                        {!! Form::close() !!}

                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>

        </div>
        <!-- /.box -->
    </section>
@endsection

