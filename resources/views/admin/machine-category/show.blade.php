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
            {{$cat->category}}
            <small>Parts</small>
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
                        <a href="#" onclick="event.preventDefault();openModal({{$cat->id}});"  title="Add Parts"><button class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add Parts</button></a>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th style="text-align: center">#</th><th style="text-align: center">Parts</th><th style="text-align: center">Qty</th><th style="text-align: center">Actions</th>
                            </tr>
                            </thead>
                            <tbody align="center" valign = "middle">
                            @foreach($parts as $item)
                                <tr>
                                    <td>{{ $loop->iteration or $item->id }}</td>
                                    <td>{{ $item->parts }}</td><td>{{ $item->qty }}</td>
                                    <td>
                                        <a href="{{ url('/admin/parts/' . $item->id) }}" title="View parts"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                        <a href="{{ url('/admin/parts/' . $item->id . '/edit') }}" title="Edit Part"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                        {!! Form::open(['method'=>'DELETE','url' => ['/admin/parts', $item->id],'style' => 'display:inline']) !!}
                                        {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array('type' => 'submit','class' => 'btn btn-danger btn-sm','title' => 'Delete MachineCategory','onclick'=>'return confirm("Confirm delete?")')) !!}
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


    <section class="content">
        <div class="modal modal-info fade" id="modal-info" style="display: none; padding-right: 17px;">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" onclick="return closeModal();">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add Partsl</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{action("Admin\\PartsController@store")}}" method="post" class="form-horizontal" id="addPart">
                            {{csrf_field()}}
                            <input type="hidden" name="machine_category_id" id="catId" value="">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        {!! Form::label('parts', 'Parts Name', ['class' => 'pull-right control-label']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::text('parts', null, ['class'=>'form-control','placeholder'=>'Enter Parts Name','id'=>'serial']) !!}
                                    </div>

                                </div>


                                <div class="col-md-4 col-md-offset-8">
                                    <input class="btn btn-success" onclick="$(this).addClass('disabled').attr('disabled',true);$('#addPart').submit();" value="Add Parts" type="button">
                                </div>

                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" onclick="return closeModal();">Close</button>
                        {{--<button type="button" class="btn btn-outline">Save changes</button>--}}
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
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
        var modal = $("#modal-info");
        function closeModal() {
            modal.removeClass("in").hide();
        }
        function openModal(catId) {
            modal.addClass("in");
            modal.slideDown();

            $("#modal-info #catId").val(catId);
        }
    </script>

@endsection






