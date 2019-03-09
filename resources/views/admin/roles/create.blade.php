@extends('layouts.master')

@section('style')

    <link rel="stylesheet" href="{{asset('bower_resources/icheck-bootstrap/icheck-bootstrap.css')}}">
    
    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/AdminLTE.min.css')}}">
   
    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/skins/_all-skins.min.css')}}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endsection

@section('main')
    <section class="content-header">
        <h1>
            Create Roles

        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User Create</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
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

                                {!! Form::open(['action' => 'RoleController@store', 'method' => 'post','files' => true]) !!}
                                    @include('admin.roles.form')
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
        </div>

    </section>
@endsection

@section('script')
    !-- jQuery 3 -->
    // <script src="{{asset('bower_resources/jquery/dist/jquery.min.js')}}"></script>
    // <!-- Bootstrap 3.3.7 -->
    // <script src="{{asset('bower_resources/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    // <!-- Slimscroll -->
    // <script src="{{asset('bower_resources/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>

    // <script src="{{asset('bower_resources/fastclick/lib/fastclick.js')}}"></script>


    // <script src="{{asset('bower_resources/admin-lte/dist/js/adminlte.min.js')}}"></script>
@endsection



