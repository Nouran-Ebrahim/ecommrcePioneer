<?php

namespace App\Services\Dashboard;

use Nette\Utils\Image;
use App\Utils\ImageManger;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Dashboard\SliderRepository;

class SliderService
{

    protected $sliderRepository, $imageManger;

    public function __construct(SliderRepository $sliderRepository, ImageManger $imageManger)
    {
        $this->sliderRepository = $sliderRepository;
        $this->imageManger = $imageManger;
    }
    public function getSliders() // new
    {
        return $this->sliderRepository->getSliders();
    }

    public function getSlidersForDatatables()
    {

        $Sliders = $this->sliderRepository->getSliders();
        return DataTables::of($Sliders)
            ->addIndexColumn()

            ->addColumn('note', function ($Slider) {
                return $Slider->getTranslation('note', app()->getLocale());
            })
            ->addColumn('file_name', function ($slider) {
                return view('dashboard.sliders.datatables.logo', compact('slider'));
            })

            ->addColumn('action', function ($slider) {
                return view('dashboard.sliders.datatables.actions', compact('slider'));
            })
            ->rawColumns(['action', 'file_name']) // for render html content
            ->make(true);
    }
    public function getSlider($id)
    {
        $Slider = $this->sliderRepository->getSlider($id);
        if (!$Slider) {
            abort(404);
        }
        return $Slider;
    }
    public function createSlider($data)
    {
        if (array_key_exists('file_name', $data) && $data['file_name'] != null) {
            $file_name = $this->imageManger->uploadSingleImage('/', $data['file_name'], 'sliders');
            $data['file_name'] = $file_name;
        }

        // dd($data);
        return $this->sliderRepository->createSlider($data);
    }


    // public function updateSlider($id, $data)
    // {
    //     $Slider = $this->getSlider($id);
    //     // dd($data);
    //     if (array_key_exists('logo', $data) && $data['logo'] != null) {
    //         // delete old logo
    //         $this->imageManger->deleteImageFromLocal($Slider->logo);

    //         $file_name = $this->imageManger->uploadSingleImage('/', $data['logo'], 'Sliders');
    //         $data['logo'] = $file_name;
    //     }

    //     return $this->sliderRepository->updateSlider($Slider, $data);
    // }
    public function deleteSlider($id)
    {
        $Slider = $this->getSlider($id);
        if (!$Slider) {
            return false;
        }
        // ckeck if has logo?
        if ($Slider->file_name != null) {
            $this->imageManger->deleteImageFromLocal($Slider->file_name);
        }

        $Slider = $this->sliderRepository->deleteSlider($Slider);

        return $Slider;
    }


}
