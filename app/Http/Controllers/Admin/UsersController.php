<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Validator;

class UsersController extends Controller
{
    function __construct()
    {
        $this->middleware('UserMiddleware');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // $users = User::all();
        $users = User::with('roles')->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $permissions = Permission::pluck('name', 'id');
        $roles = Role::pluck('name', 'id');
        return view('admin.users.create', compact('permissions', 'roles'));

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
            'email' => 'required|unique:users|max:191|email',
            'name' => 'required|max:191',
            'role' => 'required|min:1',
            // 'permission'=>'required|min:1',
            'password' => 'required|min:6|confirmed',

        ];
        Validator::make($requestData, $rules)->validate();
        $requestData['password'] = bcrypt($requestData['password']);

        $user = User::create($requestData);
        /*if(!empty($requestData['permission'])){
            $user->givePermissionTo($requestData['permission']);
        }*/
        if (!empty($requestData['role'])) {
            $user->assignRole($requestData['role']);
        }

        return redirect('admin/users')->with('flash_message', 'User added!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $permissions = Permission::pluck('name', 'id');

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $permissions = Permission::pluck('name', 'id');
        $roles = Role::pluck('name', 'id');
        $assignedPermissions = $user->getAllPermissions();
        $assignedRoles = $user->roles;

        return view('admin.users.edit', compact('user', 'permissions', 'assignedPermissions', 'roles', 'assignedRoles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();
        $rules = [

            'name' => 'required|max:191',
            'role' => 'required|min:1',
            // 'permission'=>'required|min:1',

        ];
        Validator::make($requestData, $rules)->validate();
        if (!empty($requestData['password'])) {
            $requestData['password'] = bcrypt($requestData['password']);
        } else {
            array_except($requestData, ['password']);
        }


        $user = User::findOrFail($id);
        $user->update($requestData);
        // if(count($requestData['permission'])>0){
        //     $user->syncPermissions($requestData['permission']);
        // }
        if (count($requestData['role']) > 0) {
            $user->syncRoles($requestData['role']);
        }


        return redirect('admin/users')->with('flash_message', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->syncPermissions([]);
        $user->delete();
//        $user = User::destroy($id);


        return redirect('admin/users')->with('flash_message', 'User deleted!');
    }
}
