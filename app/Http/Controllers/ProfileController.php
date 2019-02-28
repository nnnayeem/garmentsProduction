<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Validator;

class ProfileController extends Controller
{
    public function AdminProfile(){
        $user = Auth::user();
        return view('admin.users.admin-profile',compact('user'));
    }
    public function UpdateProfile(Request $request,$user_id){
        if(Auth::user()->id == $user_id){
            $data = $request->all();
            $rules = [
                'name'=>'required|max:100',
                'phone'=>'required|max:100',
                'fatherName'=>'required|max:100',
                'motherName'=>'required|max:100',
                'gender'=>'required|max:100',
                'birthDate'=>'required|max:100',
                'permanentAdd'=>'required|max:100',
                'altPhone'=>'required|max:100',
                'nomineeName'=>'required|max:100',
                'nomineePhone'=>'required|max:100',
                'nomineeRelation'=>'required|max:100',
                'myFile'=>'image'
            ];
            $message = [
                'name.required'=>'name re',
            ];
            Validator::make($data,$rules,$message)->validate();
            $user = User::findOrFail($user_id);
            $vendor = $user->vendor;
            array_except($data,'email');
            if($request->file('myFile')){
                Storage::delete($vendor->photo);
                $path = Storage::put('public/vendor',$request->file('myFile'));
                $data['photo'] = $path;
            }

            $user->update($data);
            $vendor->update($data);
            return redirect('/vendor-profile');
        }else{
            abort(404);
        }
        return redirect('/vendor-profile');

    }

    public function UpdateAdminProfile(Request $request,$user_id){
        if(Auth::user()->id == $user_id){
            $data = $request->all();
            $rules = [
                'name'=>'required|max:100',
                'phone'=>'required|max:100',
                'myFile'=>'image|max:2000|dimensions:min_width=20,min_height=20'
            ];
            $message = [
                'name.required'=>'name required',
            ];
            Validator::make($data,$rules,$message)->validate();
            $user = User::findOrFail($user_id);
            array_except($data,'email');
            if($request->file('myFile')){
                Storage::delete($user->photo);
                $path = Storage::put('public/avatar',$request->file('myFile'));
                $data['photo'] = $path;
            }

            $user->update($data);
            return redirect('/admin/profile');
        }else{
            abort(404);
        }
        return redirect('/admin/profile');

    }

    public function VendorPassword(Request $request,$id){
        $data = $request->all();
        $rules = [
            'password'=>'required|min:6|confirmed',
        ];
        Validator::make($data,$rules)->validate();
        $data['password'] = bcrypt($request->password);
        $user = User::findOrFail($id);
        $user->update($data);
        return redirect('/admin/profile');
    }
}
