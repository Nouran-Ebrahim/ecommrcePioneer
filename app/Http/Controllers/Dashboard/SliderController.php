<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\SliderRequest;
use App\Services\Dashboard\SliderService;
class SliderController extends Controller
{
    protected $SliderService;
    public function __construct(SliderService $SliderService)
    {
        $this->SliderService = $SliderService;
    }

    public function index()
    {
        return view('dashboard.sliders.index');
    }

    public function getAll()
    {
        return $this->SliderService->getSlidersForDatatables();
    }
    public function create()
    {
        return view('dashboard.sliders.create');
    }

    public function store(SliderRequest $request)
    {
        // dd($request->all());
        $data = $request->only(['note','file_name']);
        $Slider = $this->SliderService->createSlider($data);

        if (!$Slider) {
            Session::flash('erorr', __('messages.general_error'));
            return redirect()->back();
        }
        Session::flash('success', __('messages.added_successfully'));
        return redirect()->back();

    }

    public function edit(string $id)
    {
        $Slider = $this->SliderService->getSlider($id);
        return view('dashboard.sliders.edit', compact('Slider'));

    }
    // public function update(SliderRequest $request, string $id)
    // {
    //     $data = $request->only(['name', 'status', 'logo']);
    //     // dd($data);
    //     $Slider = $this->SliderService->updateSlider($id, $data);
    //     if (!$Slider) {
    //         Session::flash('erorr', __('messages.general_error'));
    //         return redirect()->back();
    //     }
    //     Session::flash('success', __('messages.updateed_successfully'));
    //     return redirect()->back();
    // }

    public function destroy(string $id)
    {
        if (!$this->SliderService->deleteSlider($id)) {
            Session::flash('erorr', __('messages.general_error'));
            return redirect()->back();
        }
        Session::flash('success', __('messages.deleted_successfully'));
        return redirect()->back();
    }



}
