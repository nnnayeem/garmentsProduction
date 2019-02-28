@extends("layouts.machine")

@section("js")
    {{--<script>--}}
        {{--var pusher = new Pusher('f0018eeb73f4d3558c43', {--}}
            {{--cluster: 'ap2'--}}
        {{--});--}}
        {{--var channel = pusher.subscribe('switch-pressed');--}}
        {{--channel.bind('App\\Events\\SwitchPressed', function(data) {--}}
            {{--console.log(data);--}}
            {{--var button = data.switch;--}}
            {{--var floor = data.floor;--}}
            {{--var status = data.status;--}}
            {{--var block = $("#"+button+"-"+floor);--}}
            {{--if(status == 1){--}}
                {{--block.removeClass('btn-danger');--}}
                {{--block.addClass('btn-success');--}}
            {{--}else if(status == 0){--}}
                {{--block.removeClass('btn-danger');--}}
                {{--block.addClass('btn-danger');--}}
                {{--$('html, body').animate({--}}
                    {{--scrollTop: (block.offset().top)--}}
                {{--},1500);--}}
            {{--}--}}

        {{--});--}}
        {{--$(document).ready(function () {--}}
            {{--$("#1-1").click(function () {--}}
                {{--$('html, body').animate({--}}
                    {{--scrollTop: ($('#3-3').offset().top)--}}
                {{--},1500);--}}
            {{--})--}}
            {{--$("#3-3").click(function () {--}}
                {{--$('html, body').animate({--}}
                    {{--scrollTop: ($('#1-1').offset().top)--}}
                {{--},1500);--}}
            {{--})--}}
        {{--})--}}
    {{--</script>--}}

    {{--<script>--}}
        {{----}}
    {{--</script>--}}


    @endsection

@section("content")
{{--//&#x9f3;--}}
    <div class="container-fluid">
        <div class="row">
            @if(count($floors) > 0)
                @foreach($floors as $floor)
            <div class="col-md-12">
                <div class="alert alert-dismissible alert-info text-center">
                    <h3>
                        <strong>Floor No:</strong>{{$florId = $floor->floor}}
                    </h3>
                </div>
                <div class="row">
                    @if(!is_null($rows = $floor->rows))
                        {{--@php dd(12%$rows) @endphp--}}
                        {{--@if(12%$rows != 0)--}}
                            @if($rows >4)
                                @for($n=0,$switch=0;$n<round($rows/4);$n++)
                            <div class="col-md-6">
                                <div class="row">
                                    @for($i=4*$n+1,$count=1;$i<=$rows;$i++,$count++)
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                        {{--<div class="col-lg-{{12/($rows/2)>3?3:$col = round(12/($rows/2))}} col-md-{{12/($rows/2)>3?3:$col}} col-sm-{{12/($rows/2)>3?3:$col}}">--}}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="alert alert-dismissible alert-warning text-center">
                                                        <span>L-{{$i}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="machineBlock">
                                                @for($j=1;$j<=$floor->machinePerRow/2;$j++)
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="block btn btn-{{machine_status(++$switch,$floor->id)}} pull-left" {{switch_status($switch,$floor->id)}}  id="{{$switch}}-{{$florId}}">{{$switch}}</div>
                                                            <div class="block btn btn-{{machine_status(++$switch,$floor->id)}} pull-right" {{switch_status($switch,$floor->id)}} id="{{$switch}}-{{$florId}}">{{$switch}}</div>
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                        @php if($count==4){break;} @endphp
                                    @endfor
                                </div>
                            </div>
                                @endfor
                            @else
                            <div class="col-md-6">
                                <div class="row">
                                    @for($i=1,$switch=0;$i<=$rows;$i++)
                                        <div class="col-lg-3 col-md-3 col-sm-3">
{{--                                        <div class="col-lg-{{12/($rows/2)>3?3:$col = round(12/($rows/2))}} col-md-{{12/($rows/2)>3?3:$col}} col-sm-{{12/($rows/2)>3?3:$col}}">--}}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="alert alert-dismissible alert-warning text-center">
                                                        <span>L-{{$i}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="machineBlock">
                                                @for($j=1;$j<=$floor->machinePerRow/2;$j++)
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="block btn btn-{{machine_status(++$switch,$floor->id)}} pull-left" {{switch_status($switch,$floor->id)}}  id="{{$switch}}-{{$florId}}">{{$switch}}</div>
                                                            <div class="block btn btn-{{machine_status(++$switch,$floor->id)}} pull-right" {{switch_status($switch,$floor->id)}} id="{{$switch}}-{{$florId}}">{{$switch}}</div>
                                                        </div>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    @for($i;$i<=$rows;$i++)
                                        <div class="col-lg-3 col-md-3 col-sm-3">
{{--                                        <div class="col-lg-{{12/($rows/2)>3?3:$col = round(12/($rows/2))}} col-md-{{12/($rows/2)>3?3:$col}} col-sm-{{12/($rows/2)>3?3:$col}}">--}}
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="alert alert-dismissible alert-warning text-center">
                                                        <span>L-{{$i}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="machineBlock">
                                                @for($j=1;$j<=$floor->machinePerRow/2;$j++)
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="block btn btn-{{machine_status(++$switch,$floor->id)}} pull-left" {{switch_status($switch,$floor->id)}}  id="{{$switch}}-{{$florId}}">{{$switch}}</div>
                                                            <div class="block btn btn-{{machine_status(++$switch,$floor->id)}} pull-right" {{switch_status($switch,$floor->id)}} id="{{$switch}}-{{$florId}}">{{$switch}}</div>
                                                       </div>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            @endif


                        {{--@else--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-md-6">--}}
                                    {{--@for($i=1;$i<=$floor->rows;$i++)--}}
                                        {{--<div class="col-lg-{{12/$floor->rows>3?3:$col}} col-md-{{12/$floor->rows>3?3:$col}} col-sm-{{12/$floor->rows>3?3:$col}}">--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col-md-12">--}}
                                                    {{--<div class="alert alert-dismissible alert-warning text-center">--}}
                                                        {{--<span>L-{{$i}}</span>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div class="machineBlock">--}}
                                                {{--@for($j=1;$j<=$floor->machinePerRow/2;$j++)--}}
                                                    {{--<div class="row">--}}
                                                        {{--<div class="col-md-12">--}}
                                                            {{--<div class="block btn btn-{{machine_status($j*2-1,$floor->id)}} pull-left" {{switch_status($j*2-1,$floor->id)}} id="{{$j*2-1}}-{{$floor->id}}">{{$j*2-1}}</div>--}}
                                                            {{--<div class="block btn btn-{{machine_status($j*2,$floor->id)}} pull-right" {{switch_status($j*2,$floor->id)}} id="{{$j*2}}-{{$floor->id}}">{{$j*2}}</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--@endfor--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--@endfor--}}
                                {{--</div>--}}
                            {{--</div>--}}

                        {{--@endif--}}

                    @endif

                </div>
            </div>
                @endforeach
            @endif
        </div>
    </div>

    @endsection