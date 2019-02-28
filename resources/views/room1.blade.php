@extends("layouts.machine")

@section("js")

    <script>

        $(document).ready(function () {
            init({{$room}});

        })
    </script>


@endsection

@section("content")

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="machineRow">
                            {{--<img class="machine " src="{{asset('image/machine-2.png')}}">--}}
                            <div class="row">
                                <div class="col-md-12">

                                    <img id="1" class="machine left pull-left" src="{{asset('image/machine-2.png')}}">
                                    <img id="2" class="machine right pull-right" src="{{asset('image/machine-2.png')}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <img id="3" class="machine left pull-left" src="{{asset('image/machine-2.png')}}">
                                    <img id="4" class="machine right pull-right" src="{{asset('image/machine-2.png')}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <img id="5" class="machine left pull-left" src="{{asset('image/machine-2.png')}}">
                                    <img id="6" class="machine right pull-right" src="{{asset('image/machine-2.png')}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <img id="7" class="machine left pull-left" src="{{asset('image/machine-2.png')}}">
                                    <img id="8" class="machine right pull-right" src="{{asset('image/machine-2.png')}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <img id="9" class="machine left pull-left" src="{{asset('image/machine-2.png')}}">
                                    <img id="10" class="machine right pull-right" src="{{asset('image/machine-2.png')}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                    <img id="11" class="machine left pull-left" src="{{asset('image/machine-2.png')}}">
                                    <img id="12" class="machine right pull-right" src="{{asset('image/machine-2.png')}}">
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection