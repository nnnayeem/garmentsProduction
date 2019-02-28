@extends("layouts.machine")

@section("content")
    @php
        $orderId = $target->order_id;
        $floorId = $target->floor_id;
        $line = $target->line;
        $tgt = $target->target;
        $day = $target->day;
        $order = $target->order;
        $totalProduction = $order->production;
        $buyer = $order->buyer;
        $endingDate = array_first(explode(" ",$order->ending_date));
    @endphp
    <style>
        .alert span {
            font-size: 227%;
            margin-right: 3%;
        }
        .alert h1,.heading {
            font-size: 471%;
        }
        span.cards,.prod-table{
            font-size: 200%;
        }
        span.font {
            font-size: 100px;
            margin-right: 11px;
        }
        .prog span{
            font-size: 261%;
            font-weight: bold;
        }
        .prog .col-md-8{
            padding-top: 1%;
        }

    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="alert alert-dismissible alert-info text-center">
                <h1><b>Floor-1 Line-1</b></h1>
                <b class="text-warning">
                    <span>Buyer:{{$buyer->name}}/{{$buyer->country}}</span>
                    <span>Style No:{{$order->name}}</span>
                    <span>Total Qty:{{$order->qty}}</span>
                    <span>End Date:{{$endingDate}}</span>
                </b>
            </div>
            <div class="col-md-12 text-center">
                <h1 class="heading"><b>Production Details</b></h1><hr>
            </div>

            <div class="col-md-4">
                <div class="cards">
                    <div class="alert alert-dismissible alert-info">
                        <table>
                            <tr>
                                <td><span class="font glyphicon glyphicon-screenshot"></span></td>
                                <td><span>Target:</span><span id="target">{{$tgt}}</span></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cards">
                    <div class="alert alert-dismissible alert-success">
                        <table>
                            <tr>
                                <td><span class="font glyphicon glyphicon-stats"></span></td>
                                <td><span>Net Production:</span><br><span id="production">{{$totalProduction}}</span></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cards">
                    <div class="alert alert-dismissible alert-info">
                        <table>
                            <tr>
                                <td><span class="font glyphicon glyphicon-transfer"></span></td>
                                <td><span>Balance:</span><span id="balance">{{$tgt-$target->green}}</span></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cards">
                    <div class="alert alert-dismissible alert-danger">
                        <table>
                            <tr>
                                <td><span class="font glyphicon glyphicon-trash"></span></td>
                                <td><span>Red:</span><span id="red">{{$target->red}}</span></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cards">
                    <div class="alert alert-dismissible alert-warning">
                        <table>
                            <tr>
                                <td><span class="font glyphicon glyphicon-warning-sign"></span></td>
                                <td><span>Yellow:</span><span id="yellow">{{$target->yellow}}</span></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="cards">
                    <div class="alert alert-dismissible alert-success">
                        <table>
                            <tr>
                                <td><span class="font glyphicon glyphicon-ok"></span></td>
                                <td><span>Green:</span><span id="green">{{$target->green}}</span></td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>

        </div>
        <div class="prog">
            <div class="col-md-4">
                <span>Target Completed</span>
            </div>
            <div class="col-md-8">
                <div class="progress progress-striped active">
                    <div class="progress-bar" style="width: {{(($target->green)*100)/$tgt}}%"></div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <table class="prod-table table table-striped table-hover ">
                <thead>
                <tr>
                    <th>Hour</th>
                    <th>Red</th>
                    <th>Yellow</th>
                    <th>Green</th>
                </tr>
                </thead>
                <tbody>
                @forelse($target->targetHourlyDetails->sortByDesc('created_at') as $hd)
                <tr class="{{$loop->iteration%2==0?'info':'success'}}">
                    <td>{{$hd->start_time}} TO {{$hd->end_time}}</td>
                    <td>{{$hd->red}}</td>
                    <td>{{$hd->yellow}}</td>
                    <td>{{$hd->green}}</td>
                </tr>
                    @empty

                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection



@section("js")

    <script>
        $(window).on('load',function () {
            var pusher = new Pusher('f0018eeb73f4d3558c43', {
                cluster: 'ap2'
            });
            var channel = pusher.subscribe("production-{{$floorId}}-{{$line}}");
            channel.bind('App\\Events\\CountProduction', function(data) {
                console.log(data);
                var tgt,grn,type,vlu,s,p;
                type = data.type;
                tgt = parseInt($("#target").html());
                if(type === 'g'){
                    s = $("#green");
                }else if(type === 'y'){
                    s = $("#yellow");
                }else if(type === 'r'){
                    s = $("#red");
                }
                vlu = parseInt(s.html());
                s.html(vlu + 1);
                grn = parseInt($("#green").html());
                blc = $("#balance");
                blc.html(tgt-grn);
                p = $("#production");
                vlu = parseInt(p.html());
                p.html(vlu+1);
                $(".progress-bar").css('width',((grn*100)/tgt)+'%');
            });
            channel.bind('App\\Events\\BroadcastHourlyReport', function(data) {
                console.log(data);
                var classname;
                var table = $(".prod-table tbody");
                var frc = $(".prod-table tbody tr:first").attr('class');
                if(frc === "success")
                    classname = 'info';
                else
                    classname = 'success';

                table.prepend("<tr class='"+classname+"'><td>"+data.start_time+" TO "+data.end_time+"</td><td>"+data.red+"</td><td>"+data.yellow+"</td><td>"+data.green+"</td></tr>");
            })
        });
    </script>
@endsection