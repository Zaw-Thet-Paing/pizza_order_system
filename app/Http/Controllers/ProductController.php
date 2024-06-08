<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //direct to product list
    public function list(){
        $products = Product::select('products.*', 'categories.name as category_name')
        ->when(request('key'), function($query){
            $query->where('products.name', 'like', '%'.request('key').'%');
        })
        ->leftJoin('categories', 'products.category_id', 'categories.id')
        ->orderBy('products.created_at', 'desc')
        ->paginate(3);

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
        $this->productValidationCheck($request, "create");

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
        $product = Product::select('products.*', 'categories.name as category_name')
                        ->leftJoin('categories', 'products.category_id', 'categories.id')
                        ->where('products.id', $id)->first();
        return view('admin.product.edit', compact('product'));
    }

    public function updatePage($id){
        $product = Product::where('id', $id)->first();
        $categories = Category::get();
        return view('admin.product.update', compact('product', 'categories'));
    }

    public function update(Request $request){
        $this->productValidationCheck($request, "update");
        $data = $this->requestProductInfo($request);

        if($request->hasFile('image')){
            $oldImageName = Product::where('id', $request['id'])->first();
            $oldImageName = $oldImageName->image;

            if($oldImageName != null){
                Storage::delete('public/'.$oldImageName);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;

        }

        Product::where('id', $request['id'])->update($data);

        return redirect()->route('product#list')->with(['productUpdated'=> 'Product Updated Successfully...']);

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

    private function productValidationCheck($request, $action){
        $validationRules = [
            'name'=> 'required|min:5|unique:products,name,' . $request['id'],
            'category_id'=> 'required',
            'description'=> 'required|min:10',
            'waiting_time'=> 'required',
            'price'=> 'required'
        ];

        $validationRules['image'] = $action == "create" ? 'required|mimes:png,jpg,jpeg|file' : "mimes:png,jpg,jpeg|file";
        Validator::make($request->all(), $validationRules)->validate();
    }
}
