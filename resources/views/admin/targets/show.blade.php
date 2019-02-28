@extends('layouts.main')

@section('style')
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@endsection

@section('main')
    <section class="content-header">
        <h1>Target {{ $target->id }}</h1>
        <ol class="breadcrumb">
            <li><a href="/admin/"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route("targets.index")}}">targets</a></li>
            <li class="active">Show targets</li>
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

                       <a href="{{ url('/admin/targets') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                           <a href="{{ url('/admin/targets/' . $target->id . '/edit') }}" title="Edit Target"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                           {!! Form::open([
                               'method'=>'DELETE',
                               'url' => ['admin/targets', $target->id],
                               'style' => 'display:inline'
                           ]) !!}
                               {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                       'type' => 'submit',
                                       'class' => 'btn btn-danger btn-sm',
                                       'title' => 'Delete Target',
                                       'onclick'=>'return confirm("Confirm delete?")'
                               ))!!}
                           {!! Form::close() !!}
                           <br/>
                           <br/>

                           <div class="table-responsive">
                               <table class="table table-borderless">
                                   <tbody>
                                       <tr>
                                           <th>ID</th><td>{{ $target->id }}</td>
                                       </tr>
                                       <tr><th> Order Id </th><td> {{ $target->order_id }} </td></tr><tr><th> Floor Id </th><td> {{ $target->floor_id }} </td></tr><tr><th> Line </th><td> {{ $target->line }} </td></tr>
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



    </section>
@endsection

@section('script')

@endsection


