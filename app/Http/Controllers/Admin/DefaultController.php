<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DefaultController extends Controller
{
    public function GetBrand(Request $request)
    {
        $category_id = $request->category_id;
        // dd($category_id);
        $allBrand = Brand::where('category_id',$category_id)->get();
        return response()->json($allBrand);
    }
}
