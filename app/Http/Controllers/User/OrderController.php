<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function addToCart(Request $request){
        Cart::create([
            'product_id'=>$request->productId,
            'user_id' =>$request->userId,
            'qty' => $request->count
        ]);

        alert()->success('Product added to cart', 'Success');
        return back();
    }

    //delete cart data
    public function cartDelete(Request $request){
        $cartId = $request['cartId'];
        Cart::where('id', $cartId)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Cart Deleted Successfully'
        ],200);
    }

        //temp storage
        public function tempStorage(Request $request) {

            $orderTemp = json_decode($request['tempOrder']);
            Session::put('tempOrder', $orderTemp);

            return response()->json([
            'status' => 'success',
            'message' => 'tempory order list stored!'
            ]);
        }

        //navigate payment page
        public function paymentPage(Request $request){
            $payments = Payment::orderBy('type','asc')->get();
            $orderList = Session::get('tempOrder');
            logger($orderList);
            return view('customer.home.payment', compact('payments', 'orderList'));
        }

        //user payment
        public function payment(Request $request){
            $request->validate([
                'name' => 'required|min:2|max:20',
                'phone' => 'required|min:3|max:11',
                'address' => 'required|max:30',
                'paymentType' => 'required',
                'payslipImage' => 'required|file|mimes:png,jpeg,jpg,webp,svg'
            ]);

            $paymentData = [
                'user_name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'payment_method' => $request->paymentType,
                'order_code' => $request->orderCode,
                'total_amt' => $request->totalAmount
            ];

            if($request->hasFile("payslipImage")){
                $fileName = uniqid() . $request->file('payslipImage')->getClientOriginalName();
                $request->file('payslipImage')->move(public_path().'/payslipImage/',$fileName);
                $paymentData['payslip_image'] = $fileName;
            }

            $orderData = Session::get('tempOrder');
            PaymentHistory::create($paymentData);

            foreach($orderData as $order){
                Order::create([
                    'product_id' => $order->product_id,
                    'user_id' => $order->user_id,
                    'count' => $order->count,
                    'status' => $order->status,
                    'order_code' => $order->order_code
                ]);

                Cart::where('user_id',$order->user_id)->where('product_id',$order->product_id)->delete();
            }
            alert()->success('Thanks for ordering', 'Fruits ordered successfully');
            return to_route('user#home');
        }

        //user order List
        public function orderList(){
            $orders = Order::select('order_code','created_at','status')
                        ->where('user_id',Auth::user()->id)
                        ->distinct()
                        ->get();
            return view('customer.home.orderList', compact('orders'));
        }
}
