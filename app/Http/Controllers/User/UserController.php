<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function home(){
        $products = Product::orderBy('created_at', 'desc')->get();
        $categories = Category::get();
        return view('user.main.home', compact('products', 'categories'));
    }

    //change password page
    public function changePasswordPage(){
        return view('user.password.change');
    }

    //change password
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);

        $user = User::select('password')->where('id', Auth::user()->id)->first();
        $dbHashValue = $user->password;

        if(Hash::check($request->oldPassword, $dbHashValue)){
            $data = [
                'password'=> Hash::make($request->confirmPassword)
            ];
            User::where('id', Auth::user()->id)->update($data);

            return back()->with(['match'=> 'Password change success...']);
        }
        return back()->with(['notMatch'=> 'The Old Password not match. Try again!']);
    }

    //user account change
    public function accountChangePage(){
        return view('user.profile.account');
    }

    //password validation check
    private function passwordValidationCheck($request){
        Validator::make($request->all(), [
            'oldPassword'=> 'required|min:6|max:10',
            'newPassword'=> 'required|min:6|max:10',
            'confirmPassword'=> 'required|min:6|max:10|same:newPassword'
        ])->validate();
    }

}
