<?php

namespace App\Livewire\Website\Checkout;

use App\Models\City;
use App\Models\Country;
use Livewire\Component;
use App\Models\Government;
use App\Models\ShippingGovernment;

class ShippingDetails extends Component
{
     public $countryId, $governorateId, $cityId;

    public function updatedGovernorateId()
    {
        $price = ShippingGovernment::where('government_id', $this->governorateId)->first()->price;
        $this->dispatch('shippingPriceUpdated', $price);
    }
    public function render()
    {
        return view('livewire.website.checkout.shipping-details', [
            'countries'    => Country::where('status',1)->get(),
            'governorates' => $this->countryId ? Government::where('country_id', $this->countryId)->where('status',1)->get() : [],
            'cities'       => $this->governorateId ? City::where('government_id', $this->governorateId)->get() : [],
        ]);
    }
}
