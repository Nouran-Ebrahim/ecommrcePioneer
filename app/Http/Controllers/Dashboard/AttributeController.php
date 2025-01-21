<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\AttributeValue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AttributeRequest;
use App\Services\Dashboard\AttributeService;
class AttributeController extends Controller
{

    protected $attributeService;
    public function __construct(AttributeService $attributeService)
    {
        $this->attributeService = $attributeService;
    }

    public function index()
    {
        $lastAttributeValueId = AttributeValue::latest('id')->value('id');
        // dd($lastAttributeValueId);
        return view('dashboard.attributes.index',compact('lastAttributeValueId'));
    }

    public function getAll()
    {
        return $this->attributeService->getAttributesForDatatables();
    }
    public function create()
    {
        return view('dashboard.attributes.create');
    }

    public function store(AttributeRequest $request)
    {

        $data = $request->except(['_token']);
        $attribute = $this->attributeService->createAttribute($data);

        if (!$attribute) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.general_error'),
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('messages.added_successfully'),
        ], 201);
    }

    public function edit(string $id)
    {
        $attribute = $this->attributeService->getAttribute($id);
        return view('dashboard.attributes.edit', compact('coupon'));

    }
    public function update(AttributeRequest $request, string $id)
    {
        // dd($request->all());
        $data = $request->except(['_token']);
        $attribute = $this->attributeService->updateAttribute($id, $data);
        if (!$attribute) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.general_error'),
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('messages.updateed_successfully')
        ], 201);

    }

    public function destroy(string $id)
    {
        if (!$this->attributeService->deleteAttribute($id)) {
            return response()->json([
                'status' => 'error',
                'message' => __('messages.general_error'),
            ], 500);
        }
        return response()->json([
            'status' => 'success',
            'message' => __('messages.deleted_successfully')
        ], 201);

    }


}
