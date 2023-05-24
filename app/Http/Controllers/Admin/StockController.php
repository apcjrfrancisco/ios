<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function StockReport()
    {
        $allData = Product::orderBy('supplier_id', 'ASC')->orderBy('category_id', 'ASC')->orderBy('brand_id', 'ASC')->get();

        return view('backend.stock.stock_report', compact('allData'));
    }

    public function StockReportPdf()
    {
        $allData = Product::orderBy('supplier_id', 'ASC')->orderBy('category_id', 'ASC')->orderBy('brand_id', 'ASC')->get();

        return view('backend.pdf.stock_report_pdf', compact('allData'));
    }
}
