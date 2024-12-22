<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AdminController extends Controller
{
    //direct admin homepage
    public function homePage(){
        $totalAmt = PaymentHistory::sum('total_amt');
        $orderCount = Order::distinct('order_code')->count('order_code');
        $userCount = User::where('role','user')->count('id');
        $pendingOrderCount = Order::distinct('order_code')->where('status',0)->count('order_code');
        return view('admin.home.list', compact('totalAmt', 'orderCount','userCount','pendingOrderCount'));
    }

    //navigate new admin creation
    public function newAdmin(){
        return view('admin.account.new');
    }

    //create new admin
    public function create( Request $request){
        $request->validate([
            'name' => 'required|min:2|max:20',
            'email' => 'required',
            'password' => 'required|min:8|max:20',
            'confirmPassword' => 'required|min:8|max:20|same:password'
        ]);

        $adminData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin'
        ];

        User::create($adminData);
        alert()->success('Create Admin','New Admin created Successfully');
        return to_route('admin#list');
    }

    //admin list navigation
    public function adminlist(){
        $admins = User::whereIn('role',['admin','superadmin'])
                    ->when(request('searchKey'), function($query){
                        $query->whereAny(['name','address','email','role','provider','created_at','phone'],'like','%'.request('searchKey').'%');
                    })
                    ->paginate(4);

        return view('admin.account.adminList', compact('admins'));
    }

    public function userlist(){
        $users = User::where('role', 'user')
        ->when(request('searchKey'), function($query){
            $query->whereAny(['name','address','email','role','provider','created_at','phone'],'like','%'.request('searchKey').'%');
        })
        ->paginate(4);

        return view('admin.account.userList', compact('users'));
    }

    public function navigate(){
        return view('admin.profile.profile');
    }

    //profile edit
    public function edit(){
        $profile = User::find(Auth::user()->id);
        return view('admin.profile.edit',compact('profile'));
    }

    //profile update
    public function update(Request $request){
        $this->checkValidation($request);

        $profileData = $this->getProfileData($request);

        if($request->hasFile('image')){

            if(Auth::user()->profile != null){
                if(file_exists(public_path('profileImages/' . Auth::user()->profile))){
                    unlink(public_path('profileImages/' . Auth::user()->profile));
                }
            }
            $imageName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/profileImages/', $imageName);
            $profileData['profile'] = $imageName;
        }
        User::where('id',$request->user()->id)->update($profileData);
        alert()->success('success','Profile Updated Successfully');
        return to_route('profile#view');
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

    //check profile data validation
    private function checkValidation(Request $request){
        $request->validate([
            'name' => 'required|min:6|max:20|unique:users,name,'.$request->user()->id,
            'email' => 'required',
            'address' => 'min:3|max:200',
            'image' => 'file|mimes:jpg,png,jpeg,svg,gif'
        ]);
    }

    //order list
    public function orderList(Request $request){
        $paymentData = PaymentHistory::select('payment_histories.created_at','orders.order_code','payment_histories.user_name','orders.status')
                        ->leftJoin('orders','orders.order_code','payment_histories.order_code')
                        ->when(request('searchKey'),function($query){
                            $query->whereAny(['orders.order_code','payment_histories.user_name'],'LIKE','%'.request('searchKey').'%');
                        })
                        ->distinct()
                        ->get();

        return view('admin.order.orderList', compact('paymentData'));
    }

    public function orderDetail($orderCode){
        $orders = Order::select('users.name as user_name','orders.user_id','users.phone','products.id','orders.order_code','orders.count as order_count','orders.created_at','products.image','products.stock','products.price',
                    'products.name')
                    ->leftJoin('users','orders.user_id','users.id')
                    ->leftJoin('products','orders.product_id','products.id')
                    ->where('order_code', $orderCode)
                    ->get();

        $stockchecks = Order::select('products.stock', 'orders.count')
                    ->leftJoin('products', 'products.id', 'orders.product_id')
                    ->where('order_code', $orderCode)
                    ->distinct('products.id')
                    ->get();

        $stockValidation = true;

        foreach($stockchecks as $stockcheck){
            if($stockcheck->count > $stockcheck->stock){
                $stockValidation = false;
            }
        }

        $paymentHistory = PaymentHistory::select('user_name','phone','address','payment_method','total_amt', 'payslip_image','created_at')
                            ->where('order_code',$orderCode)
                            ->first();

        return view('admin.order.details',compact('orders','stockValidation', 'paymentHistory'));
    }

    //order rejection
    public function orderReject(Request $request){
        Order::where('order_code', $request['orderCode'])->update([
            'status' => 2
        ]);

        return response()->json([
            'status' => 'success'
        ]);

    }

    //status onchange
    public function statusOnChange(Request $request){

        $orderCode = $request['orderCode'];
        $status = $request['status'];

        Order::where('order_code',$orderCode)->update([
            'status' => $status
        ]);

        return response()->json([
            'status' => 'success'
        ]);
    }

    //order confirm
    public function orderConfirm(Request $request) {
        $orders = $request->all();
        logger($orders);
        Order::where('order_code', $orders[0]['orderCode'])->update([
                    'status' => 1
                ]);

        foreach($orders as $order){
            if ($order['productStock'] < $order['productOrderCount']) {
                alert()->error('Order Fail', 'Order failed :(');
                return response()->json([
                    'status' => 'error',
                    'message' => 'Insufficient stock to confirm the order.',
                ], 400);
            }
            Product::where('id', $order['productId'])->decrement('stock', $order['productOrderCount']);

        }

        alert()->success('Order Confirmation', 'Order Confirmed Successfully');

        return response()->json([
            'status' => 'success',
            'message' => 'Order confirmed successfully.',
        ]);

    }

    //sales informations
    public function saleInformation(){
        $saleData = PaymentHistory::select(
                    'payment_histories.user_name',
                    'payment_histories.payslip_image',
                    'payment_histories.total_amt',
                    'payment_histories.order_code',
                    'payment_histories.created_at')
                    ->leftJoin('orders', 'orders.order_code','payment_histories.order_code')
                    ->where('orders.status', 1)
                    ->distinct('payment_histories.order_code')
                    ->get();
        return view('admin.home.saleInfo', compact('saleData'));
    }

}
