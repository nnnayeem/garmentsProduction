<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Print | Machine Defected Report</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('bower_resources/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_resources/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_resources/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/AdminLTE.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
{{--<body>--}}
<body onload="window.print();">
<div class="wrapper">
    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> Machine Report
                    <small class="pull-right">Date: {{now()->setTimezone(Auth::user()->timezone)->toDateTimeString()}}</small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <h4>Report Details</h4>
                <address>
                    <strong>Date:{{$date}}</strong><br>
                    floor:{{$floor}}<br>
                    line:{!! empty($line)?'<label class="label label-success">All</label>':$line !!}<br>
                </address>
            </div>
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Floor</th>
                        <th class="text-center">Switch</th>
                        <th class="text-center">Started</th>
                        <th class="text-center">Ended</th>
                        <th class="text-center">Duration</th>
                        <th class="text-center">Status</th>
                    </tr>
                    </thead>
                    <tbody align="center" valign = "middle">
                    @if(!empty($platform))
                        @foreach($platform as $item)
                            <tr>
                                <td>{{ $loop->iteration or $item->id }}</td>
                                <td>{{ $item->floor }}</td>
                                <td>{{ $item->switch }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->end_time?$item->end_time:'-----' }}</td>
                                <td>
                                    @if($item->end_time)
                                        {{ $item->created_at->diffInDays($item->end_time) }}:
                                        {{ $item->created_at->diffInHours($item->end_time) }}:
                                        {{ $item->created_at->diffInMinutes($item->end_time) }}:
                                        {{ $item->created_at->diffInSeconds($item->end_time) }}
                                    @else
                                        -----
                                    @endif

                                </td>
                                <td>
                                    {!! $item->end_time?'<span class="label label-success">Machine Running</span>':'<span class="label label-danger">Machine Not Running</span>' !!}
                                </td>
                                {{--<td>
                                    <a href="{{ url('/admin/permission/' . $item->id) }}" title="View permission"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                    <a href="{{ url('/admin/permission/' . $item->id . '/edit') }}" title="Edit permission"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                    {!! Form::open(['method'=>'DELETE','url' => ['/admin/permission', $item->id],'style' => 'display:inline']) !!}
                                    {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array('type' => 'submit','class' => 'btn btn-danger btn-sm','title' => 'Delete permission','onclick'=>'return confirm("Confirm delete?")')) !!}
                                    {!! Form::close() !!}
                                </td>--}}
                            </tr>
                        @endforeach
                        {{--@else
                            <tr span="5">No Data Found</tr>--}}
                    @endif
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>




















