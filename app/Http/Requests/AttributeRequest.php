<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class AttributeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // protected $stopOnFirstFailure = true; // to show first error only
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    // values=[
    //     '0'=>[
    //         'ar'=>'',
    //         'en'=>''
    //     ],
    // ]
    public function rules()
    {
        return [
            'name.*' => ['required', 'string', 'max:100', UniqueTranslationRule::for('attributes')->ignore($this->id)],
            'values.*.*' => ['required', 'string', 'max:100'],//array inside array
        ];

    }
}
