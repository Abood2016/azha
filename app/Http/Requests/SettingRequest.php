<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'url_facebook' => 'string',
            'url_instagram' => 'string',
            'url_twitter' => 'string',
            'about_us' => 'string',
            'privacy' => 'string',
            'terms' => 'string',
            'color' => ['regex:/^(#[0-9a-fA-F]{6})$/']
        ];
    }
}
