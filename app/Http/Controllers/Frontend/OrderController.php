<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public $orderItem;

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

    public function CancelOrder(int $orderId, Request $request)
    {
        $order = Order::where('id', $orderId)->first();
        $this->orderItem = OrderItem::where('order_id', $order->id)->get();

        if ($order) {
            $order->update([
                'status_message' => $request->order_status,
                'updated_at' => Carbon::now(),
            ]);

            if ($order->status_message == 'cancelled') {
                foreach ($this->orderItem as $item) {
                    $item->product()->where('id', $item->product_id)->increment('quantity', $item->quantity);
                }
            }
            $this->dispatchBrowserEvent('message', [
                'text' => 'You Cancelled your Order',
                'type' => 'info',
                'status' => 404
            ]);
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
