<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentStoreRequest extends FormRequest
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
            'title' => 'required|max:255',
            'description' => 'required',
            'country' => 'required',
            'rooms' => 'required|integer|min:0',
            'price_per_night' => 'required|numeric|min:0',
            'image_housing' => 'required|array|min:1',
            'image_housing.*' => 'image|mimes:jpg,png|max:2048'
        ];
    }
}
