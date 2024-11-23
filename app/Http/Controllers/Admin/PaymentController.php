<?php

namespace App\Http\Controllers\Admin;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    //list payment
    public function list(){
        $payments = Payment::OrderBy('account_name','desc')
                    ->get();
        return view('admin.payment.payment',compact('payments'));
    }

    public function createPayment(Request $request){
        $this->checkValidation($request);
        $data = $this->getPaymentData($request);

        Payment::create($data);
        alert()->success('success','New Payment Created Successfully');
        return back();
    }

    //edit payment navigation
    public function edit(Request $request, $id){
        $payment = Payment::where('id', $id)->first();
        return view('admin.payment.edit',compact('payment'));
    }

    //update payment
    public function update(Request $request, $id){
        $this->checkValidation($request);

        $paymentData = $this->getPaymentData($request);

        Payment::where('id',$id)->update($paymentData);
        alert()->success('success','Payment Updated Successfully');
        return to_route('payment#list');
    }

    //delete payment
    public function delete(Request $request, $id){
        Payment::where('id',$id)->delete();

        return to_route('payment#list');
    }

    //get payment data
    private function getPaymentData(Request $request){
        return [
            'account_name' => $request->paymentName,
            'account_number' => $request->accountNumber,
            'type' => $request->type
        ];
    }

    private function checkValidation($request){
        $rules = [
            'paymentName' => 'required|max:30',
            'accountNumber' => 'required|min:7|max:15',
            'type' => 'required'
        ];

        $message = [];
        $request->validate($rules, $message);
    }
}
