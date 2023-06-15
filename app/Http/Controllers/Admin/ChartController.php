<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChartController extends Controller
{
    public function ChartsAll()
    {
        $TotalSold = DB::select(DB::raw("select products.product_name as prod , SUM(order_items.quantity) AS qty FROM order_items LEFT JOIN products ON products.id = order_items.product_id GROUP BY products.product_name"));
        $ProdData = "";
        foreach ($TotalSold as $val) {
            $ProdData.= "['".$val->prod."',     ".$val->qty."],";
        }
        $chartTotalSold = $ProdData;

        $ProductAmount = DB::select(DB::raw("select products.product_name as prod , SUM(order_items.total_price) AS total FROM order_items LEFT JOIN products ON products.id = order_items.product_id GROUP BY products.product_name"));
        $AmountData = "";
        foreach ($ProductAmount as $val) {
            $AmountData.= "['".$val->prod."',     ".$val->total."],";
        }
        
        $chartAmountSold = $AmountData;

        return view('backend.charts.charts_all', compact('chartAmountSold', 'chartTotalSold'));
    }
}
