<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationMinimumMailable;
use App\Mail\NotificationNoStockMailable;

class DashboardController extends Controller
{

    public function index()
    {
        $sendmailrestock = $this->NotificationMinimumMail();
        $orders = Order::orderBy('id', 'desc')->get();
        $orderComplete = Order::where('status_message', 'completed')->get();
        $orderCompleteCount = Order::where('status_message', 'completed')->count();
        $orderCount = Order::count();
        return view('admin.dashboard', compact('orders', 'orderComplete', 'orderCompleteCount', 'orderCount', 'sendmailrestock'));
    }

    public function NotificationMinimumMail()
    {
        try {
            $allData = Product::latest()->get();
            foreach ($allData as $item) {
                if ($item->to_reorder > $item->quantity && $item->quantity != 0) {
                    Mail::to("franciscoterence98@gmail.com")->send(new NotificationMinimumMailable($allData));
                }
                if ($item->quantity == 0) {
                    Mail::to("franciscoterence98@gmail.com")->send(new NotificationNoStockMailable($allData));
                }
            }
        } catch (\Exception $e) {
        }
    }
}
