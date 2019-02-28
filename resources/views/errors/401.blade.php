@extends("layouts.master")

@section('style')
    {{--<link rel="stylesheet" href="{{asset('bower_resources/bootstrap/dist/css/bootstrap.min.css')}}">--}}
    {{--<!-- Font Awesome -->--}}
    {{--<link rel="stylesheet" href="{{asset('bower_resources/font-awesome/css/font-awesome.min.css')}}">--}}
    {{--<!-- Ionicons -->--}}
    {{--<link rel="stylesheet" href="{{asset('bower_resources/Ionicons/css/ionicons.min.css')}}">--}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/skins/_all-skins.min.css')}}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{asset('bower_resources/morris.js/morris.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('bower_resources/jvectormap/jquery-jvectormap.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{asset('bower_resources/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('bower_resources/bootstrap-daterangepicker/daterangepicker.css')}}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

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

    <script src="{{asset('bower_resources/fastclick/lib/fastclick.js')}}"></script>
    <script src="{{asset('bower_resources/admin-lte/dist/js/adminlte.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('bower_resources/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>

    <script src="{{asset('bower_resources/admin-lte/dist/js/pages/dashboard2.js')}}"></script>


@endsection

@section("main")
    <section class="content">
            <div class="error-page">
                <h2 class="headline text-yellow"> 401</h2>

                <div class="error-content">
                    <h3><i class="fa fa-warning text-yellow"></i> Oops! Access Forbidden.</h3>

                    <p>
                        You dont have the permission to enter this page.
                        Meanwhile, you may <a href="/admin">return to dashboard</a> .
                    </p>

                    {{--<form class="search-form">--}}
                        {{--<div class="input-group">--}}
                            {{--<input type="text" name="search" class="form-control" placeholder="Search">--}}

                            {{--<div class="input-group-btn">--}}
                                {{--<button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i>--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<!-- /.input-group -->--}}
                    {{--</form>--}}
                </div>
                <!-- /.error-content -->
            </div>
            <!-- /.error-page -->
        </section>
@endsection