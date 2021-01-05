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
            <small>Buyers</small>
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
                        <a href="/admin/employees/create" class="btn btn-flat btn-success">Add employees</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Company Id</th>
                                <th>Floor</th>
                                <th>Switch</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody valign = "middle">
                            @foreach($employees as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->companyID }}</td>
                                    <td>{{ !empty($item->switch)?$item->switch->floor->title:'N/A' }}</td>
                                    <td>{{ !empty($item->switch)?$item->switch->switch:'N/A' }}</td>
                                    <td>
                                        <a href="{{ url('/admin/employees/' . $item->id) }}" title="View Buyer"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View Employee</button></a>
                                        <a href="{{ url('/admin/employees/' . $item->id . '/edit') }}" title="Edit Buyer"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        {!! Form::open([
                                            'method'=>'DELETE',
                                            'url' => ['/admin/employees', $item->id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-sm',
                                                    'title' => 'Delete Employee',
                                                    'onclick'=>'return confirm("Confirm delete?")'
                                            )) !!}
                                        {!! Form::close() !!}
                                        <button type="button" class="btn btn-primary" onclick="openSetEmployeeToSwitchModal({{$item->id}})">Configure Employee</button>

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


        <div class="modal fade controller-configuration" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                {!! Form::open(['url' => '/admin/employees', 'class' => 'form-horizontal', 'files' => false, 'id' => 'employee-configuration-form']) !!}

                                <div class="form-group {{ $errors->has('floor_id') ? 'has-error' : ''}}">
                                    {!! Form::label('floor_id', 'Floor', ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::select('floor_id', [0=>'Select Floor']+$floors, null,['class' => 'form-control select2', 'id' => 'floor']) !!}
                                        {!! $errors->first('floor_id', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('switch') ? 'has-error' : ''}}">
                                    {!! Form::label('switch', 'Switch No', ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::number('switch', null, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
                                        {!! $errors->first('switch', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="configureEmployeeData()">Save changes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->



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
    <script>

        var data = {
            "employee_id": 0,
            "baseURL":"{{url("")}}"
        }

        function openSetEmployeeToSwitchModal(id)
        {
            data.employee_id = id
            $('.controller-configuration').modal('show')
        }

        function configureEmployeeData()
        {
            var url = data.baseURL + "/admin/employees/" + data.employee_id + "/setEmployeeToSwitch"

            var form = "#employee-configuration-form"

            $(form).attr('action', url)

            $(form).submit()

        }

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






