@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="{{asset('bower_resources/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bower_resources/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_resources/Ionicons/css/ionicons.min.css')}}">

    <link rel="stylesheet" href="{{asset('bower_resources/select2/dist/css/select2.css')}}">

    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/AdminLTE.min.css')}}">

    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/skins/_all-skins.min.css')}}">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endsection

@section('main')
    <section class="content-header">
        <h1>user {{ $employee->id }}</h1>
        <ol class="breadcrumb">
            <li><a href="/admin/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route("users.index")}}">users</a></li>
            <li class="active">Show users</li>
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

                        <a href="{{ url('/admin/employees') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/admin/employees/' . $employee->id . '/edit') }}" title="Edit user"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                <tr>
                                    <th>ID</th><td>{{ $employee->id }}</td>
                                </tr>
                                <tr><th> Phone </th><td> {{ $employee->phone }} </td></tr>
                                <tr><th> Recruited At </th><td> {{ $employee->created_at }} </td></tr>
                                <tr><th> Skill point by Minute </th><td> {{ $minuteSkill }} </td></tr>
                                <tr><th> Skill point by Hourly </th><td> {{ $hourlySkill }} </td></tr>
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
        <!-- /.box -->

        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Daily Task Done Report</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center">
                                    {{--<strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>--}}
                                    <strong>{{date('d M, Y', strtotime("first day of last month"))}} - {{date('d M, Y', strtotime("last day of this month"))}}</strong>
                                </p>

                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="EmployeeDailyTaskDoneReport" style="height: 350px;"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>

                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->

            <div class="col-md-6 col-sm-12 col-xs-12 col-lg-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Monthly Task Done Report</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center">
                                    <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                                    <strong>{{date('d M, Y', strtotime("first day of last month"))}} - {{date('d M, Y', strtotime("last day of this month"))}}</strong>
                                </p>

                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="EmployeeMonthlyTaskDoneReport" style="height: 350px;"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>

                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>

    </section>
@endsection

@section('script')
    <script src="{{asset('bower_resources/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('bower_resources/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('bower_resources/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>

    <script src="{{asset('bower_resources/fastclick/lib/fastclick.js')}}"></script>

    <script src="{{asset('bower_resources/chart.js/chart.js')}}"></script>

    <script src="{{asset('bower_resources/admin-lte/dist/js/adminlte.min.js')}}"></script>

    <script>


        var graphData = {
            "EmployeeDailyTaskDoneReport": {
                "label":[],
                "data": [],
                "context": "#EmployeeDailyTaskDoneReport"
            },
            "EmployeeMonthlyTaskDoneReport": {
                "label":[],
                "data": [],
                "context": "#EmployeeMonthlyTaskDoneReport"
            },
        }

        $(document).ready(function (){


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type:'get',
                url:"{{route("EmployeeDailyTaskDoneReport",['id' => $employee->id])}}",
                // data:{id:id},
                success:function(data){
                    if(data.length === 2){
                        graphData.EmployeeDailyTaskDoneReport.label = data[0]
                        graphData.EmployeeDailyTaskDoneReport.data = data[1]
                        createLineGraph("EmployeeDailyTaskDoneReport")
                    }
                }
            })

            $.ajax({
                type:'get',
                url:"{{route("EmployeeMonthlyTaskDoneReport",['id' => $employee->id])}}",
                // data:{id:id},
                success:function(data){
                    if(data.length === 2){
                        graphData.EmployeeMonthlyTaskDoneReport.label = data[0]
                        graphData.EmployeeMonthlyTaskDoneReport.data = data[1]
                        createLineGraph("EmployeeMonthlyTaskDoneReport")
                    }
                }
            })


        })

        function createLineGraph(graphType)
        {
            var lineGraphCanvas = $(graphData[graphType].context).get(0).getContext('2d');
            // This will get the first returned node in the jQuery collection.
            var lineGraph       = new Chart(lineGraphCanvas);

            var lineGraphData = {
                labels  : graphData[graphType].label,
                datasets: [
                    {
                        label               : 'DailyTaskDoneByEmployee',
                        fillColor           : 'rgba(60,141,188,0.9)',
                        strokeColor         : 'rgba(60,141,188,0.8)',
                        pointColor          : '#3b8bba',
                        pointStrokeColor    : 'rgba(60,141,188,1)',
                        pointHighlightFill  : '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data                : graphData[graphType].data
                    }
                ]
            };

            var lineGraphOptions = {
                // Boolean - If we should show the scale at all
                showScale               : true,
                // Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines      : false,
                // String - Colour of the grid lines
                scaleGridLineColor      : 'rgba(0,0,0,.05)',
                // Number - Width of the grid lines
                scaleGridLineWidth      : 1,
                // Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                // Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines  : true,
                // Boolean - Whether the line is curved between points
                bezierCurve             : true,
                // Number - Tension of the bezier curve between points
                bezierCurveTension      : 0.3,
                // Boolean - Whether to show a dot for each point
                pointDot                : false,
                // Number - Radius of each point dot in pixels
                pointDotRadius          : 4,
                // Number - Pixel width of point dot stroke
                pointDotStrokeWidth     : 1,
                // Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                pointHitDetectionRadius : 20,
                // Boolean - Whether to show a stroke for datasets
                datasetStroke           : true,
                // Number - Pixel width of dataset stroke
                datasetStrokeWidth      : 2,
                // Boolean - Whether to fill the dataset with a color
                datasetFill             : true,
                // String - A legend template
                legendTemplate          : '<ul class=\'<%=name.toLowerCase()%>-legend\'><% for (var i=0; i<datasets.length; i++){%><li><span style=\'background-color:<%=datasets[i].lineColor%>\'></span><%=datasets[i].label%></li><%}%></ul>',
                // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
                maintainAspectRatio     : true,
                // Boolean - whether to make the chart responsive to window resizing
                responsive              : true
            };

            // Create the line chart
            lineGraph.Line(lineGraphData, lineGraphOptions);

        }



    </script>
@endsection


