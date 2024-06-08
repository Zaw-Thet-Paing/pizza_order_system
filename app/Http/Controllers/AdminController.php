<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //dreict to changePasswordPage
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //change password
    public function changePassword(Request $request){
        /*
        Requirement to change password
        1. all field must be fill
        2. new password & confirm password length must be greater than 6
        3. new password & confirm password must same
        4. client old password must be same with db password
        5. password change
        */

        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbPasssword = $user->password;

        // dd($dbPasssword);

        if(Hash::check($request->oldPassword, $dbPasssword)){
            // dd("match");
            User::where('id', Auth::user()->id)->update([
                'password'=> Hash::make($request->confirmPassword),
            ]);
            // Auth::logout();
            // return redirect()->route('auth#loginPage');
            return back()->with(['match'=> 'Password Changed...']);
        }
        return back()->with(['notMatch'=> 'The old password not match! Try again!']);
    }

    //direct admin profile page
    public function edit(){
        return view('admin.account.edit');
    }

    //update account
    public function update($id, Request $request){

        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        if($request->hasFile('image')){
            //1. Old image name | check => delete | store
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != NULL){
                Storage::delete('public/' . $dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;

        }

        User::where('id', $id)->update($data);

        return redirect()->route('admin#details')->with(['updateSuccess'=> 'Admin Account Updated...']);

    }

    //admin list
    public function list(){
        $admin = User::when(request('key'), function($query){
                                $query->orWhere('name', 'like', '%' . request('key') . '%')
                                      ->orWhere('email', 'like', '%' . request('key') . '%')
                                      ->orWhere('gender', 'like', '%' . request('key') . '%')
                                      ->orWhere('phone', 'like', '%' . request('key') . '%')
                                      ->orWhere('address', 'like', '%' . request('key') . '%');
                            })
                            ->where('role', 'admin')->paginate(3);

        $admin->appends(request()->all());
        return view('admin.account.list', compact('admin'));
    }

    //delete account
    public function delete($id){
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess'=> 'Admin Account Deleted...']);
    }

    //change admin role
    public function changeRole($id){
        $account = User::where('id', $id)->first();
        return view('admin.account.changeRole', compact('account'));
    }

    public function change($id, Request $request){
        $data = [
            'role'=> $request->role
        ];
        User::where('id', $id)->update($data);

        return redirect()->route('admin#list');
    }

    //account validation check
    private function accountValidationCheck($request){
        Validator::make($request->all(), [
            'name'=>'required',
            'email'=> 'required',
            'phone'=> 'required',
            'image'=> 'mimes:png,jpg,jpeg|file',
            'gender'=> 'required',
            'address'=> 'required'
        ])->validate();
    }

    //request user data
    private function getUserData($request){
        return [
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'gender'=> $request->gender,
            'address'=> $request->address,
            'updated_at'=> Carbon::now()
        ];
    }

    // password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(), [
            'oldPassword'=> 'required|min:6|max:10',
            'newPassword'=> 'required|min:6|max:10',
            'confirmPassword'=> 'required|min:6|max:10|same:newPassword'
        ])->validate();
    }
}
