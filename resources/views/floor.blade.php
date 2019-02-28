@extends("layouts.machine")

@section("js")


@endsection

@section("content")
    @include('include.main-header')
    <div class="container-fluid">
        <div class="row">
            @if(count($floors) > 0)
                @foreach($floors as $floor)
                    @php
                        $machinePerRow = $floor->machinePerRow;
                        $lineNo = 1;
                        $totalMachine = 0;
                    @endphp
                    <div class="col-md-12">
                        <div class="alert alert-dismissible alert-info text-center">
                            <h3>
                                <strong>Floor No:</strong>{{$fNo=$floor->floor}}
                            </h3>
                        </div>
                        <div class="row">
                            @foreach($floor->switches->chunk($machinePerRow*4) as $blocks)
                                <div class="col-md-6">
                                    <div class="row">
                                        @foreach($blocks->chunk($machinePerRow) as $lines)
                                            <div class="col-lg-3 col-md-3 col-sm-3">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="alert alert-dismissible alert-warning text-center">
                                                            <span>L-{{$lineNo++}}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="machineBlock">
                                                    @foreach($lines->chunk(2) as $machines)
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            @foreach($machines as $machine)
                                                            <div class="block btn btn-{{$machine->status==0?'danger':'success'}} pull-{{++$totalMachine%2==0?'right':'left'}}" id="{{$totalMachine}}-{{$fNo}}">{{$totalMachine}}</div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection