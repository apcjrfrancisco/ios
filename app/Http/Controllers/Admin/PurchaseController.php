<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseController extends Controller
{
    public function PurchaseAll()
    {
        $allData = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->get();
        return view('backend.purchase.purchase_all', compact('allData'));
    }

    public function PurchaseAdd()
    {
        $supplier = Supplier::all();
        $category = Category::all();
        $unit = Unit::all();
        $brand = Brand::all();
        return view('backend.purchase.purchase_add', compact('supplier', 'category', 'unit', 'brand'));
    }
}
