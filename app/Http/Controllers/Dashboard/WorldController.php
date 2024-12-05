<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\shippingPriceRequest;
use Illuminate\Support\Facades\Session;
use App\Services\Dashboard\WorldService;
class WorldController extends Controller
{
    protected $worldService;
    public function __construct(WorldService $worldService)
    {
        $this->worldService = $worldService;
    }


    public function getAllCountries()
    {
        $countries = $this->worldService->getAllCountries();
        return view('dashboard.world.countries', compact('countries'));
    }

    public function getGovByCountryId($id)
    {
        $governorates = $this->worldService->getAllGovernorates($id);
        return view('dashboard.world.governorates', compact('governorates'));
    }

    public function getCitiesByGovId($id)
    {
        $cities = $this->worldService->getAllCities($id);
        return view('dashboard.world.cities', compact('cities'));
    }



    public function changeStatus($country_id)
    {
        $country = $this->worldService->changeStatus($country_id);
        if (!$country) {
            return response()->json([
                'status' => false,
                'message' => __('messages.general_error')
            ], 404);
        }
        $country = $this->worldService->getCountryById($country_id);
        return response()->json([
            'status' => 'success',
            'message' => __('messages.updateed_successfully'),
            'data' => $country
        ], 200);
    }


    public function changeGovStatus($gov_id)
    {
        // dd($gov_id);
        $gov = $this->worldService->changeGovStatus($gov_id);
        if (!$gov) {
            return response()->json([
                'status' => false,
                'message' => __('messages.general_error')
            ], 404);
        }
        $gov = $this->worldService->getGovernorateById($gov_id);
        return response()->json([
            'status' => 'success',
            'message' => __('messages.updateed_successfully'),
            'data' => $gov
        ], 200);
    }

    public function changeShippingPrice(shippingPriceRequest $request)
    {
        if (!$this->worldService->changeShippingPrice($request)) {
            return response()->json([
                'status' => false,
                'message' => __('messages.general_error')
            ], 404);
        }

        $gov = $this->worldService->getGovernorateById($request->gov_id);

        $gov->load('shippingPrice');
        return response()->json([
            'status' => 'success',
            'message' => __('messages.updateed_successfully'),
            'data' => $gov
        ], 200);
    }
}
