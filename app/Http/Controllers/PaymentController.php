<?php

namespace App\Http\Controllers;

use App\Models\Installment;
use App\Models\Order;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Show avaliable payment methods
    public function showPaymentMethods()
    {
        $methods = PaymentMethod::all();
        return view('payment.methods', ['methods' => $methods]);
    }

    // Add new payment method
    public function createPaymentMethod(Request $request)
    {
        $method = PaymentMethod::create($request->all());
        return redirect()->route('payment.methods');
    }

    // Show installments for a payable or dreceivable account
    public function showInstallments()
    {
        $installments = Installment::all();
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('payment.installments', [
            'installments' => $installments,
            'orders' => $orders
        ]);
    }

    // Add installments for a payable or dreceivable account
    public function createInstallment(Request $request)
    {
        Installment::create($request->all());
        return redirect()->back();
    }
}
