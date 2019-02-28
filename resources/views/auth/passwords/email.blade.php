<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Registration Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('bower_resources/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_resources/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_resources/Ionicons/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/AdminLTE.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/vendor/notifIt.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<style>
    .register-box{
        width: 40%;
    }
    .register-box-body{
        padding: 40px;
    }
</style>
<div class="register-box">
    <div class="register-logo">
        <a href="../../index2.html">{!! $_ENV['APP_NAME'] !!}</a>
        {{--<a href="/"><b>Admin</b>LTE</a>--}}
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Reset Password</p>

        <form method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-12">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                </div>
                <div class="col-xs-8">
                    <div class="form-group has-feedback {{$errors->has('email')?'has-error':''}}">
                        <input type="text" class="form-control" name="email" placeholder="E-mail Address">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>



                            <small class="text-danger">
                                @if ($errors->has('email'))
                                    {{ $errors->first('email') }}
                                @endif
                            </small>


                    </div>

                </div>


                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Reset</button>
                </div>
                <!-- /.col -->
            </div>
        </form>


    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->

<script src="{{asset('bower_resources/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('bower_resources/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/vendor/notifIt.min.js')}}"></script>
</body>
</html>

