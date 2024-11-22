<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function userHome(){
        $categories = Category::get();
        $products = Product::select('products.id', 'products.name', 'products.price', 'products.description', 'products.image', 'products.stock', 'products.category_id','categories.name as category_name')
                    ->leftJoin('categories','products.category_id','categories.id')
                    ->when(request('categoryId'), function($query){
                        $query->where('products.category_id',request('categoryId'));
                    })
                    ->when(request('searchKey'), function($query){
                        $query->where('products.name', 'LIKE', '%'.request('searchKey').'%');
                    })
                    ->when(request('minPrice') != null && request('maxPrice')!= null, function($query){
                        $query->whereBetween('products.price', [request('minPrice'), request('maxPrice')]);
                    })
                    ->when(request('minPrice') != null && request('maxPrice')== null, function($query){
                        $query->where('products.price','>=',request('minPrice'));
                    })
                    ->when(request('minPrice') == null && request('maxPrice')!= null, function($query){
                        $query->where('products.price','<=',request('maxPrice'));
                    })
                    ->when(request('sortingType'),function($query){
                        $sortingRule = explode(",", request('sortingType'));
                        $query->orderBy('products.' . $sortingRule[0], $sortingRule[1]);
                    })
                    ->get();
        return view('customer.home.list', compact('products', 'categories'));
    }

    //user edit account
    public function edit(){
        $profile = User::where('id', Auth::user()->id)->first();
        return view('customer.account.edit', compact('profile'));
    }

    //update user data
    public function update(Request $request){
        $this->checkValidation($request);
        $userData = $this->getProfileData($request);

        if($request->hasFile('image')){
            if(Auth::user()->profile != null){
                if(file_exists(public_path('profileImages/'.Auth::user()->profile))){
                    unlink(public_path('profileImages/'.Auth::user()->profile));
                }
            }
            $fileName = uniqid(). $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/profileImages/', $fileName);
            $userData['profile'] = $fileName;
        }
        User::where('id', Auth::user()->id)->update($userData);
        alert()->success('success','Profile Updated Successfully');
        return to_route('user#home');
    }

    //navigate change password
    public function navigateChangePassword(){
        return view('customer.account.changePassword');
    }

    //navigate contact
    public function contact(){
        return view('customer.home.contact');
    }

    //contact submit
    public function contactSubmit(Request $request){
        $request->validate([
            'title' => 'required|min:5|max:30',
            'message' => 'required|max:255'
        ]);

        $contactData = [
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'message' => $request->message
        ];

        Contact::create($contactData);
        alert()->success('success','Message submitted successfully');
        return back();
    }

    //navigate to cart
    public function cart()
{
    $cart = Cart::select('carts.id','carts.product_id','products.image', 'products.name', 'products.price', 'carts.qty')
            ->leftJoin('products','carts.product_id','products.id')
            ->where('user_id',Auth::user()->id)
            ->get();

    $totalPrice = 0;

    foreach($cart as $item){
        $totalPrice += $item->price * $item->qty;
    }

    return view('customer.home.cart',compact('cart', 'totalPrice'));
}


    //get profile data
    private function getProfileData(Request $request){
        return [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address
        ];
    }

    //checkValidation userdata
    private function checkValidation($request){
        $request->validate([
            'name' => 'required|min:6|max:20|unique:users,name,'.$request->user()->id,
            'email' => 'required',
            'address' => 'max:200',
            'image' => 'file|mimes:jpg,png,jpeg,svg,gif'
        ]);
    }

}
