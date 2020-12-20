@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="{{asset('bower_resources/datatables.net-bs/css/dataTables.bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('bower_resources/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_resources/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_resources/Ionicons/css/ionicons.min.css')}}">

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
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endsection

@section('main')
    <style>
        .secondary-table {
            width: 100%;
            table-layout: fixed;
        }

        .secondary-table-head {
            border-bottom: 1px solid #ddd;
        }

        .secondary-table-normal-field{
            width: 100px;
        }

        .secondary-table-input-field{
            width: 200px;
        }

    </style>
    <section class="content-header">
        <h1> Edit Floor #{{ $floor->id }}</h1>
        <ol class="breadcrumb">
            <li><a href="/admin/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route("floors.index")}}">floors</a></li>
            <li class="active">Edit floors</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- SELECT2 EXAMPLE -->
        <div class="box box-danger">
            <div class="box-header">


                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($floor, [
                            'method' => 'PATCH',
                            'url' => ['/admin/floors', $floor->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('admin.floors.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}


                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>

        </div>
        <!-- /.box -->


        <div class="box box-danger">
            <div class="box-header">

            </div>
            <!-- /.box-header -->


            <div class="box-body">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif


                        <div class="table-responsive">
                            <table id="example2" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="100" class="text-center"><h4>
                                            Row Configuration
                                        </h4></th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($floor->controllers as $controller)

                                    <tr>
                                        <td>
                                            <form action="{{url("admin/controllers/".$controller->id)}}" method="POST" accept-charset="UTF-8">
                                                {{--                                        <form action="{{url('controllers/'+$controller->id+'/edit')}}" method="POST" accept-charset="UTF-8">--}}
                                                <input type="hidden" name="_method" value="PATCH">
                                                @csrf
                                                <table class="secondary-table">
                                                    @if($loop->index == 0)
                                                        <thead>
                                                        <tr>
                                                            <th class="secondary-table-normal-field secondary-table-head">
                                                                Row No
                                                            </th>
                                                            <th class="secondary-table-normal-field secondary-table-head">
                                                                Row Title
                                                            </th>
                                                            <th class="secondary-table-normal-field secondary-table-head">
                                                                Floor Title
                                                            </th>
                                                            <th class="secondary-table-input-field secondary-table-head">
                                                                Controller Serial
                                                            </th>
                                                            <th class="secondary-table-input-field secondary-table-head">
                                                                Controller IP
                                                            </th>
                                                            <th class="secondary-table-normal-field secondary-table-head">
                                                                Action
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                    @endif
                                                    <tr>
                                                        <td class="secondary-table-normal-field">
                                                            No {{$controller->line_no}}
                                                        </td>
                                                        <td class="secondary-table-normal-field">
                                                            No {{$controller->line_title}}
                                                        </td>
                                                        <td class="secondary-table-normal-field">{{$floor->title}}</td>
                                                        <td class="secondary-table-input-field">
                                                            <input type="text" class="form-control" value="{{$controller->serial}}" name="serial">
                                                        </td>
                                                        <td class="secondary-table-input-field">
                                                            <input type="text" class="form-control" value="{{$controller->ip}}" name="ip">
                                                        </td>
                                                        <td class="secondary-table-normal-field">
                                                            <input type="submit" class="btn btn-success" value="Update Controller ">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td>No Rows Found</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>


                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>

        </div>


    </section>
@endsection

@section('script')



    <script src="{{asset('bower_resources/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('bower_resources/bootstrap/dist/js/bootstrap.min.js')}}"></script>


    <script src="{{asset('bower_resources/datatables.net/js/jquery.dataTables.js')}}"></script>

    <script src="{{asset('bower_resources/datatables.net-bs/js/dataTables.bootstrap.js')}}"></script>

    <script src="{{asset('bower_resources/admin-lte/dist/js/adminlte.min.js')}}"></script>

    <script>
        $('#example2').DataTable({
            'paging': false,
            'lengthChange': false,
            'searching': false,
            'ordering': false,
            'info': true,
            'autoWidth': false,
        });

    </script>

@endsection

