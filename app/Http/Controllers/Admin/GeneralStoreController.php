<?php

namespace App\Http\Controllers\Admin;

use App\Accessoriese;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GeneralStore;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;

class GeneralStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $generalstore = GeneralStore::all();

        return view('admin.general-store.index', compact('generalstore'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $orders = Order::pluck('name','id')->all();
        return view('admin.general-store.create',compact('orders'));
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
        $requestData+=['user_id'=>Auth::user()->id];
        
        GeneralStore::create($requestData);

        return redirect('admin/general-store')->with('flash_message', 'GeneralStore added!');
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
        $generalstore = GeneralStore::findOrFail($id);

        return view('admin.general-store.show', compact('generalstore'));
    }
    public function deliver(Request $request,$id)
    {
        $i = $request->all();
        Validator::make($i,[
            'qty'=>'required|numeric'
        ])->validate();
        $qty = $request->qty;
        $orderId = $request->orderId;
        $d = GeneralStore::findOrFail($id);
        $accesId = $d->accessoriese_id;
        if(!is_null($d->delivered))
            return redirect('/admin/general-store')->with('error','You have already completed this request');
        $data = Accessoriese::findOrFail($accesId);

        $prevStored = $data->stored;
        if($qty>$prevStored){
            return redirect('/admin/general-store')->with('error','You dont have enough quantity to deliver.');
//            return redirect(route('order.accessories',$orderId));
        }
        DB::table('accessorieses')->where('id',$accesId)->increment('delivered',$qty);
        DB::table('accessorieses')->where('id',$accesId)->decrement('stored',$qty);
        $d->update(['delivered'=>now(),'delivered_qty'=>$qty]);

        return redirect('/admin/general-store');
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
        $generalstore = GeneralStore::findOrFail($id)->with('order')->get()->first();
        $orders = Order::pluck('name','id')->all();

        return view('admin.general-store.edit', compact('generalstore','orders'));
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
        
        $generalstore = GeneralStore::findOrFail($id);
        $generalstore->update($requestData);

        return redirect('admin/general-store')->with('flash_message', 'GeneralStore updated!');
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
        $genStore = GeneralStore::findOrFail($id);
        if(!is_null($genStore->delivered)){
            $d=$genStore->order;
            if(!empty($d)){
                if(date($d->ending_date)<now())
                    $genStore->delete();
                else
                    return redirect('/admin/general-store')->with('error','Your order is not completed yet. You can delete later');

            }else
                return redirect('/admin/general-store')->with('error','Opps! Something is wrong!');
        }else{
            return redirect('/admin/general-store')->with('error','You have not delivered the request yet');
        }

        return redirect('admin/general-store')->with('suceess', 'GeneralStore deleted!');
    }
    public function getAccessories(Request $request){
        $orderId = $request->id;
        if($orderId){
            $order = Order::findOrFail($orderId);
            if(!$order){
                return response()->json(['success'=>null,'error'=>'order not found']);
            }
            $accessories = $order->accessories->pluck('name','id');
            if($accessories->isNotEmpty()){
                return response()->json(['success'=>$accessories,'error'=>null]);
            }else{
                return response()->json(['success'=>null,'error'=>'accessories not found']);
            }
        }
        return response()->json(['success'=>null,'error'=>'Order id not found']);
    }
}
