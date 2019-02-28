<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MachineCategory;
use App\Part;
use App\Store;
use Illuminate\Http\Request;
use Validator;

class StoreController extends Controller
{
    function __construct()
    {
        $this->middleware('StoreMiddleware');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $store = Store::where('category', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $store = Store::latest()->paginate($perPage);
        }

        return view('admin.store.index', compact('store'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cats = MachineCategory::all()->pluck('category','id')->toArray();
        return view('admin.store.create',compact('cats'));
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
            'price'=>'numeric|required',
            'machine_category_id'=>'required|numeric',
            'type'=>'required|numeric'
        ];
        $message = [];
        Validator::make($requestData,$rules,$message)->validate();
        $category_id = $requestData['machine_category_id'];
        $type = $requestData['type'];
        $qty = $requestData['qty'];
//        dd($requestData);

        $machineSerial = array_first(json_decode($requestData['machineSerial'],true));

        $store = Store::create($requestData);
        if($type == 1){
            for($i=0;$i<$qty;$i++){
                $store->machines()->create(['machine_token'=>$machineSerial[$i],'machine_category_id'=>$category_id,'status'=>1]);


            }
        }elseif($type == 2){
           $rp = Part::findOrFail($requestData['parts_id']);
           $rp->update(['qty'=>$rp->qty+$qty]);

        }
        return redirect('admin/store')->with('flash_message', 'Store added!');
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
        $store = Store::findOrFail($id);

        return view('admin.store.show', compact('store'));
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
//        return redirect('/admin/store');
////        $store = Store::findOrFail($id);
////        $cats = MachineCategory::all()->pluck('category','id')->toArray();
////
////        return view('admin.store.edit', compact('store','cats'));
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
        
        $store = Store::findOrFail($id);
        $store->update($requestData);

        return redirect('admin/store')->with('flash_message', 'Store updated!');
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
        return redirect('/admin/store');
//        Store::destroy($id);
//
//        return redirect('admin/store')->with('flash_message', 'Store deleted!');
    }

    public function getAllMachinePartsFromMachineCat(Request $request){
        $machineCat = $request->machineCat;
        $machineCategory = MachineCategory::findOrFail($machineCat);
        $parts = $machineCategory->parts->pluck('parts','id')->all();
        return response()->json(['success'=>$parts]);
    }
    public function test($machineCat){
//        $machineCat = $request->machineCat;
        $machineCategory = MachineCategory::findOrFail($machineCat);
        $parts = $machineCategory->parts->pluck('parts','id')->all();
        dd($parts);
        return response()->json(['success'=>$parts]);
    }


}
