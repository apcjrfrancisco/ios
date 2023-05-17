<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class BrandController extends Controller
{
    public function BrandAll()
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all', compact('brands'));
    }

    public function BrandAdd()
    {
        $categories = Category::all();
        return view('backend.brand.brand_add', compact('categories'));
    }
}
