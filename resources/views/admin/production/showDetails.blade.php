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
<style>
.table-bordered > thead > tr > th, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
    border: 1px solid #000;
}




</style>
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
                        <form target="_blank" class="form" method="post" action="{{route('HistoryController.SortPlatform')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="print" value="1">
                            <table class="table">
                                <tr>
                                    <td style="width: 1%"><b class="pull-right">Sort:</b></td>
                                    <td style="width: 10%">
                                        <div class="form-group">
                                            <input type="text" disabled="disabled" value="Floor id:{{$floor}}" class="form-control" placeholder="Enter floor">
                                            <input type="hidden" name="floor" value="{{$floor}}" class="form-control" placeholder="Enter floor">
                                        </div>
                                    </td>
                                    <td style="width: 12%">
                                        <div class="form-group">
                                            <input type="number" disabled="disabled" value="{{$line}}" class="form-control" placeholder="line No.(keep empty for sorting all line)">
                                            <input type="hidden" value="{{$line}}" name="line" class="form-control" placeholder="line No.(keep empty for sorting all line)">
                                        </div>
                                    </td>
                                    <td style="width: 10%">
                                        <div class="form-group">
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" disabled="disabled" value="{{$date}}" class="form-control pull-right" placeholder="select date to sort" id="datepicker">
                                                <input type="hidden" name="date" value="{{$date}}" class="form-control pull-right" placeholder="select date to sort" id="datepicker">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                    </td>
                                    <td style="width: 10%">
                                        <input type="submit" class="btn btn-primary btn-flat" value="print">
                                    </td>
                                </tr>
                            </table>
                        </form>
                        @php 
                            $total = [
                                [0,0,0],
                                [0,0,0],
                                [0,0,0],
                                [0,0,0],
                                [0,0,0],
                                [0,0,0],
                                [0,0,0],
                                [0,0,0]
                            ]
                         @endphp
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr class='text-center'>
                                <th>StartTime - EndTime</th>
                                @for($i=1;$i<=8;$i++)
                                    <th class="text-center">
                                        Line-{{$i}}
                                        <br>
                                        R/Y/G
                                    </th>
                                @endfor
                            </tr>
                            </thead>
                            <tbody >
                            @if(!empty($data))

                                @foreach($data as $time => $targetHourlyDetails)
                                    @if(!empty($targetHourlyDetails))
                                    @php
                                        $checked = 0;
                                        foreach($targetHourlyDetails as $info){
                                            if(!empty($info)){
                                                $checked = 1;
                                                break;
                                            } 
                                        }
                                     @endphp
                                        @if($checked == 1)
                                        <tr class='text-center'>
                                            <td>{{ $time }}:00-{{ $time+1 }}:00</td>
                                            @php $line=0; @endphp
                                            {{-- iterating line 1,2,3,4,5,6,7--}}
                                            @foreach($targetHourlyDetails as $key=>$item)
                                                @if(!empty($item))
                                                    {{-- Showing line production --}}
                                                    <td>{{ $item->red }}-{{ $item->yellow }}-{{ $item->green }}</td>
                                                    @php 
                                                        $details = array(3);
                                                        $details[0] = $item->red;
                                                        $details[1] = $item->yellow;
                                                        $details[2] = $item->green;

                                                        $total[$line][0] = $total[$line][0]+$details[0];
                                                        $total[$line][1] = $total[$line][1]+$details[1];
                                                        $total[$line][2] = $total[$line][2]+$details[2];
                                                    @endphp
                                                    @else
                                                    <td class='text-center'>0-0-0</td>
                                                @endif
                                                @php $line++; @endphp
                                                {{-- Updating line index after showing one row --}}
                                            @endforeach
                                        </tr>
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                            </tbody>
                            <tfoot >
                                <tr class="text-center">
                                    <td>Total</td>
                                    {{-- @php dd($total) @endphp --}}
                                    @for($n=0;$n<8;$n++)
                                        <th class="text-center">{{$total[$n][0]}}-{{$total[$n][1]}}-{{$total[$n][2]}}</th>
                                    @endfor
                                    
                                </tr>
                            </tfoot>
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
    {{--<script src="{{asset('bower_resources/admin-lte/dist/js/demo.js')}}"></script>--}}
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
    </script>
@endsection






