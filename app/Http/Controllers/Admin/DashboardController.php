<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->get();
        $orderComplete = Order::where('status_message', 'completed')->get();
        $orderCompleteCount = Order::where('status_message', 'completed')->count();
        $orderCount = Order::count();
        return view('admin.dashboard', compact('orders', 'orderComplete', 'orderCompleteCount', 'orderCount'));
    }
}
