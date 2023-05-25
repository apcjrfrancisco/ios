<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

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

    public function PurchaseStore(Request $request)
    {
        if ($request->category_id == null) {
            
            $notification = array(
                'message' => 'Please Select Category',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {
            $count_category = count($request->category_id);
            for ($i=0; $i < $count_category; $i++) { 
                $purchase = new Purchase();
                $purchase->date = date('Y-m-d', strtotime($request->date[$i]));
                $purchase->purchase_no = $request->purchase_no[$i];
                $purchase->supplier_id = $request->supplier_id[$i];
                $purchase->category_id = $request->category_id[$i];
                $purchase->brand_id = $request->brand_id[$i];
                $purchase->product_id = $request->product_id[$i];
                $purchase->buying_qty = $request->buying_qty[$i];
                $purchase->unit_price = $request->unit_price[$i];
                $purchase->buying_price = $request->buying_price[$i];

                $purchase->created_by = Auth::user()->id;
                $purchase->status = '0';
                $purchase->save();
            }
        }

        $notification = array(
            'message' => 'Purchase Created',
            'alert-type' => 'success'
        );

        return redirect()->route('purchase')->with($notification);
    }

    public function PurchaseDelete($id)
    {
        Purchase::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Purchase Deleted',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function PurchasePending()
    {
        $allData = Purchase::orderBy('date', 'desc')->orderBy('id', 'desc')->where('status', '0')->get();
        return view('backend.purchase.purchase_pending', compact('allData'));
    }

    public function PurchaseApprove($id)
    {
        $purchase = Purchase::findOrFail($id);
        $product = Product::where('id', $purchase->product_id)->first();
        $purchase_qty = ((float)($purchase->buying_qty))+ ((float)($product->quantity));
        $product->quantity = $purchase_qty;

        if ($product->save()) {
            Purchase::findOrFail($id)->update([
                'status' => '1',
            ]);
            $notification = array(
                'message' => 'Purchase Approved',
                'alert-type' => 'success'
            );
    
            return redirect()->route('purchase')->with($notification);
        }
    }

    public function PurchaseView(Request $request)
    {
        $purchase_no = $request->purchase_no;

        $purchase = Purchase::where('purchase_no', $purchase_no)->get();

        return view('backend.purchase.purchase_view', compact('purchase'));

    }
}
