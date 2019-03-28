@extends('layouts.master')

@section('style')

    <link rel="stylesheet" href="{{asset('bower_resources/datatables.net-bs/css/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

@endsection

@section('main')
    <section class="content-header">
        <h1>
            Data Table
            <small>Requestplatform</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
                @if($errors->any())
                     <div class="alert alert-danger">
                         @foreach($errors->all() as $error)
                             <li>{!! $error !!}</li>
                             @endforeach
                     </div>
                 @endif
                <div class="box box-warning">
                    <div class="box-header">
                        <a href="/admin/request-platform/create" class="btn btn-flat btn-success">Request Machine & Parts</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive" style="overflow: auto">
                            <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Machine Category Id</th>
                                <th>Machine Id</th>
                                <th>Machine Token</th>
                                <th>Parts Name</th>
                                <th>Created At</th>
                                <th>Updated at</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody valign = "middle">
                            @foreach($requestplatform as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->machineCategory->category }}</td>
                                    <td><a href="/admin/machineDetails/{{$item->machine_id}}">{{ $item->machine_id }}</a></td>
                                    <td><a href="/admin/machineDetails/{{ $item->machine_id }}">{{ $item->machine->machine_token }}</a> </td>
                                    <td>{{ $item->parts->parts }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        {!! Form::open(['method'=>'post','url' => ['/admin/request-platform/approve'],'style' => 'display:inline-block']) !!}

                                        <input type="hidden" name="requestId" value="{{$item->id}}">
                                            @if($approve = $item->approved == 1)
                                                <button disabled class="btn btn-success btn-sm disabled"><i class="fa fa-check-square-o" aria-hidden="true"></i> Approved</button>
                                            @elseif($approve == 0)
                                                <button class="btn btn-danger btn-sm"><i class="fa fa-check" aria-hidden="true"></i> Approve</button>
                                            @endif

                                        {!! Form::close() !!}
                                               {!! Form::open(['method'=>'post','url' => ['/admin/request-platform/deliver'],'style' => 'display:inline-block']) !!}

                                                <input type="hidden" name="requestId" value="{{$item->id}}">
                                                @if($item->deliver == 1)
                                                    <button class="btn btn-success btn-sm disabled" disabled><i class="fa fa-check-square-o" aria-hidden="true"></i> Delivered</button>
                                                @elseif($item->deliver == 0)
                                                    <button {{$approve==0?"disabled":""}} class="btn btn-warning btn-sm {{$approve==0?"disabled":""}}"><i class="fa fa-check" disabled aria-hidden="true"></i> Deliver</button>
                                                @endif
                                                {!! Form::close() !!}
                                                {!! Form::open(['method'=>'DELETE','url' => ['/admin/request-platform', $item->id],'style' => 'display:inline']) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array('type' => 'submit','class' => 'btn btn-danger btn-sm','title' => 'Delete RequestPlatform','onclick'=>'return confirm("Confirm delete?")')) !!}
                                                {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                        
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

            });
        </script>
@endsection






