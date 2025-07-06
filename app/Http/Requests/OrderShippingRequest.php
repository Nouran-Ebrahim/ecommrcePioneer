<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderShippingRequest extends FormRequest
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
        return [
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'user_email'=>'required|email',
            'user_phone'=>'required|string',
            'country_id'=>'required|exists:countries,id',
            'government_id'=>'required|exists:governments,id',
            'city_id'=>'required|exists:cities,id',
            'street'=>'required|string',
            'note'=>'nullable|string',
            // 'payment_method'=>'required|string'
        ];
    }
}
