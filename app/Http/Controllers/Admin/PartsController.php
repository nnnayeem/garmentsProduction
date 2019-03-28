<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MachineCategory;
use App\Part;
use Illuminate\Http\Request;
use Validator;

class PartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $parts = Part::all();
        $cats = MachineCategory::all();


        return view('admin.parts.index', compact('parts','cats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.parts.create');
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
//        dd($requestData);
        $rules = [
            'parts'=>'required|max:100|unique:parts'
        ];
        Validator::make($requestData,$rules)->validate();
        $catId = $requestData['machine_category_id'];
        
        Part::create($requestData);

        return redirect('admin/machine-category/'.$catId)->with('flash_message', 'Part added!');
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
        $part = Part::findOrFail($id);

        return view('admin.parts.show', compact('part'));
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
        $part = Part::findOrFail($id);

        return view('admin.parts.edit', compact('part'));
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
            'parts'=>'required|max:100'
        ];
        Validator::make($requestData,$rules)->validate();
        $part = Part::findOrFail($id);
        $catId = $part->machine_category_id;
        $part->update($requestData);

        return redirect('admin/machine-category/'.$catId)->with('flash_message', 'Part added!');
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
        // Part::destroy($id);
        $part = Part::findOrFail($id);
        $catId = $part->machine_category_id;
        $part->delete();

        return redirect('admin/machine-category/'.$catId)->with('flash_message', 'Part added!');
    }
}
