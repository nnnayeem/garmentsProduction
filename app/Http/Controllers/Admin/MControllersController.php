<?php

namespace App\Http\Controllers\Admin;

use App\Floor;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \Validator;

class MControllersController extends Controller
{
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
            $mcontrollers = MController::where('floor', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $mcontrollers = MController::latest()->paginate($perPage);
        }

        return view('admin.m-controllers.index', compact('mcontrollers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $floors = Floor::pluck('title','id')->all();

        return view('admin.m-controllers.create',compact('floors'));
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
        $serial = Str::random(10);
        $requestData['serial'] = $serial;

        MController::create($requestData);

        return redirect('admin/m-controllers')->with('flash_message', 'MController added!');
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
        $mcontroller = MController::findOrFail($id);

        return view('admin.m-controllers.show', compact('mcontroller'));
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
        $mcontroller = MController::findOrFail($id);

        return view('admin.m-controllers.edit', compact('mcontroller'));
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

        $rules = [
            'serial'=>'required|unique:m_controllers,serial,'.$id,
            'ip'=>'required|max:40|unique:m_controllers,ip,'.$id,
            'total_switch' => 'required|digits_between:0,3|integer|max:100',
            'production_switch_start_at' => 'required|digits_between:0,3|integer|max:100'
        ];



        $message = [

        ];
        $requestData = Validator::make($request->all(),$rules,$message)->validate();


        $mcontroller = MController::findOrFail($id);

        $mcontroller->update($requestData);

        return back()->with(['floor' => $mcontroller->floor]);
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
        MController::destroy($id);

        return redirect('admin/m-controllers')->with('flash_message', 'MController deleted!');
    }
}
