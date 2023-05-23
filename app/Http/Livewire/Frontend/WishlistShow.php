<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class WishlistShow extends Component
{
    public function render()
    {
        $wishlist = Wishlist::where('user_id', Auth::user()->id)->get();
        return view('livewire.frontend.wishlist-show', [
            'wishlist' => $wishlist,
        ]);
    }
}
