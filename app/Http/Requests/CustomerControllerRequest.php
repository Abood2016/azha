<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerControllerRequest extends FormRequest
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
            'customer_id' => 'required|exists:customers,id',
            'display_name' => ['string'],
            'location' => ['required'],
            'location_name' => ['required'],
            'location_coordinates' => ['required'],
            'location_coordinates_lat' => ['required'],
            'location_coordinates_lng' => ['required'],
        ];
    }
}
