<?php

namespace App\Livewire\Website;

use Livewire\Attributes\On;
use Livewire\Component;

class WishlistIcon extends Component
{
    #[On('wishlistCountRefresh')] // to listen for add and remove from wishlist as it render the wishlisticon component again
    public function render()
    {
        $count = auth('web')->user() ? auth('web')->user()->wishlists()->get()->count() : 0;
        return view('livewire.website.wishlist-icon', [
            'wishlistCount' => $count
        ]);
    }
}
