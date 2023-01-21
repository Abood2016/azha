<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'pickup_location_id' => 'required_without:pickup_location',
            'pickup_location' => 'required_without:pickup_location_id',
            'drop_location_id' => 'required_without:drop_location|exists:locations,id',
            'drop_location' => 'required_without:drop_location_id',
            'delivery_notes' => 'required|string',
        ];
    }
}
