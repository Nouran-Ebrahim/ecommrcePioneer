<?php

namespace App\Livewire\General;

use Livewire\Component;
use App\Models\City;
use App\Models\Country;
use App\Models\Government;
class AddressDropDownDependent extends Component
{
    public $countryId, $governorateId, $cityId;

    public function render()
    {
        return view('livewire.general.address-drop-down-dependent', [
            'countries' => Country::get(),
            'governorates' => $this->countryId ? Government::where('country_id', $this->countryId)->get() : [],
            'cities' => $this->governorateId ? City::where('government_id', $this->governorateId)->get() : [],
        ]);
    }
}
