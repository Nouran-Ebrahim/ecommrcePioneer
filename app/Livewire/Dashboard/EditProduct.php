<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Services\Dashboard\ProductService;
use Livewire\WithFileUploads;

class EditProduct extends Component
{
    use WithFileUploads;
    public $currentStep = 1;
    public $successMessage = '';
    public $product,$valueRowCount=0;
    public $images, $tags, $discount, $start_discount, $end_discount, $quantity, $price, $sku;
    public $name_ar, $name_en, $desc_ar, $desc_en, $small_desc_ar, $small_desc_en, $category_id, $brand_id, $available_for;
    public $has_variants, $manage_stock, $has_discount;
    public $prices = [], $quantities = [], $variantAttributes = [], $variants;
    public $brands, $categories, $productId, $productAttributes = [];
    protected ProductService $productService;
    public function boot(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function mount($categories, $brands, $productId, $productAttributes)
    {
        $this->categories = $categories;
        $this->brands = $brands;
        $this->product = $this->productService->getProduct($productId);
        $this->productAttributes = $productAttributes;

        //first step properties
        $this->name_ar = $this->product->getTranslation('name', 'ar');
        $this->name_en = $this->product->getTranslation('name', 'en');
        $this->desc_ar = $this->product->getTranslation('desc', 'ar');
        $this->desc_en = $this->product->getTranslation('desc', 'en');
        $this->small_desc_ar = $this->product->getTranslation('small_desc', 'ar');
        $this->small_desc_en = $this->product->getTranslation('small_desc', 'en');
        $this->sku = $this->product->sku;
        $this->category_id = $this->product->category_id;
        $this->brand_id = $this->product->brand_id;
        $this->available_for = $this->product->available_for;

        //secound step
        $this->has_variants = $this->product->has_variants;
        $this->manage_stock = $this->product->manage_stock;
        $this->has_discount = $this->product->has_discount;
        $this->discount = $this->product->discount;
        $this->start_discount = $this->product->start_discount;
        $this->end_discount = $this->product->end_discount;
        $this->quantity = $this->product->quantity;
        $this->price = $this->product->price;
        if ($this->has_variants == 1) {
            $this->variants = $this->product->variants;
            $this->valueRowCount = count($this->variants);
            foreach ($this->variants as $key => $variant) {
                $this->prices[$key] = $variant->price;
                $this->quantities[$key] = $variant->stock;
                foreach ($variant->variantAttributes as $variantAttribute) {
                    $this->variantAttributes[$key][$variantAttribute->attributeValue->attribute_id] = $variantAttribute->attribute_value_id;
                }
            }

        }
        // dd($this->variantAttributes);


    }
    public function addNewVariant()
    {
        $this->prices[] = null;
        $this->quantities[] = null;
        $this->variantAttributes[] = [];
        $this->valueRowCount = count($this->prices); // Keep count synchronized
    }
    public function removeVariant()
    {
        if ($this->valueRowCount > 1) {
            $this->valueRowCount--;
            array_pop($this->prices);
            array_pop($this->quantities);
            array_pop($this->variantAttributes);
        }
    }
    public function firstStepSubmit()
    {
        $this->validate([
            'name_ar' => ['required', 'string', 'max:80'],
            'name_en' => ['required', 'string', 'max:80'],
            'desc_ar' => ['required', 'string', 'max:1000'],
            'desc_en' => ['required', 'string', 'max:1000'],
            'small_desc_ar' => ['required', 'string', 'max:150'],
            'small_desc_en' => ['required', 'string', 'max:150'],
            'sku' => ['required', 'string', 'max:30'],
            'category_id' => ['required', 'exists:categories,id'],
            'brand_id' => ['required', 'exists:brands,id'],
            'available_for' => ['required', 'date'],
            // 'tags'         =>  ['required', 'string'],
        ]);

        $this->currentStep = 2;
    }
    public function secondStepSubmit()
    {
        $data = [
            'has_variants' => ['required', 'in:1,0'],
            'manage_stock' => ['required', 'in:0,1'],
            'has_discount' => ['required', 'in:1,0'],
        ];
        if ($this->has_variants == 0) {
            $data['price'] = ['required', 'numeric', 'min:1', 'max:1000000'];
        }
        if ($this->manage_stock == 1 && $this->has_variants == 0) {
            $data['quantity'] = ['required', 'min:1', 'max:1000000'];
        }
        if ($this->has_discount == 1) {
            $data['discount'] = ['required', 'numeric', 'min:1', 'max:100'];
            $data['start_discount'] = ['date', 'before:end_discount'];
            $data['end_discount'] = ['date', 'after:start_discount'];
        }
        // if ($this->has_variants == 1) {
        //     $data['prices'] = 'required|array|min:1';
        //     $data['prices.*'] = 'required|numeric|min:1|max:1000000';
        //     $data['quantities'] = 'required|array|min:1';
        //     $data['quantities.*'] = 'required|integer|min:0';
        //     $data['attributeValues'] = 'required|array|min:1';
        //     $data['attributeValues.*'] = 'required|array';
        //     $data['attributeValues.*.*'] = 'required|integer|exists:attribute_values,id';
        // }

        $this->validate($data);
        $this->currentStep = 3;
    }
    public function back($step)
    {
        $this->currentStep = $step;
    }
    public function render()
    {
        return view('livewire.dashboard.edit-product');
    }
}
