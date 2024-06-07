<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //direct to product list
    public function list(){
        $products = Product::when(request('key'), function($query){
            $query->where('name', 'like', '%'.request('key').'%');
        })->orderBy('created_at', 'desc')->paginate(3);
        $products->append(request()->all());
        return view('admin.product.pizzaList', compact('products'));
    }

    //direct to createPage
    public function createPage(){
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create', compact('categories'));
    }

    // create product
    public function create(Request $request){
        $this->productValidationCheck($request);

        $data = $this->requestProductInfo($request);

        if($request->hasFile('image')){
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        Product::create($data);

        return redirect()->route('product#list')->with(['productCreated'=> 'Product Created Success...']);

    }

    //delete product
    public function delete($id){
        Product::where('id', $id)->delete();
        return redirect()->route('product#list')->with(['productDeleted'=> 'Product Deleted Success...']);
    }

    public function edit($id){
        $product = Product::where('id', $id)->first();
        return view('admin.product.edit', compact('product'));
    }

    private function requestProductInfo($request){
        return [
            'name'=> $request->name,
            'category_id'=> $request->category_id,
            'description'=> $request->description,
            'waiting_time'=> $request->waiting_time,
            'price'=> $request->price
        ];
    }

    private function productValidationCheck($request){
        Validator::make($request->all(), [
            'name'=> 'required|min:5|unique:products,name',
            'category_id'=> 'required',
            'description'=> 'required|min:10',
            'image'=> 'required|mimes:png,jpg,jpeg|file',
            'waiting_time'=> 'required',
            'price'=> 'required'
        ])->validate();
    }
}
