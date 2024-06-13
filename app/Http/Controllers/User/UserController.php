<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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

    //user account change
    public function accountChange($id, Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        if($request->hasFile('image')){
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;

            if($dbImage != null){
                Storage::delete('public/'.$dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }
        User::where('id', $id)->update($data);
        return back()->with(['updatedSuccess'=> 'User account updated...']);
    }

    //get user data
    public function getUserData($request){
        return [
            'name'=> $request->name,
            'email'=> $request->email,
            'gender'=> $request->gender,
            'phone'=> $request->phone,
            'address'=> $request->address,
            'updated_at'=> Carbon::now()
        ];
    }

    //account validation check
    public function accountValidationCheck($request){
        Validator::make($request->all(), [
            'name'=> 'required',
            'email'=> 'required',
            'gender'=> 'required',
            'phone'=> 'required',
            'image'=> 'mimes:png,jpg,jpeg|file',
            'address'=> 'required'
        ])->validate();
    }

    public function filter($categoryId){
        $products = Product::where('category_id', $categoryId)->orderBy('created_at', 'desc')->get();
        $categories = Category::get();
        return view('user.main.home', compact('products', 'categories'));
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
