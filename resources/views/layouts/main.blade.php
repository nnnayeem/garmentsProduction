<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="{{asset('/css/resources/normalize.css')}}">
    <link rel="stylesheet" href="{{'/css/vendor/grid.css'}}">
    {{--<link rel="stylesheet" href="{{'css/vendor/jquery-ui.min.css'}}">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightslider/1.1.6/css/lightslider.min.css">
    <link rel="stylesheet" href="{{'/css/resources/main.css'}}">
    <link rel="stylesheet" href="{{'/css/vendor/ionicons.min.css'}}">

    @yield('css')
</head>
<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->

<!-- Add your site or application content here -->

@include("include.main-header")
<section class="container">
    <div class="content">
        @include('include.commerce-sidepart')

        <div class="col span_3_of_4 box">
            <main class="main-content">
                {{--@include('include.commerce-slider')--}}
                @yield('commerce-slider')
                @yield('main-content')
            </main><!-- ./main -->
        </div>
    </div>
</section>

<footer class="container">
    @include('include.commerce-footer')
</footer>
@yield('script')


</body>
</html>
























