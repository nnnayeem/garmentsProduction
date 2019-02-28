@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="{{asset('bower_resources/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_resources/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_resources/Ionicons/css/ionicons.min.css')}}">

    {{--<link rel="stylesheet" href="{{asset('bower_resources/bootstrap-daterangepicker/daterangepicker.css')}}">--}}
    {{--<link rel="stylesheet" href="{{asset('bower_resources/bootstrap-datepicker/dist/css/bootstrap-datepicker.css')}}">--}}
    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/plugins/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{asset('bower_resources/select2/dist/css/select2.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
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

@section('main')
    <section class="content-header">
        <h1>
            Create User

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">User</a></li>
            <li class="active">User Create</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        @if(Session()->has('success'))
            <div class="row">
                <div class="col-md-12">
                    <div class="callout callout-success">
                        <p>{{Session()->get('success')}}</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-6">
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

                                {!! Form::open(['action' => 'PermissionController@store', 'method' => 'post','files' => true]) !!}
                                <div class="form-group{{$errors->has('name')?" has-error":''}}">
                                    {!!Form::label('name', 'Permission*')!!}
                                    {!!Form::text('name', null, ['class'=>'form-control','placeholder'=>'please '])!!}
                                    {!! $errors->has('name')?"<small class='help-block pull-right'>".$errors->first('name')."</small>":'' !!}
                                </div>


                                <div class = "form-group">
                                    {!!Form::submit('Create Permission',['class' => 'btn btn-success btn-flat' ])!!}
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
            </div>

            <div class="col-md-6">
                <div class="box box-warning">
                    <div class="box-header">
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <table id="example2" class="table table-condensed table-hover">
                            <thead>
                            <tr>
                                <th>Id.</th>
                                <th>Permission</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($permissions) > 0)
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{$permission->id}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td>
                                            <a href="/admin/roles/update"><i class="fa fa-pencil-square-o text-warning"></i> </a>
                                            <a href="/admin/roles/update"><i class="fa fa-trash text-warning"></i> </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>

    </section>
@endsection

@section('script')
    !-- jQuery 3 -->
    <script src="{{asset('bower_resources/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('bower_resources/bootstrap/dist/js/bootstrap.min.js')}}"></script>


    <script src="{{asset('bower_resources/select2/dist/js/select2.full.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('bower_resources/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>

    <script src="{{asset('bower_resources/fastclick/lib/fastclick.js')}}"></script>

    <script src="{{asset('bower_resources/admin-lte/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('bower_resources/admin-lte/dist/js/demo.js')}}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('example2').dataTable()

        })
    </script>
@endsection


