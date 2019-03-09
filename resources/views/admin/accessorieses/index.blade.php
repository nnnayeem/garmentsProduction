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
            <small>Accessorieses</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">


            <div class="col-md-3 col-lg-3 col-xs-6 col-sm-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h4 class="">{{$order->master_lc}}</h4>
                        <p>L/C No.</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file-text" aria-hidden="true"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>


            <div class="col-md-3 col-lg-3 col-xs-6 col-sm-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3 class="count" id="newOrder">{{$order->qty}}</h3>

                        <p>L/C Quantity</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-sort-amount-asc" aria-hidden="true"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-lg-3 col-xs-6 col-sm-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3 class="count" id="newCustomer">{{$order->amount?$order->amount:0}}</h3>

                        <p>L/C Amount</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-usd" aria-hidden="true"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-md-3 col-lg-3 col-xs-6 col-sm-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3 class="count" id="pendingDelivery">{{$order->amount-$order->expense}}</h3>

                        <p>L/C Balance</p>
                    </div>
                    <div class="icon">
                        {{--<i class="ion ion-stats-bars"></i>--}}
                        <i class="fa fa-usd" aria-hidden="true"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>


        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning">
                    <div class="box-header">
                        <a href="/admin/accessorieses/order/{{$orderId}}/create" class="btn btn-flat btn-success">Add accessorieses</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Order Id</th>
                                <th>Qty</th>
                                <th>LC No.</th>
                                <th>Amount</th>
                                <th>in_store</th>
                                <th>Delivered</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody valign = "middle">
                            @php $spent = 0; @endphp
                            @forelse($accessorieses as $item)
                                @php $spent = $spent+$item->amount @endphp
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->name }}</td><td>{{ $item->order_id }}</td><td>{{ $item->qty }}  {{$item->unit}}</td>
                                    <td>{{ $item->lc }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>{{ $item->stored }}</td>
                                    <td>{{ $item->delivered }}</td>
                                    <td>
                                        <a href="{{ url('/admin/accessorieses/order/' . $orderId.'/acs/'. $item->id.'/show') }}" title="View Accessoriese"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/admin/accessorieses/order/' . $orderId.'/acs/'. $item->id. '/edit') }}" title="Edit Accessoriese"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        <a href="{{ url('/admin/accessorieses/' .  $item->id.'/order/'.$orderId . '/store') }}" title="Store Accessoriese"><button class="btn btn-success btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Input Accessories</button></a>
                                        {!! Form::open(['method'=>'DELETE','url' => ['/admin/accessorieses/order/acs/destroy', $orderId,$item->id],'style' => 'display:inline']) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array('type' => 'submit','class' => 'btn btn-danger btn-sm','title' => 'Delete Accessoriese','onclick'=>'return confirm("Confirm delete?")')) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @empty
                            @endforelse
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

                $(document).ready(function () {
                    /*var spent = {{$spent}}
                    var totalamount = {{$order->amount}}
                    var balance = totalamount - spent;
                    $('#pendingDelivery').html(balance);
*/
                    $('#example2').DataTable({
                        'paging'      : true,
                        'lengthChange': false,
                        'searching'   : true,
                        'ordering'    : false,
                        'info'        : true,
                        'autoWidth'   : false,
                        "pageLength"  : 15
                    });

                    //COUNTER FOR SHOWING REPORT ON DASHBOARD
                    $('.count').each(function () {
                        $(this).prop('Counter',0).animate({
                            Counter: $(this).text()
                        }, {
                            duration: 4000,
                            easing: 'swing',
                            step: function (now) {
                                $(this).text(Math.ceil(now));
                            }
                        });
                    });
                })

        </script>
@endsection






