@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="{{asset('bower_resources/select2/dist/css/select2.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/AdminLTE.min.css')}}">

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
    <!-- AdminLTE for demo purposes -->
    <!--<script src="{{asset('bower_resources/admin-lte/dist/js/demo.js')}}"></script>-->

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#machineCat').on('change',function(){
                var catId = $("#machineCat").val();
                $.ajax({
                    type:"post",
                    url:"/admin/request-platform/fetchMachineFromCat",
                    data:{catId:catId},
                    success:function (data) {
                        var option="",status,optionParts="";
                        if(data.error == null){
                            status = '';
                        }else{
                            status = 'disabled';
                        }
                        if(Object.keys(data.success).length > 0){
                            $.each(data.success,function (key,value) {
                                option += "<option value="+key+">"+value+"</option>"
                            });
                        }else{
                            option = "<option value=''>No available machine category found</option>"
                        }


                        if(Object.keys(data.parts).length > 0){
                            $.each(data.parts,function (key,value) {
                                optionParts += "<option value="+key+">"+value+"</option>"
                            });
                        }else{
                            optionParts = "<option value=''>No available parts found</option>"
                        }


                        var things = "<select id='subCat'"+status+" class='form-control select2' name = 'sub_categories_id'>"+option+"</select>";
                        $('select#machines').html(option);
                        $('select#parts').html(optionParts);
                        if(Object.keys(data.success).length > 0){
                            $("#machineWrap").fadeIn(1000);
                        }else{
                            $("#machineWrap").fadeOut(1000);
                        }

                    },
                    error:function (data) {
                        console.log(data);
                    }


                })
            });
        })
    </script>
@endsection

@section('main')
    <section class="content-header">
            <h1>Create New Request</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
               <li><a href="{{route("request-platform.index")}}">RequestPlatform</a></li>
                <li class="active">Create Request</li>
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
                             @if($errors->any())
                                 <div class="alert alert-danger">
                                     @foreach($errors->all() as $error)
                                         <li>{!! $error !!}</li>
                                         @endforeach
                                 </div>
                             @endif

                              {!! Form::open(['url' => '/admin/request-platform', 'class' => 'form-horizontal', 'files' => true]) !!}

                             @include ('admin.request-platform.form')

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

