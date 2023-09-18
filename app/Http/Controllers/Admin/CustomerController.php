<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function CustomerAll() 
    {
        $customers = Customer::latest()->get();
        return view('backend.customer.customer_all', compact('customers'));
    }

    public function CustomerAdd()
    {
        return view('backend.customer.customer_add');
    }

    public function CustomerStore(Request $request)
    {
        Customer::insert([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'customer_address1' => $request->customer_address1,
            'customer_address2' => $request->customer_address2,
            'customer_city' => $request->customer_city,
            'customer_province' => $request->customer_province,
            'customer_zipcode' => $request->customer_zipcode,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Supplier Created',  
            'alert-type' => 'success'
        );
        return redirect()->route('customer')->with($notification);
    }

    public function CustomerEdit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('backend.customer.customer_edit', compact('customer'));
    }

    public function CustomerUpdate(Request $request)
    {
        $customer_id = $request->id;

        Customer::findOrFail($customer_id)->update([
            'customer_name' => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'customer_email' => $request->customer_email,
            'customer_address1' => $request->customer_address1,
            'customer_address2' => $request->customer_address2,
            'customer_city' => $request->customer_city,
            'customer_province' => $request->customer_province,
            'customer_zipcode' => $request->customer_zipcode,
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Customer Updated',  
            'alert-type' => 'info'
        );
        return redirect()->route('customer')->with($notification);
    }

    public function CustomerDelete($id)
    {
        Customer::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Customer Deleted',  
            'alert-type' => 'info'
        );
        return redirect()->route('customer')->with($notification);
    }

}
