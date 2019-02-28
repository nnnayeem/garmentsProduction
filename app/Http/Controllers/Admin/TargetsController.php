<?php

namespace App\Http\Controllers\Admin;

use App\Floor;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use App\Target;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class TargetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $targets = Target::orderBy('day','desc')->get();
        return view('admin.targets.index', compact('targets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $orders = Order::pluck('name','id')->all();
        $floors = Floor::pluck('title','id')->all();
        return view('admin.targets.create',compact('orders','floors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        $rules = [
            'order_id'=>'required|digits_between:1,10|integer|min:1',
            'floor_id'=>'required|required|digits_between:1,10|integer|min:1',
            'line'=>'required|digits_between:1,10|integer|min:1',
            'target'=>'required|digits_between:1,10|integer',
//            'day'=>'required|date|after:today',
            'day'=>'required|date',
        ];
        Validator::make($requestData,$rules,[
            'order_id.min'=>'Please Select Order',
            'floor_id.min'=>'Please Select Order',
        ])->validate();
        $floor = Floor::findOrFail($request->floor_id);
        $row = $floor->rows;
        if ($requestData['line']> $row) {
            return back()->withInput($requestData)->withErrors(['line'=>'Invalid line']);
        }
      $tgt = Target::Where('line',$requestData['line'])->where('floor_id',$requestData['floor_id'])->whereDate('day',$requestData['day'])->get();

        if (count($tgt)>0){
            return back()->withInput($requestData)->withErrors(['day'=>'You have already added the target at ths date']);

        }
        Target::create($requestData);

        return redirect('admin/targets')->with('flash_message', 'Target added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $target = Target::findOrFail($id);

        return view('admin.targets.show', compact('target'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $orders = Order::pluck('name','id')->all();
        $floors = Floor::pluck('title','id')->all();
        $target = Target::findOrFail($id);

        return view('admin.targets.edit', compact('target','orders','floors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        $rules = [
            'order_id'=>'required|digits_between:1,10|integer|min:1',
            'floor_id'=>'required|required|digits_between:1,10|integer|min:1',
            'line'=>'required|digits_between:1,10|integer|min:1',
            'target'=>'required|digits_between:1,10|integer',
//            'day'=>'required|date|after:today',
            'day'=>'required|date',
        ];
        Validator::make($requestData,$rules,[
            'order_id.min'=>'Please Select Order',
            'floor_id.min'=>'Please Select Order',
        ])->validate();
        $targetDate =Carbon::parse($requestData['day']);
        $today = Carbon::now();
        if($today->greaterThanOrEqualTo($targetDate))
            return redirect('admin/targets')->with('error', 'Opps! You can not edit this record.');
        array_except($requestData,['order_id','floor_id','line']);

        $target = Target::findOrFail($id);
        $target->update($requestData);

        return redirect('admin/targets')->with('flash_message', 'Target updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $tgt = Target::findOrFail($id);
//        dd($tgt->day);
        $target = Carbon::parse($tgt->day);
        $today = Carbon::now();
        if($target->lessThan($today))
            return redirect('admin/targets')->with('error', 'This target is restricted to delete!');
        Target::destroy($id);
        return redirect('admin/targets')->with('flash_message', 'Target deleted!');
    }
}
