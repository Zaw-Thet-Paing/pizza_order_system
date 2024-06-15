<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Carbon\Carbon;
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

    //add to cart
    public function addToCart(Request $request){
        $data = $this->getOrderData($request);
        Cart::create($data);

        $response = [
            'status'=> 'success',
            'message'=> 'Add to Cart complete'
        ];

        return response()->json($response, 200);
    }

    private function getOrderData($request){
        return [
            'user_id'=> $request->userId,
            'product_id'=> $request->productId,
            'qty'=> $request->count,
            'created_at'=> Carbon::now(),
        ];
    }

}
