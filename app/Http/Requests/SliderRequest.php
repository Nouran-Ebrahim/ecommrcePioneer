<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class SliderRequest extends FormRequest
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
        $rules = [
            'note.*' => ['required', 'string', 'min:25', 'max:35', UniqueTranslationRule::for('sliders')->ignore($this->id)],
            // 'status'=>['required','in:0,1'],
        ];

        if ($this->method() == 'PUT') {
            $rules['file_name'] = ['nullable', 'max:2048', 'mimes:png,jpg,gif,svg,jpeg'];
        } else {
            $rules['file_name'] = ['required', 'max:2048', 'mimes:png,jpg,gif,svg,jpeg'];
        }


        return $rules;

    }
}
