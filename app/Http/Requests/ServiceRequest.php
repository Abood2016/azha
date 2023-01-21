<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'name'         => ['required', 'string'],
            'base_fare'    => ['required', 'numeric'],
            'minimum_fare' => ['required', 'numeric'],
            'per_minute'   => ['required', 'numeric'],
            'per_km'       => ['required', 'numeric'],
            'commission'       => ['required', 'numeric']
        ];
    }
}
