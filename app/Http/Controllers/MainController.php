<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Razorpay\Api\Api;
use Session;

class MainController extends Controller
{
    public function index()
    {
        return view("index");
    }

    public function success()
    {
        return view('success');
    }

    public function payment(Request $request)
    {
        $name = $request->input('name');
        echo $name;
        $amount = $request->input('amount');
        echo $amount;
        $api = new Api('rzp_test_EaDYmDjFryHYMK', 'HMWkp5yQFl5odS4IFV2mNcBy');
        $order  = $api->order->create(array('receipt' => '123', 'amount' => $amount * 100, 'currency' => 'INR')); // Creates order
        $orderId = $order['id'];


        $userPay = new Payment();
        $userPay->name = $name;
        $userPay->amount = $amount;
        $userPay->payment_id = $orderId;
        $userPay->save();

        Session::put('orderId', $orderId);
        Session::put('amount', $amount);

        return redirect('/');
    }


    public function pay(Request $request)
    {
        $data = $request->all();
        $user = Payment::where('payment_id', $data['razorpay_order_id'])->first();
        $user->payment_done = true;
        $user->razorpay_id = $data['razorpay_payment_id'];
        $user->save();
        return redirect('/success');
    }
    public function error()
    {
        return view('error');
    }


    //

}
