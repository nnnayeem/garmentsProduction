<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Floor;
use App\Switche;
use Illuminate\Http\Request;
use Validator;

class FloorsController extends Controller
{
    function __construct()
    {
        $this->middleware('FloorMiddleware');
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
            $floors = Floor::where('floor', 'LIKE', "%$keyword%")
                ->orWhere('title', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $floors = Floor::latest()->paginate($perPage);
        }

        return view('admin.floors.index', compact('floors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.floors.create');
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
            'floor'=>'required|unique:floors|numeric',
            'title'=>'required',
            'rows'=>'required',
            'MachinePerRow'=>'required',
        ];

        $message = [

        ];
        Validator::make($requestData,$rules,$message)->validate();
        $rows = $requestData['rows'];
        $machinePerRow = $requestData['MachinePerRow'];
        
        $data = Floor::create($requestData);
        $id = $data->id;
        if(!empty($data)){
            for($i=1;$i<=$rows*$machinePerRow;$i++){
                Switche::create(['floor_id'=>$id,'switch'=>$i]);
            }
        }


        return redirect('admin/floors')->with('flash_message', 'Floor added!');
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
        $floor = Floor::findOrFail($id);

        return view('admin.floors.show', compact('floor'));
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
        $floor = Floor::findOrFail($id);

        return view('admin.floors.edit', compact('floor'));
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
        
        $floor = Floor::findOrFail($id);
        $floor->update($requestData);

        return redirect('admin/floors')->with('flash_message', 'Floor updated!');
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
        Floor::destroy($id);

        return redirect('admin/floors')->with('flash_message', 'Floor deleted!');
    }

    public function FloorDetails($id){
        $floor = Floor::findOrFail($id);
        return view('admin.floors.floorDetails',compact('floor'));
    }
}
