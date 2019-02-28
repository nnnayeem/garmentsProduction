@extends('layouts.master')

@section('style')

    <link rel="stylesheet" href="{{asset('bower_resources/datatables.net-bs/css/dataTables.bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('bower_resources/bootstrap-datepicker/dist/css/bootstrap-datepicker.css')}}">

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
            <small>Defected Machine List</small>
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
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form class="form" method="post" action="{{route('HistoryController.SortPlatform')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="print" value="0">
                            <table class="table">
                                <tr>
                                    <td style="width: 1%"><b class="pull-right">Sort:</b></td>
                                    <td style="width: 10%">
                                        <div class="form-group">
                                            <select class="form-control" name="floor" id="floor">
                                                <option value="0">Select Floor</option>
                                                @foreach($floors as $floor)
                                                    <option value="{{$floor->id}}">{{$floor->floor}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td style="width: 12%">
                                        <div class="form-group">
                                            <input type="number" name="line" class="form-control" placeholder="line No.(keep empty for sorting all line)">
                                        </div>
                                    </td>
                                    <td style="width: 10%">
                                        <div class="form-group">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" name="date" class="form-control pull-right" placeholder="select date to sort" id="datepicker">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </td>
                                    <td style="width: 10%">
                                        <input type="submit" class="btn btn-primary btn-flat" value="start sorting">
                                    </td>
                                </tr>
                            </table>
                        </form>

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Floor</th>
                                <th class="text-center">Switch</th>
                                <th class="text-center">Started</th>
                                <th class="text-center">Ended</th>
                                <th class="text-center">Duration<b>(d:h:m:s)</b></th>
                                <th class="text-center">Status</th>
                            </tr>
                            </thead>
                            <tbody align="center" valign = "middle">
                            @foreach($platform as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->floor }}</td>
                                    <td>{{ $item->switch }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->end_time?$item->end_time:'-----' }}</td>
                                    <td>
                                        @if($item->end_time)
                                            {{$item->created_at->diff(Carbon\Carbon::parse($item->end_time))->format('%D:%H:%i:%s')}}
                                        @else
                                            -----
                                        @endif

                                    </td>
                                    <td>
                                        {!! $item->end_time?'<span class="label label-success">Machine Running</span>':'<span class="label label-danger">Machine Not Running</span>' !!}
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

    <script src="{{asset('bower_resources/bootstrap-datepicker/dist/js/bootstrap-datepicker.js')}}"></script>

    <script src="{{asset('bower_resources/admin-lte/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('bower_resources/admin-lte/dist/js/demo.js')}}"></script>
    <script>

            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : true,
                'ordering'    : false,
                'info'        : true,
                'autoWidth'   : false,
                "pageLength"  : 15
            });


        $('#datepicker').datepicker({
            autoclose: true,
            format:'yyyy-mm-dd'
        })
    </script>
@endsection






