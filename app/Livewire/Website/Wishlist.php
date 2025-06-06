<?php

namespace App\Livewire\Website;

use Livewire\Component;
use App\Models\Wishlist as ModelsWishlist;
class Wishlist extends Component
{
    public $product;
    public $inWishlist = false;
    public function mount($product)
    {
        $this->product = $product;
        if (auth('web')->check()) {
            $wishlistProduct = ModelsWishlist::where('product_id', $product->id)
                ->where('user_id', auth('web')->user()->id)->first();
            if ($wishlistProduct) {
                $this->inWishlist = true;
            } else {
                $this->inWishlist = false;
            }
        }

    }
    public function addToWishlist($productId)
    {
        if (!auth('web')->check()) {
            return redirect()->route('website.login.get');
        }
        ModelsWishlist::create([
            'user_id' => auth('web')->user()->id,
            'product_id' => $productId
        ]);
        $this->inWishlist = true;
        $this->dispatch('added-wishlist', __('messages.added_successfully'));
        $this->dispatch('wishlistCountRefresh');

    }
    public function removeToWishlist($productId)
    {
        if (!auth('web')->check()) {
            return redirect()->route('website.login.get');
        }
        $wishlistProduct = ModelsWishlist::where('product_id', $productId)
            ->where('user_id', auth('web')->user()->id)->first();
        if ($wishlistProduct) {

            $wishlistProduct->delete();
            $this->inWishlist = false;
            $this->dispatch('remove-wishlist', __('messages.removed_successfully'));
            $this->dispatch('wishlistCountRefresh');

        }

    }
    public function render()
    {
        return view('livewire.website.wishlist');
    }
}
