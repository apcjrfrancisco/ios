<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function Index()
    {
        $sliders = Slider::where('status', '0')->get();
        return view('frontend.index', compact('sliders'));
    }

    public function Categories()
    {
        $categories = Category::latest()->get();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function Products($category_slug)
    {
        $category = Category::where('category_slug', $category_slug)->first();

        if ($category) {
            $products = $category->products()->get();

            return view('frontend.collections.products.index', compact('products', 'category'));
        } else {
            return redirect()->back();
        }
    }
}
