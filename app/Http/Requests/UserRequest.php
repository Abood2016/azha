<?php

namespace App\Http\Requests;

use App\Rules\Phone;
use App\Traits\UserIdFromRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'phone' => ['required',  Rule::unique('users')->ignore($this->getUser())],
            'email' => ['nullable', 'email', Rule::unique('users')->ignore($this->getUser())],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'is_new' => ['nullable'],
        ];
    }
}
