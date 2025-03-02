<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function index(){

        $onlinePayments = Payment::where('type', 'online')->where('paymentable_type', 'App\Models\Admin\Market\OnlinePayment')->get();
        $offlinePayments = Payment::where('type', 'offline')->where('paymentable_type', 'App\Models\Admin\Market\OfflinePayment')->get();
        $cashPayments = Payment::where('type', 'cash')->where('paymentable_type', 'App\Models\Admin\Market\CashPayment')->get();
        return view('admin.market.payment.index', compact('onlinePayments', 'offlinePayments', 'cashPayments'));
    }

    public function paid(Payment $payment){

        $payment->status = 'paid';
        $result = $payment->save();
        return redirect()->route('admin.market.payment.index')->with('toast-success', 'وضعیت پرداخت با موفقیت تغییر کرد');
    }

    public function unpaid(Payment $payment){

        $payment->status = 'unpaid';
        $result = $payment->save();
        return redirect()->route('admin.market.payment.index')->with('toast-success', 'وضعیت پرداخت با موفقیت تغییر کرد');
    }

    public function canceled(Payment $payment){

        $payment->status = 'canceled';
        $result = $payment->save();
        return redirect()->route('admin.market.payment.index')->with('toast-success', 'وضعیت پرداخت با موفقیت تغییر کرد');
    }

    public function returned(Payment $payment){

        $payment->status = 'returned';
        $result = $payment->save();
        return redirect()->route('admin.market.payment.index')->with('toast-success', 'وضعیت پرداخت با موفقیت تغییر کرد');
    }

    public function show(Payment $payment){

        return view('admin.market.payment.show', compact('payment'));
    }


}
