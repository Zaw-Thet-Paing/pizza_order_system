<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //return pizza list
    public function pizzaList(Request $request){
        if($request->status == 'desc'){
            return Product::orderBy('created_at', 'desc')->get();
        }
        return Product::orderBy('created_at', 'asc')->get();
    }
}
