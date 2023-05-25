<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceOrderMailable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public $orderItem;

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

    public function ViewInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        return view('backend.invoice.generate-invoice', compact('order'));
    }

    public function GenerateInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        $data = ['order' => $order];
        $pdf = Pdf::loadView('backend.invoice.generate-invoice', $data);
        $todayDate = Carbon::now()->format('m-d-Y');
        return $pdf->download('TM-invoice-' . $order->name . '-' . $todayDate . '.pdf');
    }

    public function MailInvoice(int $orderId)
    {
        $order = Order::findOrFail($orderId);
        try {
            Mail::to("$order->email")->send(new InvoiceOrderMailable($order));

            $notification = array(
                'message' => 'Invoice sent to ' . $order->email,
                'alert-type' => 'success'
            );

            return redirect('/admin/orders/' . $orderId)->with($notification);
        } catch (\Exception $e) {
            $notification = array(
                'message' => 'Something went wrong',
                'alert-type' => 'error'
            );

            return redirect('/admin/orders/' . $orderId)->with($notification);
        }
    }
}
