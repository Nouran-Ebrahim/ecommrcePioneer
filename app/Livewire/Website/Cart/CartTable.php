<?php

namespace App\Livewire\Website\Cart;

use Livewire\Component;

class CartTable extends Component
{
    public function render()
    {
        return view('livewire.website.cart.cart-table', [
            'carts' => auth('web')->user()->carts()->with(['items'])->get()
        ]);
    }
}
