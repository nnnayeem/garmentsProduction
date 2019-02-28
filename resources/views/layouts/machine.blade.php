<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name')}}</title>

    <!-- Bootstrap -->
    {{--<link href="{{asset('css/b-2.css')}}" rel="stylesheet">--}}
    <link href="{{asset('css/front.css')}}" rel="stylesheet">
    {{--<link href="{{asset('css/machineMain.css')}}" rel="stylesheet">--}}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div id="app"></div>

@yield('content')
<script src="{{asset('js/app.js')}}"></script>
@yield("js")
</body>
</html>