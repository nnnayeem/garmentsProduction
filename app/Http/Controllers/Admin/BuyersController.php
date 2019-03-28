<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Buyer;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        
        $user = User::findOrFail(Auth::user()->id);
        if($user->can('all buyer')){
            $buyers = Buyer::all();
        }else{
            $buyers = $user->buyers;
        }
        return view('admin.buyers.index', compact('buyers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.buyers.create');
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
        $user = User::findOrFail(Auth::user()->id);
        $user->buyers()->create($requestData);
        
        // Buyer::create($requestData);

        return redirect('admin/buyers')->with('flash_message', 'Buyer added!');
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
        $user = Auth::user();
        $orders = $user->orders;
        // $buyer = Buyer::findOrFail($id);
        // $orders = $buyer->orders;

        return view('admin.buyers.show', compact('buyer','orders'));
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
        $buyer = Buyer::findOrFail($id);
        $user = $buyer->user;
        // dd($user);
        if(empty($user) || $buyer->user->id != Auth::user()->id){
            abort(403);
        }

        return view('admin.buyers.edit', compact('buyer'));
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
        
        $buyer = Buyer::findOrFail($id);
        // $user = $buyer->user;
        /*if(empty($user) || $user->id != Auth::user()->id){
            dd(empty($user));
            abort(403);
        }*/
        $buyer->update($requestData);

        return redirect('admin/buyers')->with('flash_message', 'Buyer updated!');
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
        $buyer = Buyer::with(['user','orders'])->where('id',$id)->first();
        $user = $buyer->user;
        $orders = $buyer->orders;
        if(!empty($user)){
            $id = $user->id;
            if(Auth::user()->id == $id )
                $buyer->delete();
            else
                abort(403);
        }
        
        return redirect('admin/buyers')->with('flash_message', 'Buyer deleted!');
    }
}
