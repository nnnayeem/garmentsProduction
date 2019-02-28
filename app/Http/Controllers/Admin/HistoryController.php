<?php

namespace App\Http\Controllers\Admin;

use App\Floor;
use App\Platform;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class HistoryController extends Controller
{
    public function index(){
        $platform = Platform::orderBy('created_at','desc')->get();
        $floors = Floor::all();

        return view('admin.platform.index',compact('platform','floors'));
    }
    public function SortPlatform(Request $request){
        $ip = $request->all();
        Validator::make($ip,[
            'line'=>'numeric|nullable',
            'floor'=>'required|numeric',
            'date'=>'required|date',
        ])->validate();
        $floor = $ip['floor'];
        $line = $ip['line'];
        $date = $ip['date'];
        if(empty($ip['line'])){
            $platform = Platform::where('floor',$ip['floor'])->whereDate('created_at',$ip['date'])->get();
        }else{
            $platform = Platform::where('floor',$ip['floor'])->where('switch','>',50*($ip['line']-1))->where('switch','<=',50*($ip['line']))->whereDate('created_at',$ip['date'])->get();
        }
        if($ip['print'] == 1){
            return view('admin.platform.print',compact('platform','floor','line','date'));
        }
        return view('admin.platform.show',compact('platform','floor','line','date'));
    }
}
