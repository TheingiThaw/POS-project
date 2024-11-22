<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Console\View\Components\Alert;

class ProductController extends Controller
{
    //list products
    public function list($action = 'dashboard'){
        $products = Product::select('products.id','products.name','products.price','products.stock','products.image','products.category_id','categories.name as category_name')
                ->leftJoin('categories','products.category_id', '=','categories.id')
                ->when($action === 'lowAmt', function ($query) {
                    $query->where('products.stock', '<=', 3);
                })
                ->when(request('searchKey'), function($query){
                    return $query->whereAny(['products.name','categories.name'],'LIKE','%'.request('searchKey').'%');
                })
                ->orderBy('products.name', 'asc')
                ->paginate(4);
        return view('admin.product.list', compact('products'));
    }

    //navigate create page
    public function createPage(){
        $categories = Category::get();
        return view('admin.product.createPage', compact('categories'));
    }

    //edit product page
    public function edit($id){
        $product = Product::where('id',$id)->first();
        $categories = Category::get();

        return view('admin.product.edit', compact('product','categories'));
    }

    //update product data
    public function update(Request $request){
        $this->checkValidation($request,'update');
        $oldImage = $request->oldPhoto;
        $data = $this->getData($request);
        if($request->hasFile('image')){
            if(file_exists(public_path('/productImages/'. $oldImage))){
                unlink(public_path('/productImages/'. $oldImage));
            }
            $imageName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/productImages/',$imageName);
            $data['image'] = $imageName;
        }

        Product::where('id',$request->id)->update($data);
        alert()->success('success','Product Updated Successfully');
        return to_route('product#list');
    }

    //get data from database for edition
    private function getData($request){

        return [
            'name' => $request->name,
            'category_id' => $request->categoryId,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ];
    }

    //delete product
    public function delete($id){
        Product::where('id',$id)->delete();

        return back();
    }

    //new product creation
    public function create(Request $request){
        $this->checkValidation($request, 'create');

        if($request->hasFile('image')){
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move( public_path().'/productImages/', $fileName);

            $data =$this->getData($request);
            $data['image'] = $fileName;

            Product::create($data);
            alert()->success('success','New Product Created Successfully');
            return to_route('product#list');
        }
    }

    //check validation
    private function checkValidation(Request $request, $action){
        $rules = [
            'name' => 'required|min:5|max:255|unique:products,name,' . $request->id,
            'categoryId' => ['required'],
            'price' => ['required', 'numeric', 'min:0','max:999999'],
            'stock' => ['required', 'max:999'],
            'description' => ['required', 'max:255']
        ];
        $message = [];

        $rules['image'] = $action == 'create' ? 'required|file|mimes:jpeg,png,jpg' : 'file|mimes:jpeg,png,jpg';

        $request->validate($rules, $message);
    }
}
