<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function Orders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('frontend.orders.index', compact('orders'));
    }

    public function OrderShow($orderId)
    {
        $order = Order::where('user_id', Auth::user()->id)->where('id', $orderId)->first();

        if ($order) {
            return view('frontend.orders.view', compact('order'));
        } else {

            $this->dispatchBrowserEvent('message', [
                'text' => 'No Order Found',
                'type' => 'error',
                'status' => 404
            ]);

            return redirect()->back();
        }
    }
}
