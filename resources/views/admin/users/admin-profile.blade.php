@extends('layouts.master')

@section('style')

    <link rel="stylesheet" href="{{asset('bower_resources/datatables.net-bs/css/dataTables.bootstrap.css')}}">
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
            Data Tables
            <small>advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>

    <section class="content">
        @php $data = Auth::user();@endphp
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive" src="{{!empty($user->photo)?Storage::url($user->photo):asset('images/avatar.png')}}" alt="Admin profile picture">
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
                        <li><a href="#passwordDiv" data-toggle="tab">Password</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class=" active tab-pane" id="profile">
                            {!! Form::model($user,['action' => ['ProfileController@UpdateAdminProfile',$user->id], 'method' => 'PATCH','files' => true,'class'=>'form-horizontal']) !!}
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                                <label for="inputName" class="col-sm-2 control-label">First Name</label>

                                <div class="col-sm-10">
                                    {!! Form::text('name',null,['class'=>'form-control']) !!}
                                    {{--<span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter your name.</span>--}}
                                    {!! $errors->first('name', '<p style="font-weight: normal;font-size: 11px;margin-bottom: 0;" class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('myFile') ? 'has-error' : ''}}">
                                <label for="myFile" class="col-sm-2 control-label">Picture</label>

                                <div class="col-sm-10">
                                    <input id="myFile" name="myFile" type="file"><br>
                                    {!! $errors->first('myFile', '<p style="font-weight: normal;font-size: 11px;margin-bottom: 0;" class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                                <label for="phone" class="col-sm-2 control-label">Phone </label>

                                <div class="col-sm-10">
                                    {!! Form::text('phone',null,['class'=>'form-control','disabled'=>false]) !!}
                                    {!! $errors->first('phone', '<p style="font-weight: normal;font-size: 11px;margin-bottom: 0;" class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    {!!Form::submit('Submit',['class' => 'btn btn-success btn-flat' ])!!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="passwordDiv">
                            {!! Form::open(['action' => ['ProfileController@VendorPassword',$user->id], 'method' => 'PATCH','files' => false,'class'=>'form-horizontal']) !!}
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">New Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="password" name="password" placeholder="New Password" type="password">
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter minimum 6 characters.</span>
                                    <span style="display: none" class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="re-password" class="col-sm-2 control-label">Re-Enter Password</label>
                                <div class="col-sm-10">
                                    <input class="form-control" id="re_password" name="password_confirmation" placeholder="Re-Enter Password" type="password">
                                    <span class="help-block" style="font-weight: normal;font-size: 11px;margin-bottom: 0;">Please enter minimum 6 characters.</span>
                                    <span style="display: none" class="help-block"></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    {{--<button type="submit" class="btn btn-danger">Update</button>--}}
                                    {!! Form::submit('Update Password') !!}

                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
@endsection

@section('script')

    <script src="{{asset('bower_resources/datatables.net/js/jquery.dataTables.js')}}"></script>

    <script src="{{asset('bower_resources/datatables.net-bs/js/dataTables.bootstrap.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('bower_resources/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('bower_resources/fastclick/lib/fastclick.js')}}"></script>



    <script src="{{asset('bower_resources/admin-lte/dist/js/adminlte.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('bower_resources/admin-lte/dist/js/demo.js')}}"></script>


@endsection