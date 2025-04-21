<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules =  [
            'title.*'=>['required','string','min:2','max:100'],
            'content.*'=>['required','string','min:3','max:100000'],
            'image'=>['nullable','image','mimes:png,jpg,gif.jpeg,svg,webp','max:2048']
        ];

        return $rules;

    }
}
