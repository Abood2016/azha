<?php

namespace App\Http\Requests;

use App\Traits\UserIdFromRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DriverRequest extends FormRequest
{

    use UserIdFromRequest;

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
            'licence_number'              => 'required|string',
            'licence_expire_date'         => 'required',
            'vehicle_brand'               => 'required|string',
            'vehicle_model'               => 'required|string',
            'vehicle_name'                => 'required|string',
            'vehicle_color'               => 'required|string',
            'vehicle_registration_number' => 'required|string',
            'vehicle_purchase_year'       => 'required|date_format:Y',
        ];
    }
}
