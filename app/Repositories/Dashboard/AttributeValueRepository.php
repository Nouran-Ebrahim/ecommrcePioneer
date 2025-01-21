<?php

namespace App\Repositories\Dashboard;

use App\Models\AttributeValue;

class AttributeValueRepository
{
    public function createAttributeValues($attribute, $value)
    {
        $attribute = $attribute->attributeValues()->create([
            'value' => $value
        ]);
        return $attribute;
    }
    public function updateAttributeValues($attribute, $data)
    {
        return $attribute->update($data);
    }
    public function deleteAttributeValues($attribute_obj)
    {
        return $attribute_obj->attributeValues()->delete();
    }

}
