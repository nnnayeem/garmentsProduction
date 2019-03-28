@extends('layouts.master')

@section('style')
    <link rel="stylesheet" href="{{asset('bower_resources/select2/dist/css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('bower_resources/admin-lte/dist/css/AdminLTE.min.css')}}">
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

@section('script')

    <script src="{{asset('bower_resources/select2/dist/js/select2.full.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('bower_resources/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>

    <script src="{{asset('bower_resources/fastclick/lib/fastclick.js')}}"></script>

    <script src="{{asset('bower_resources/admin-lte/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('bower_resources/admin-lte/dist/js/demo.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });
            $("#type").on('change',function(){
                $('#machineCat').removeAttr('disabled');
                var type = $("#type").val();
                if(type == 2)
                    $('#partsWrap').fadeIn();
                else
                    $('#partsWrap').fadeOut();

            })

        });



        function closeModal() {
            $("#modal-info").removeClass("in").hide();
        }
        var data = $("#modal-info");
        var qty = $("#qty");
        qty.on('change',function () {
            var type = $("#type").val();
            if(type == 1){
                data.addClass('in');
                $("#totalTime").text(qty.val());
                $("#leftTime").text(qty.val());
                data.css('display','block');
            }else{
                $("#submitButton").fadeIn();
            }
        });


        var machine = {
            data:[]
        };
        var count = 0;
        var machineSerial = $("#serial");

        $("#addSerial").click(function (e) {
            e.preventDefault();
            addSerial();

        });
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                addSerial();
                // return false;
            }
        });

        function addSerial() {
            var serial = machineSerial.val();

            var totalMachine = qty.val();
            if(serial !== ""){
                count++;
                $("#leftTime").text(qty.val()-count);
                machine.data.push(serial);
                machineSerial.val("");
                if(count == totalMachine){
                    $("#addSerial").prop('disabled',true);
                    var machineData = JSON.stringify(machine);
                    $("#extraData").val(machineData);
                    $("#form").submit();
                }
            }
        }

        $("#machineCat").on("change",function () {
            var type = $("#type").val();
            if(type == 2){
                var machineCat = $("#machineCat").val();
                $.ajax({
                   url:"/admin/store/getAllMachinePartsFromMachineCat",
                   method:"POST",
                   data:{machineCat:machineCat},
                   success:function (data) {
                       // console.log(data);
                       console.log(Object.keys(data.success).length);
                       var option="";
                       if(Object.keys(data.success).length > 0){

                           $.each(data.success,function (keys,value) {
                               option += "<option value='"+keys+"'>"+value+"</option>"
                           });
                           console.log(option);

                           $("#machineParts").html(option);
                           $("#machineParts").attr('disabled',false);
                           $("#partsWrap").fadeIn(1000);
                       }else{
                           option += "<option value='0'>--Parts not Found--</option>";
                           $("#machineParts").html(option);
                           $("#machineParts").attr('disabled',true);
                           $("#partsWrap").fadeOut(1500);
                       }
                   },
                    error:function (data) {
                        console.log(data);
                    }
                });
            }
        })



    </script>
@endsection

@section('main')
    <section class="content-header">
        <h1>Create New Store</h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
           <li><a href="{{route("store.index")}}">Store</a></li>
            <li class="active">Store Create</li>
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
                     <div class="col-md-12">
                         @if ($errors->any())
                             <ul class="alert alert-danger">
                                 @foreach ($errors->all() as $error)
                                     <li>{{ $error }}</li>
                                 @endforeach
                             </ul>
                         @endif

                          {!! Form::open(['url' => '/admin/store', 'class' => 'form-horizontal', 'id' => 'form']) !!}

                         @include ('admin.store.form')
                         <input type="hidden" name="machineSerial" id="extraData" value="">


                         {!! Form::close() !!}
                     </div>
                     <!-- /.col -->
                 </div>
                 <!-- /.row -->
             </div>
         </div>
         <!-- /.box -->
     </section>



    <section class="content">
        <div class="modal modal-info fade" id="modal-info" style="display: none; padding-right: 17px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" onclick="return closeModal();">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Info Modal</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="text-danger">You have to add <b id="totalTime">5</b> serial of machine.<strong><span id="leftTime">0</span> times left</strong></p>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-2">
                                        {!! Form::label('machine', 'Machine', ['class' => 'col-md-4 control-label']) !!}
                                    </div>
                                    <div class="col-md-6">
                                        {!! Form::text('machine', null, ['class'=>'form-control','placeholder'=>'Machine Serial Number','id'=>'serial']) !!}
                                    </div>
                                    <div class="col-md-4">
                                        <input class="btn btn-success" value="Add Serial" type="button" id="addSerial">
                                    </div>
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

