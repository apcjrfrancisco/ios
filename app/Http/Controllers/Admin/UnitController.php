<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    public function UnitAll()
    {
        $units = Unit::latest()->get();
        return view('backend.unit.unit_all', compact('units'));
    }

    public function UnitAdd()
    {
        return view('backend.unit.unit_add');
    }

    public function UnitStore(Request $request)
    {
        Unit::insert([
            'unit_name' => $request->unit_name,
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Unit Created',  
            'alert-type' => 'success'
        );
        return redirect()->route('unit.all')->with($notification);
    }
}
