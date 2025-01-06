<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use Illuminate\Support\Facades\Session;
use App\Services\Dashboard\SettingService;

class SettingController extends Controller
{
    protected $settingService;
    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index()
    {
        return view('dashboard.settings.index');
    }
    public function update(SettingRequest $request, $id)
    {
        $data = $request->except(['_token', '_method']);
        $setting = $this->settingService->updateSetting($data, $id);
        if (!$setting) {
            Session::flash('erorr', __('messages.general_error'));
            return redirect()->back();
        }
        Session::flash('success', __('messages.updateed_successfully'));
        return redirect()->back();

    }

}
