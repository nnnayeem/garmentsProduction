@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="{{asset('bower_resources/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_resources/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_resources/Ionicons/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('bower_resources/bootstrap-daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="{{asset('bower_resources/bootstrap-datepicker/dist/css/bootstrap-datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/plugins/iCheck/all.css')}}">
    <link rel="stylesheet" href="{{asset('bower_resources/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css')}}">
    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/plugins/timepicker/bootstrap-timepicker.min.css')}}">
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
        <h1> Edit Accessoriese #{{ $accessoriese->id }}</h1>
        <ol class="breadcrumb">
            <li><a href="/admin/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route("accessorieses.index",['order'=>$orderId])}}">accessorieses</a></li>
            <li class="active">Edit accessorieses</li>
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

                         @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                      {!! Form::model($accessoriese, [
                          'method' => 'PATCH',
                          'url' => ['/admin/accessorieses/order/acs/update', $orderId,$accessoriese->id],
                          'class' => 'form-horizontal',
                          'files' => true
                      ]) !!}

                      @include ('admin.accessorieses.form', ['submitButtonText' => 'Update'])

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
            $('.select2').select2()

        })
    </script>

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
                        var things = "<select id='sub_categories_id'"+status+" class='form-control select2' name = 'sub_categories_id'>"+option+"</select>";

                        $('div#subCat').html(things);

                    }
                }).done(function () {
                    $('.select2').select2();
                });
            });
        })
    </script>

@endsection

