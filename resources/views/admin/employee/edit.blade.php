@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="{{asset('bower_resources/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_resources/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_resources/Ionicons/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/AdminLTE.min.css')}}">

    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/skins/_all-skins.min.css')}}">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endsection

@section('main')
    <section class="content-header">
        <h1> Edit Buyer #{{ $employee->id }}</h1>
        <ol class="breadcrumb">
            <li><a href="/admin/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route("employees.index")}}">employee</a></li>
            <li class="active">Edit employee</li>
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
                    <div class="col-md-3">
                        {{--<img src="{{asset(is_null($photo)?"images/avatar3.png":$photo)}}" class="img-responsive img-rounded" style="width:100%;">--}}
                    </div>
                    <div class="col-md-8">

                        @include('include.errors')

                      {!! Form::model($employee, [
                          'method' => 'PATCH',
                          'url' => ['/admin/employees', $employee->id],
                          'class' => 'form-horizontal',
                          'files' => true
                      ]) !!}

                      @include ('admin.employee.form', ['submitButtonText' => 'Update'])

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

@section('script')
    !-- jQuery 3 -->
    <script src="{{asset('bower_resources/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('bower_resources/bootstrap/dist/js/bootstrap.min.js')}}"></script>


    <script src="{{asset('bower_resources/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>

    <script src="{{asset('bower_resources/admin-lte/dist/js/adminlte.min.js')}}"></script>

@endsection

