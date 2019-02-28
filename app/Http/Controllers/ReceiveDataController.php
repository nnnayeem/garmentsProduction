<?php

namespace App\Http\Controllers;

use App\Platform;
use Illuminate\Http\Request;

class ReceiveDataController extends Controller
{
    public function getRequest($room,$switch_id)
    {
        $input = [];
        $room_no = (int)$room;
        $switch = (int)$switch_id;
        $input = ['switch'=>$switch,'room'=>$room_no];
        Platform::create($input);
        return;

    }

    public function postRequest(Request $request)
    {
        dd(json_decode(array_first($request->all()),true));
        $input = $request->all();

        Platform::create($input);
        return;

    }
}
