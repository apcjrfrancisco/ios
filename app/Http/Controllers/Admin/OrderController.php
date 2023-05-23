<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{

    public function FilterOrder(Request $request)
    {
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $orders = Order::whereDate('created_at', '>=', $start_date)
        ->whereDate('created_at', '<=', $end_date)->get();

        return view('backend.orders.orders_all', compact('orders'));
    }

    public function Orders()
    {
        $orders = Order::latest()->get();
        return view('backend.orders.orders_all', compact('orders'));
    }

    public function OrderShow(int $orderId)
    {
        $order = Order::where('id', $orderId)->first();

        if ($order) {
            return view('backend.orders.orders_view', compact('order'));
        } else {
            $notification = array(
                'message' => 'Order not Found',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function UpdateOrderStatus(int $orderId, Request $request)
    {
        $order = Order::where('id', $orderId)->first();

        if ($order) {
            $order->update([
                'status_message' => $request->order_status,
                'updated_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Order Status Updated',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Order not Found',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
}
