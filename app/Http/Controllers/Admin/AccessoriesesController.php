<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Accessoriese;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;

class AccessoriesesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index($orderId)
    {
        $order = Order::findOrFail($orderId);
        $user = Auth::user();
        if($user->can('own buyer')){
            $this->verify($order);
        }
        $accessorieses = $order->accessories;

        return view('admin.accessorieses.index', compact('accessorieses','orderId','order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($orderId)
    {
        $user = Auth::user();
        if($user->can('own buyer')){
            $order = Order::findOrFail($orderId);
            $this->verify($order);
        }
        
        return view('admin.accessorieses.create',compact('orderId'));
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
        $ip = $request->all();
        Validator::make($ip,[
            'name'=>'required|max:255',
            'qty'=>'required|numeric',
            'unit'=>'required|max:255',
            'order_id'=>'required',
            'amount'=>'required|numeric',
            'lc'=>'required|unique:accessorieses,lc',
        ])->validate();
        $order = Order::findOrFail($ip['order_id']);
        $user = Auth::user();
        if($user->can('own buyer')){
            $this->verify($order);
        }
        $totalAmount = $order->amount;
        $orderexpense = $order->expense;
        $expense = $orderexpense+$ip['amount'];
        $acs['expense'] = $expense;
        if($expense > $totalAmount)
            return redirect('admin/accessorieses/'.$ip['order_id'].'/order')->withErrors(['error'=>'Opps! You have exceeded your Limit']);
        $acs = new Accessoriese($ip);
        $order->accessories()->save($acs);
        $order->update(['expense'=>$expense]);


        return redirect('admin/accessorieses/'.$ip['order_id'].'/order')->with('flash_message', 'Accessoriese added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($orderId,$id)
    {
        $user = Auth::user();
        $order = Order::findOrFail($orderId);
        if($user->can('own buyer')){
            $user->verify($order);
        }
        $accessoriese = Accessoriese::findOrFail($id);

        return view('admin.accessorieses.show', compact('accessoriese','orderId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($orderId,$id)
    {
        $user = Auth::user();
        $order = Order::findOrFail($orderId);
        $startdate = $order->start_date;
        if(now()->greaterThan(Carbon::parse($startdate))){
            return redirect('admin/orders')->withErrors(['errors'=>'Accessories can not be updated because the order started at '.$startdate.'!']);
        }
        if($user->can('own buyer')){
            $user->verify($order);
        }
        $accessoriese = Accessoriese::findOrFail($id);

        return view('admin.accessorieses.edit', compact('accessoriese','orderId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $orderId,$id)
    {

        $ip = $request->all();
        Validator::make($ip,[
            'name'=>'required|max:255',
            'qty'=>'required|numeric',
            'unit'=>'required|max:255',
            'order_id'=>'required'
        ])->validate();
        $user = Auth::user();
        $order = Order::findOrFail($orderId);
        $startdate = $order->start_date;
        if(now()->greaterThan(Carbon::parse($startdate))){
            return redirect('admin/accessorieses/'.$orderId.'/order')->withErrors(['errors'=>'Accessories can not be updated because order has already started.']);
        }
        if($user->can('own buyer')){
            $user->verify($order);
        }

        $orderId = $ip['order_id'];
        array_except($ip,'order_id');
        $accessoriese = Accessoriese::findOrFail($id);
        $accessoriese->update($ip);

        return redirect('admin/accessorieses/'.$orderId . '/order')->with('flash_message', 'Accessoriese updated!');
    }
    public function acsplatform($id,$orderId){
        return view('admin.accessorieses.platform',compact('id','orderId'));
    }
    public function storeacsplatform(Request $request,$id){
        $p = $request->all();
        Validator::make($p,[
            'type'=>'required|numeric',
            'qty'=>'required|digits_between:1,11',
        ])->validate();
        $data = Accessoriese::findOrFail($id);
        $type = $p['type'];
        if($type == 0){
            DB::table('accessorieses')->where('id',$id)->increment('stored',$p['qty']);
        }
        return redirect(route('accessorieses.index',$p['orderId']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($orderId,$id)
    {
        $acs = Accessoriese::findOrFail($id);
        $order = $acs->order;
        $startdate = $order->start_date;
        if(now()->greaterThan(Carbon::parse($startdate))){
            return redirect('admin/accessorieses/'.$orderId.'/order')->withErrors(['errors'=>'Accessories can not be deleted because order has already started.']);
        }
        $expense = $order->expense-$acs->amount;
        if($expense<0){
            $expense =0;
        }
        $order->update(['expense'=>$expense]);
        $acs->delete();

//        Accessoriese::destroy($id);
        return redirect('admin/accessorieses/'.$orderId.'/order')->with('flash_message', 'Accessoriese added!');
    }
    protected function verify($order){
        $user = Auth::user();
        $buyer = $order->buyer;
        if(!empty($buyer)){
            $user_id = $buyer->user_id;
            if($user_id != $user->id){
                abort(401);
            }
        }
    }
}
