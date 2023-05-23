<?php

namespace App\Http\Livewire\Frontend\Product;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class View extends Component
{

    public $category;
    public $product;
    public $quantityCount = 1;

    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product
        ]);
    }

    public function addToWishlist($productId)
    {
        if (Auth::check()) {

            if (Wishlist::where('user_id', Auth::user()->id)->where('product_id', $productId)->exists()) {

                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already added in Wishlist',
                    'type' => 'info',
                    'status' => 300
                ]);

                return redirect()->back();
            } else {
                $wishlist = Wishlist::insert([
                    'user_id' => Auth::user()->id,
                    'product_id' => $productId,
                    'created_at' => Carbon::now()
                ]);
                $this->emit('wishlistAddedUpdated');

                $this->dispatchBrowserEvent('message', [
                    'text' => 'Added in Wishlist',
                    'type' => 'success',
                    'status' => 500
                ]);

                return redirect()->back();
            }
        } else {

            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to Continue',
                'type' => 'info',
                'status' => 401
            ]);
            return redirect()->route('login');
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantityCount > 1) {
            $this->quantityCount--;
        }
    }

    public function incrementQuantity()
    {

        $this->quantityCount++;
    }
}
