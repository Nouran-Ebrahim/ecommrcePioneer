<?php

namespace App\Services\Dashboard;
use App\Repositories\Dashboard\AttributeValueRepository;
use App\Utils\ImageManger;
use DB;
use Illuminate\Support\Facades\Cache;
use Log;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Dashboard\AttributeRepository;
class AttributeService
{
    protected $attributeRepository, $imageManger, $attributeValueRepository;

    public function __construct(AttributeRepository $attributeRepository, ImageManger $imageManger, AttributeValueRepository $attributeValueRepository)
    {
        $this->attributeRepository = $attributeRepository;
        $this->imageManger = $imageManger;
        $this->attributeValueRepository = $attributeValueRepository;
    }
    public function getAttribute($id)
    {
        $attribute = $this->attributeRepository->getAttribute($id);

        return $attribute ?? abort(404, 'Attribute not found');
    }
    public function getAttributesForDatatables()
    {

        $attributes = $this->getAttributes();
        // dd($attributes);
        return DataTables::of($attributes)
            ->addIndexColumn()

            ->addColumn('name', function ($attribute) {
                return $attribute->getTranslation('name', app()->getLocale());
            })
            ->addColumn('action', function ($attribute) {
                return view('dashboard.attributes.datatables.actions', compact('attribute'));
            })
            ->addColumn('attributeValues', function ($attribute) {
                return view('dashboard.attributes.datatables.arrtibute-values', compact('attribute'));
            })
            ->rawColumns(['action', 'attributeValues']) // for render html content
            ->make(true);
    }

    public function createAttribute($data)
    {
        try {
            DB::beginTransaction();
            $attribute = $this->attributeRepository->createAttribute($data);
            foreach ($data['values'] as $value) {
                $this->attributeValueRepository->createAttributeValues($attribute, $value);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating attribute: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return false;

        }

    }


    public function updateAttribute($id, $data)
    {
        try {
            $attribute_obj = $this->getAttribute($id);

            DB::beginTransaction();
            $this->attributeRepository->updateAttribute($attribute_obj, $data);

            $this->attributeValueRepository->deleteAttributeValues($attribute_obj);
            foreach ($data['values'] as $value) {
                $this->attributeValueRepository->createAttributeValues($attribute_obj, $value);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            // Log::error('Error creating attribute: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return false;
        }
    }
    public function deleteAttribute($id)
    {
        $attribute = $this->getAttribute($id);

        $attribute = $this->attributeRepository->deleteAttribute($attribute);
        return $attribute;
    }
    public function getAttributes() // new
    {
        return $this->attributeRepository->getAttributes();
    }

}
