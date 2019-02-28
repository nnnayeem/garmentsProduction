<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Machine;
use App\MachineCategory;
use App\Part;
use App\RequestPlatform;
use Illuminate\Http\Request;
use Validator;

class RequestPlatformController extends Controller
{
    function __construct()
    {
        $this->middleware('RqstPlatformMiddleware');
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
            $requestplatform = RequestPlatform::where('machine_category_id', 'LIKE', "%$keyword%")
                ->orWhere('machine_id', 'LIKE', "%$keyword%")
                ->orWhere('parts_id', 'LIKE', "%$keyword%")
                ->orWhere('partsName', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $requestplatform = RequestPlatform::latest()->paginate($perPage);
        }

        return view('admin.request-platform.index', compact('requestplatform'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cats = MachineCategory::pluck('category','id')->all();
        return view('admin.request-platform.create',compact('cats'));
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
            'machine_category_id'=>'required',
            'machine_id'=>'required|min:1',
            'parts_id'=>'required|min:1',

        ];
        Validator::make($requestData,$rules)->validate();
//        dd($requestData);
        $part = Part::findOrFail($requestData['parts_id']);
        if($part->qty>0){
            RequestPlatform::create($requestData);
        }else{
            return back()->withErrors(['parts_id'=>'This parts does not has sufficient quantity.Please add more parts from <a href="/admin/store/create"><b>store</b></a>.']);
        }


        return redirect('admin/request-platform')->with('flash_message', 'RequestPlatform added!');
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
        $requestplatform = RequestPlatform::findOrFail($id);

        return view('admin.request-platform.show', compact('requestplatform'));
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
        $requestplatform = RequestPlatform::findOrFail($id);

        return view('admin.request-platform.edit', compact('requestplatform'));
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
            'machine_category_id'=>'required',
            'machine_id'=>'required',
            'parts_id'=>'required',

        ];
        Validator::make($requestData,$rules)->validate();
        dd($requestData);
        $requestplatform = RequestPlatform::findOrFail($id);
        if($requestplatform->approved == 0 || $requestplatform->deliver == 0){
            $requestplatform->update($requestData);
        }
        return redirect('admin/request-platform')->with('flash_message', 'RequestPlatform updated!');
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
        $request = RequestPlatform::findOrfail($id);
        if($request->approved == 0 || $request->deliver == 0){
            RequestPlatform::destroy($id);
            return redirect('admin/request-platform')->with('flash_message', 'RequestPlatform deleted!');
        }else{
            return redirect('admin/request-platform')->with('flash_message', 'RequestPlatform Not deleted!');
        }


    }


    public function fetchMachineFromCat(Request $request){
        $data = $request->all();
        $catId = $data['catId'];
        $machines = Machine::where('machine_category_id',$catId)->pluck('machine_token','id')->all();
        $parts = Part::where('machine_category_id',$catId)->pluck('parts','id')->all();
        if(empty($machines)){
            $status = null;
        }else{
            $status = "";
        }
        return response()->JSON(['success'=>$machines,'error'=>$status,'parts'=>$parts]);
    }

    public function deliver(Request $request)
    {
        $id = $request->requestId;
        $rp = RequestPlatform::findOrFail($id);
        $rp->increment('deliver',1);
        $parts = $rp->parts;
        if(!empty($parts))
//        if(count($parts) > 0)
        {
            $parts->decrement('qty',1);
        }

        return redirect('/admin/request-platform');

    }
    public function approve(Request $request)
    {
        $id = $request->requestId;
        $requestData = ['approved'=>1];

        $requestplatform = RequestPlatform::findOrFail($id);
//        $requestplatform->increment('approved',1);

        $requestplatform->update($requestData);

        return redirect('/admin/request-platform');

    }

    public function generalStoreCreate(){
        return view('admin.request-platform.createGeneralStore');
    }


    public function test($catId){
        $machines = Machine::where('machine_category_id',1)->pluck('machine_token','id')->all();
        if(empty($machines)){
            $status = null;
        }else{
            $status = "";
        }
        return response()->JSON(['success'=>$machines,'error'=>$status]);
    }



}
