<?php

namespace App\Repositories\Dashboard;

use App\Models\Attribute;

class AttributeRepository
{
    public function getAttributes()
    {
       $attributes = Attribute::with('attributeValues')->latest()->get();
       return $attributes;
    }
    public function getAttribute($id)
    {
        $attribute = Attribute::find($id);
        return $attribute;
    }
    public function createAttribute($data)
    {
        $attribute = Attribute::create([
            'name' => $data['name'],
        ]);
        return $attribute;
    }
    public function updateAttribute($attribute, $data)
    {
        return $attribute->update([
            'name'=> $data['name'],
        ]);
    }
    public function deleteAttribute($attribute)
    {
       return $attribute->delete();
    }
}
