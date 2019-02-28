@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="{{asset('bower_resources/select2/dist/css/select2.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('css/vendor/notifIt.min.css')}}">

    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/skins/_all-skins.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endsection

@section('script')

    <script src="{{asset('bower_resources/select2/dist/js/select2.full.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('bower_resources/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>

    <script src="{{asset('bower_resources/fastclick/lib/fastclick.js')}}"></script>

    <script src="{{asset('bower_resources/admin-lte/dist/js/adminlte.min.js')}}"></script>

    <script src="{{asset('js/vendor/notifIt.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('bower_resources/admin-lte/dist/js/demo.js')}}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#category').on('change',function () {
                var id = $('#category').val();
                console.log(id);
                $.ajax({
                    type:'POST',
                    url:'/getSubCat',
                    data:{id:id},
                    success:function(data){
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
                            option = "<option value='0'>No available sub category</option>"
                        }
                        var things = "<select id='subCat'"+status+" class='form-control select2' name = 'sub_categories_id'>"+option+"</select>";
                        console.log(data);
                        $('div#subCat').html(things);

                    },
                    error:function (data) {
                        console.log(data);
                    }
                }).done(function () {
                    $('.select2').select2();
                });
            });
            @if(Session()->has('success'))

            $(document).ready(function(){
                notif({
                    msg: "<b>Success!</b> {{Session('success')}}",
                    type: "success",
                    position: "center"
                });
            });
            @endif
        })



    </script>
@endsection

@section('main')
    <section class="content-header">
        <h1>Create New Accessoriese</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route("accessorieses.index",['order'=>$orderId])}}">Accessoriese</a></li>
            <li class="active">Accessoriese Create</li>
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

                        {!! Form::open(['url' => ['/admin/accessorieses/store',$id], 'class' => 'form-horizontal', 'files' => true]) !!}

                        {{--<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
                            {!! Form::label('type', 'Select Option', ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::select('type', ['0'=>'input to store','1'=>'deliver from store'],null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>--}}
                        {!! Form::hidden('type',0) !!}
                        {!! Form::hidden('orderId',$orderId) !!}
                        <div class="form-group {{ $errors->has('qty') ? 'has-error' : ''}}">
                            {!! Form::label('qty', 'qty', ['class' => 'col-md-4 control-label']) !!}
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

