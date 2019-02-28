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
            Data Table
            <small>Generalstore</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning">
                    <div class="box-header">
                        <a href="/admin/general-store/create" class="btn btn-flat btn-success">Add general-store</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        @if(!is_null(Session('error')))
                        <div class="alert alert-danger">
                            {{Session('error')}}
                        </div>
                        @endif
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Order Id</th>
                                <th>Accessories</th>
                                <th>User</th>
                                <th>Quantity</th>
                                <th>Requested</th>
                                <th>Delivered</th>
                                <th>Delivered Quantity</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody valign = "middle">
                            @foreach($generalstore as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->order_id }}</td>
                                    <td>{{ $item->accessoriese_id }}</td>
                                    <td>{{ $item->user_id }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->delivered_qty }}</td>
                                    <td>{{ $item->delivered }}</td>
                                    <td>
{{--                                        <a href="{{ url('/admin/general-store/' . $item->id) }}" title="View GeneralStore"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>--}}

                                        @if(is_null($item->delivered))
                                            <a href="{{ url('/admin/general-store/' . $item->id) }}" title="View GeneralStore"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Deliver</button></a>
                                            <a href="{{ url('/admin/general-store/' . $item->id . '/edit') }}" title="Edit GeneralStore"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                        @else
                                            <a href="#" title="Edit GeneralStore"><button class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delivered</button></a>
                                        @endif
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/admin/general-store', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete GeneralStore',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <!-- /.box -->
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

    <script src="{{asset('bower_resources/admin-lte/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('bower_resources/admin-lte/dist/js/demo.js')}}"></script>
    <script>
            $(function () {
                $('#example2').DataTable({
                    'paging'      : true,
                    'lengthChange': false,
                    'searching'   : true,
                    'ordering'    : false,
                    'info'        : true,
                    'autoWidth'   : false,
                    "pageLength"  : 15
                });

                $(document).ready(function(){
                    console.log({!! Session::has('deleted') !!});
                    if({!! Session::has('deleted')?1:0 !!}) {
                        notif({
                            type: "success",
                            msg: "{{Session('deleted')}}",
                            position: "right",
                            fade: true,
                            multiline: true
                        });
                    }

                    if({!! Session::has('created')?1:0 !!}) {
                        notif({
                            type: "success",
                            msg: "{{Session('created')}}",
                            position: "right",
                            fade: true,
                            multiline: true
                        });
                    }

                    if({!! Session::has('updated')?1:0 !!}) {
                        notif({
                            type: "success",
                            msg: "{{Session('updated')}}",
                            position: "right",
                            fade: true,
                            multiline: true
                        });
                    }
                });
            });
        </script>
@endsection






