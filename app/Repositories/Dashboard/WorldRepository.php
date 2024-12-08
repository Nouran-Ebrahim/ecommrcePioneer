<?php

namespace App\Repositories\Dashboard;

use App\Models\Country;
use App\Models\Government;

class WorldRepository
{
    public function getCountryById($id)
    {
        $country = Country::find($id);
        return $country;
    }
    public function getGovernorateById($id)
    {
        $governorate = Government::find($id);
        return $governorate;
    }
    public function getAllCountries()
    {
        $countries = Country::withCount(['govrnorates', 'users'])->when(!empty(request()->keyword), function ($query) {
            $query->where('name', 'like', '%' . request()->keyword . '%');
        })->paginate(5);

        return $countries;
    }
    public function getAllgovernorates($country)
    {
        $governorates = $country->govrnorates()
            ->with(['country', 'shippingPrice'])
            ->withCount(['cities', 'users'])
            ->when(!empty(request()->keyword), function ($query) {
                $query->where('name', 'like', '%' . request()->keyword . '%');
            })
            ->paginate(5);
        return $governorates;
    }
    public function getAllCities($governorate)
    {
        $cities = $governorate->cities;
        return $cities;
    }

    public function changeStatus($model)
    {
        $model = $model->update([
            'status' => $model->status == 1 ? 0 : 1,
        ]);

        return $model; //return true or false in update

    }

    public function changeShippingPrice($governorate, $price)
    {
        return $governorate->shippingPrice->update([
            'price' => $price,
        ]);
    }
}
