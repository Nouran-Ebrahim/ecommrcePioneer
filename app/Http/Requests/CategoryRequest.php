<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CodeZero\UniqueTranslation\UniqueTranslationRule;

class CategoryRequest extends FormRequest
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
    public function rules(): array
    {
        $rules = [
            'name.*' => ['required', 'string', 'max:100', UniqueTranslationRule::for('categories')->ignore($this->id)],
            'status' => ['required', 'in:1,0'],
            'parent' => ['nullable', 'exists:categories,id']
        ];
        if ($this->method() == 'PUT') {
            $rules['icon'] = ['nullable', 'max:2048'];
        } else {
            $rules['icon'] = ['required', 'max:2048'];
        }
        return $rules;
    }
}
