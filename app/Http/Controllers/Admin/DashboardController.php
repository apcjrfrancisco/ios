<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $orders = Order::orderBy('id', 'desc')->limit(5)->get();
        $orderComplete = Order::where('status_message', 'completed')->get();
        $orderCompleteCount = Order::where('status_message', 'completed')->count();
        $orderCount = Order::count();
        $sales = DB::table('order_items')
            ->leftJoin('products', 'products.id', '=', 'order_items.product_id')
            ->selectRaw('products.id, sum(order_items.quantity) total')
            ->groupBy('products.id')
            ->orderBy('total', 'desc')
            ->take(10)
            ->get();
        
        $customer = Order::with('user')->addSelect(DB::raw('count(id) as purchase_total, user_id'))
        ->groupBy('user_id')->take(10)
        ->orderBy('purchase_total', 'DESC')->get();

        return view('admin.dashboard', compact('orders', 'orderComplete', 'orderCompleteCount', 'orderCount', 'sendmailrestock', 'sales', 'customer'));
    }

    public function NotificationMinimumMail()
    {
        try {
            $allData = Product::latest()->get();
            $admin = User::where('id', Auth::user()->id)->where('role_as', '1')->get();
            foreach ($allData as $item) {
                if ($item->to_reorder > $item->quantity && $item->quantity != 0) {
                    Mail::to("torrecampsm@gmail.com")->send(new NotificationMinimumMailable($allData));
                }
                if ($item->quantity == 0) {
                    Mail::to("torrecampsm@gmail.com")->send(new NotificationNoStockMailable($allData));
                }
            }
        } catch (\Exception $e) {
        }
    }
}
