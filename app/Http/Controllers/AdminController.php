<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    // password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(), [
            'oldPassword'=> 'required|min:6|max:10',
            'newPassword'=> 'required|min:6|max:10',
            'confirmPassword'=> 'required|min:6|max:10|same:newPassword'
        ])->validate();
    }
}
