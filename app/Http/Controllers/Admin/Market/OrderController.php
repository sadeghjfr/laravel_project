<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Admin\Market\Order;
use App\Models\Admin\Market\ProductCategory;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(){
        $newOrders = Order::where('status', 'new')->get();
        $waitingOrders = Order::where('status', 'waiting')->get();
        $sentOrders = Order::where('status', 'sent')->get();
        $deliveredOrders = Order::where('status', 'delivered')->get();
        $canceledOrders = Order::where('status', 'canceled')->get();
        $returnedOrders = Order::where('status', 'returned')->get();
        return view(
            'admin.market.order.index',
            compact('newOrders', 'waitingOrders', 'sentOrders', 'deliveredOrders', 'canceledOrders', 'returnedOrders')
        );
    }

    public function show(Order $order){

        if ($order->status === 'new'){
            $order->status = 'waiting';
            $order->save();
        }
        return view('admin.market.order.show', compact('order'));
    }

    public function detail(Order $order){

        return view('admin.market.order.detail', compact('order'));
    }

    public function destroy(Order $order)
    {
        $result = $order->delete();
        return redirect()->route('admin.market.order.index')->with('swal-success', 'سفارش با موفقیت حذف شد');
    }


    public function cancel(Order $order){

        $order->status = 'canceled';
        $order->save();
        return back();
    }

    public function return(Order $order){

        $order->status = 'returned';
        $order->save();
        return back();
    }

    public function waiting(Order $order){
        $order->status = 'waiting';
        $order->sent_at = null;
        $order->save();
        return back();
    }

    public function sent(Order $order){
        $order->status = 'sent';
        $order->sent_at = now();
        $order->save();
        return back();
    }

    public function delivered(Order $order){

        if ($order->status === 'waiting')
            $order->sent_at = now();

        $order->status = 'delivered';
        $order->save();
        return back();
    }

}
