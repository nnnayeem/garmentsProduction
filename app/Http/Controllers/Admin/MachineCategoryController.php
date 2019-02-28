<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MachineCategory;
use Illuminate\Http\Request;
use Validator;

class MachineCategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('CategoryMiddleware');
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
            $machinecategory = MachineCategory::where('category', 'LIKE', "%$keyword%")
                ->orWhere('subMachineCategory', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $machinecategory = MachineCategory::latest()->paginate($perPage);
        }

        return view('admin.machine-category.index', compact('machinecategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
//        $cats = MachineCategory::where('subMachineCategory',0)->pluck('category','id')->all();
        $cats = [];
        return view('admin.machine-category.create',compact('cats'));
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
        
        MachineCategory::create($requestData);

        return redirect('admin/machine-category')->with('flash_message', 'MachineCategory added!');
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
        $cat = MachineCategory::findOrFail($id);
        $parts = $cat->parts->sortBy('parts');

        return view('admin.machine-category.show', compact('cat','parts'));
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
        $machinecategory = MachineCategory::findOrFail($id);
//        $cats = MachineCategory::where('subMachineCategory',0)->pluck('category','id')->all();
        $cats = [];


        return view('admin.machine-category.edit', compact('machinecategory','cats'));
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
            'category'=>'required|max:100'
        ];
        Validator::make($requestData,$rules)->validate();
        
        $machinecategory = MachineCategory::findOrFail($id);
        $machinecategory->update($requestData);

        return redirect('admin/machine-category')->with('flash_message', 'MachineCategory updated!');
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
        MachineCategory::destroy($id);

        return redirect('admin/machine-category')->with('flash_message', 'MachineCategory deleted!');
    }
}
