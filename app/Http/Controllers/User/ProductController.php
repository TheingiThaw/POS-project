<?php

namespace App\Http\Controllers\User;

use App\Models\Rating;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //product details navigation
    public function details($id){
        $product = Product::select('products.id','products.name','products.price','products.stock', 'products.description','products.image','products.category_id','categories.name as category_name')
                    ->leftJoin('categories','products.category_id', '=','categories.id')
                    ->where('products.id',$id)
                    ->first();

        $comments = Comment::select('comments.comment','users.name','comments.created_at','users.profile as userImage')
                    ->leftJoin('users','comments.user_id','users.id')
                    ->where('comments.product_id',$id)
                    ->orderBy('comments.created_at', 'desc')
                    ->get();

        $ratings = number_format(Rating::where('product_id',$id)->avg('count'));

        $userRating = number_format(Rating::where('product_id',$id)->where('user_id',Auth::user()->id)->value('count'));

        return view('customer.product.detail', compact('product','comments', 'ratings','userRating'));
    }

    //user comment on product
    public function comment(Request $request){
        Comment::create([
            'product_id' => $request->productId,
            'user_id' => Auth::user()->id,
            'comment' => $request->comment
        ]);

        alert()->success('success','You have commented');
        return back();
    }

    //user rating on product
    public function rate(Request $request){
        Rating::updateOrCreate(
            ['user_id' => Auth::user()->id],
            [
            'product_id' => $request->productId,
            'user_id' => Auth::user()->id,
            'count' => $request->productRating
        ]);
        alert()->success('success','Thanks for rating');
        return back();
    }
}
