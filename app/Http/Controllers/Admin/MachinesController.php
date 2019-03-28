<?php

namespace App\Http\Controllers\Admin;

use App\Floor;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Machine;
use App\MachineCategory;
use App\RequestPlatform;
use Validator;
use Illuminate\Http\Request;

class MachinesController extends Controller
{
    function __construct()
    {
        $this->middleware('MachineMiddleware')->except(['machineDetails','setMachineView','setMachine','getMachineFromMachineSub']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $machines = Machine::all();

        return view('admin.machines.index', compact('machines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $floors = Floor::pluck('title','id')->all();
        $machineCats = MachineCategory::pluck('category','id')->all();
        return view('admin.machines.create',compact('floors','machineCats'));
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

            'machine_token'=>'required',
            'machine_category_id'=>'required',

        ];

        $message = [];


        $requestData['is_stored'] = 1;
//
        $data = Machine::create($requestData);

        return redirect('admin/machines')->with('flash_message', 'Machines added!');
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
        $machine = Machine::findOrFail($id);
        return view('admin.machines.show', compact('machine'));
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
        $machine = Machine::findOrFail($id);
        $machineCats = MachineCategory::pluck('category','id')->all();
        return view('admin.machines.edit', compact('machine','machineCats'));
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
            'switch'=>'required',
            'floor_id'=>'required',
        ];

        $message = [

        ];
        Validator::make($requestData,$rules,$message)->validate();

        
        $machine = Machine::findOrFail($id);
        $machine->update($requestData);

        return redirect('admin/machines')->with('flash_message', 'Machine updated!');
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
        Machine::destroy($id);

        return redirect('admin/machines')->with('flash_message', 'Machine deleted!');
    }

    public function machineDetails($id){
        $machine = Machine::findOrFail($id);
        $requests = RequestPlatform::where('machine_id',$id)->where('approved',1)->where('deliver',1)->orderBy('created_at','desc')->get();
        return view('admin.machines.machineDetails',compact('machine','id','requests'));
    }



    public function setMachineView($floor_id,$switch){

        $machineCats = MachineCategory::all()->pluck('category','id')->toArray();
        $machines = Machine::all()->where('is_stored',1)->pluck('machine_token','id')->toArray();
        return view("admin.machines.setMachine",compact('machineCats','machines','floor_id','switch'));
    }

    public function setMachine(Request $request,$floor_id,$switch){
        $data = [];
        $data['floor_id'] = $floor_id;
        $data['switch'] = $switch;
        $data['is_stored'] = 0;
        $machine = Machine::findOrFail($request->id)->update($data);
        return redirect(route('floorDetails',$floor_id));
    }

    public function getMachineFromMachineSub(Request $request){
        $id = $request->id;
        $machines = Machine::all()->where('is_stored',1)->where('machine_category_id',$id)->pluck('machine_token','id')->toArray();
        if(!count($machines) > 0){
            $error = 1;
        }else{
            $error = null;
        }
        return response()->json(['error'=>$error,'success'=>$machines]);

    }


    public function testing($id){
//        $id = $request->id;
        $machines = Machine::all()->where('machine_category_id',$id)->pluck('machine_token','id')->toArray();
        if(!count($machines) > 0){
            $error = 1;
        }else{
            $error = null;
        }
//        dd($machines);
        return response()->json(['error'=>$error,'success'=>$machines]);
    }
}
