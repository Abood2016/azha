<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminOrderRequest extends FormRequest
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
            'driver_id' => 'required|exists:drivers,id',
            'type_id' => 'required|exists:types,id',

            'place' => 'required_without_all:pickup_location,pickup_location_id',//from google map pickup state 1
            'pickup_location_id' => 'required_without_all:place,pickup_location|exists:locations,id', // pick_up state 2 location from database
            'pickup_location' => 'required_without_all:place,pickup_location_id',// pick_up state 3 //coordinates

            'drop_location_id' => 'required_without:drop_location|exists:locations,id', // drop state 1 location from database
            'drop_location' => 'required_without:drop_location_id', // drop state 2 //coordinates
            'delivery_notes' => 'required|string',
        ];
    }
}
