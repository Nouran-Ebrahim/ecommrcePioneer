<?php

namespace App\Livewire\Website;

use Livewire\Component;
use App\Models\Wishlist as ModelsWishlist;

class WishlistTable extends Component
{

    public function removeFromWishlist($wishlistId)
    {
        $wishlistProduct = ModelsWishlist::where('id', $wishlistId)->first();
        if ($wishlistProduct) {
            $wishlistProduct->delete();
            $this->dispatch('remove-wishlist', __('messages.removed_successfully'));
            $this->dispatch('wishlistCountRefresh');
        }
    }
    public function clearWishlist()
    {
        auth('web')->user()->wishlists()->delete();
        $this->dispatch('wishlistCountRefresh');
    }
    public function render()
    {
        return view('livewire.website.wishlist-table', [
            'wishlists' => auth('web')->user()->wishlists()->with(['product'])->get()
        ]);
    }
}
