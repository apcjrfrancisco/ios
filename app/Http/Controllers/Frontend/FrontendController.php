<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function Index()
    {
        $sliders = Slider::where('status', '0')->get();
        return view('frontend.index', compact('sliders'));
    }

    public function searchProducts(Request $request)
    {
        if($request->search){
            $searchProducts = Product::where('product_name','LIKE','%'.$request->search.'%')->latest()->paginate(10);
            return view('frontend.pages.search', compact('searchProducts'));
        } else {
            
            return redirect()->back()->with('message', 'Empty Search');

        }
    }

    public function Categories()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        return view('frontend.collections.category.index', compact('categories'));
    }

    public function Products($category_slug)
    {
        $category = Category::where('category_slug', $category_slug)->first();

        if ($category) {
            return view('frontend.collections.products.index', compact('category'));
        } else {
            return redirect()->back();
        }
    }

    public function ProductView(string $category_slug, string $product_slug)
    {
        $category = Category::where('category_slug', $category_slug)->first();

        if ($category) {

            $product = $category->products()->where('product_slug', $product_slug)->first();

            if ($product) {
                return view('frontend.collections.products.view', compact('category', 'product'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function ThankYou()
    {
        return view('frontend.thank-you');
    }

    public function TermsService()
    {
        return view('auth.termsprivacy.terms');
    }
    
    public function PrivacyPolicy()
    {
        return view('auth.termsprivacy.privacy');
    }

}
