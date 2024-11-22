<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //category listing
    public function list(){
        $categories = Category::get();

        return view('admin.category.category', compact('categories'));
    }

    //category creation
    public function create(Request $request){
        $this->checkValidation($request);

        Category::create([
            'name' => $request->categoryName
        ]);
        return back();
    }

    //category edition
    public function edit($id, Request $request){
        $category = Category::where('id', $id)->first();

        return view('admin.category.edit', compact('category'));
    }

    //deletion category
    public function delete($id, Request $request){
        Category::where('id', $id)->delete();

        return back();
    }

    //update category
    public function update($id, Request $request){
        Category::where('id',$id)->update([
            'name' => $request->categoryName
        ]);
        alert()->success('Category Update','Category Updated Successfully');
        return to_route('category#list');
    }

    //category validation
    private function checkValidation($request){
        $rules = [
            'categoryName' => ['required', 'max:100']
        ];

        $message = [];
        $request->validate($rules,$message);
    }
}
