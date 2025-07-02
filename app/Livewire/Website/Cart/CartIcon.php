<?php

namespace App\Livewire\Website\Cart;

use Livewire\Component;
use Livewire\Attributes\On;

class CartIcon extends Component
{
     public function removeItemFormCart($id)
    {
        $authBoolean = auth('web')->check();
        if ($authBoolean) {
            $cartItem = auth('web')->user()->cart->items()->where('id', $id)->first();
            $cartItem->delete();
            $this->dispatch('updateCart');

            // delete coupon if the last item is deleted
            if (auth('web')->user()->cart->items->count() == 0) {
                auth('web')->user()->cart->update(['coupon' => null]);
            }
        }

        // new code : make event to refresh checkout component in case opened
        $this->dispatch('orderSummaryRefresh');
    }
    #[On('refreshCartIcon')] // to listen for add to cart as it render the carticon component again
    public function render()
    {
        $authBoolean = auth('web')->check();

        // $cartItemCount = $authBoolean ? auth('web')->user()->cart->cartItems->count() : 0 ;
        // $cartItems = $authBoolean ? auth('web')->user()->cart->cartItems : [];
        $cartItemCount = $authBoolean ? auth('web')->user()->cart?->items()->count() ?? 0 : 0;
        $cartItems = $authBoolean ? auth('web')->user()->cart?->items ?? collect() : collect();
        return view('livewire.website.cart.cart-icon',[
            'cartItems'=>$cartItems,
            'cartItemCount'=>$cartItemCount,
        ]);
    }
}
