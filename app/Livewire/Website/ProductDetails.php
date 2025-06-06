<?php

namespace App\Livewire\Website;

use Livewire\Component;

class ProductDetails extends Component
{
    public $product;
    public $variantId;
    public $quantity;
    public $price;
    public function mount($product)
    {
        $this->product = $product;
        $this->variantId = $product->has_variants ? $this->product->variants->first()->id : null;
        $this->variantId = $product->has_variants ? $this->product->variants->first()->price : null;
        $this->variantId = $product->has_variants ? $this->product->variants->first()->stock : $product->quantity;


    }
    public function changeVariant($variantId)
    {
        $variant = $this->product->variants->find($variantId);
        if (!$variant) {
            return response()->json(['message' => 'Invaild variant'], 404);
        }
        $this->changePropertiesValues($variant);
    }
    public function changePropertiesValues($variant)
    {
        $this->variantId = $variant->id;
        $this->price = $variant->price;
        $this->quantity = $variant->stock;
    }
    public function render()
    {
        return view('livewire.website.product-details', [
            'variants' => $this->product->variants,
        ]);
    }
}
