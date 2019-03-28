<?php

namespace App\Http\Controllers\Admin;

use App\Buyer;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Validator;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        if($user->can('own buyer'))
            $orders = $user->orders;
        else
            $orders = Order::with('buyer')->get();
        // dd($orders);
        
        // $orders = Order::with('buyer')->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = Auth::user();
        if($user->can('own buyer'))
            $buyers = $user->buyers()->pluck('name','id')->all();
        else
            $buyers = Buyer::pluck('name','id')->all();
        
        // dd($buyers);
        // $buyers = Buyer::pluck('name','id')->all();
        return view('admin.orders.create',compact('buyers'));
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
        Validator::make($requestData,[
            'name'=>'required',
            'qty'=>'required|numeric|digits_between:1,11',
            'amount'=>'required|numeric|digits_between:1,9',
            'buyer_id'=>'required|numeric|min:1',
            'ending_date'=>'required|date',
        ])->validate();
        $order = new Order($requestData);
        $buyer = Buyer::findOrFail($requestData['buyer_id']);
        $buyer->orders()->save($order);
        
//        Order::create($requestData);

        return redirect('admin/orders')->with('flash_message', 'Order added!');
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
        $order = Order::findOrFail($id);

        return view('admin.orders.show', compact('order'));
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
        $order = Order::findOrFail($id);
        $buyers = Buyer::pluck('name','id')->all();

        return view('admin.orders.edit', compact('order','buyers'));
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
        
        $order = Order::findOrFail($id);
        $startdate = $order->start_date;
        if(now()->greaterThan(Carbon::parse($startdate))){
            return redirect('admin/orders')->withErrors(['errors'=>'Order can not be updated because the order started at '.$startdate.'!']);
        }
        $order->update($requestData);

        return redirect('admin/orders')->with('flash_message', 'Order updated!');
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
        // Order::destroy($id);
        $order = Order::findOrFail($id);
        $enddate = $order->ending_date;
        $now = now();
        if(now()->greaterThan(Carbon::parse($enddate))){
            $order->delete();
        }else{
            return redirect('admin/orders')->withErrors(['errors'=>'Order can not be deleted because the order ending date is '.$enddate.'!']);
        }
        return redirect('admin/orders')->with('flash_message', 'Order deleted!');
    }
}
