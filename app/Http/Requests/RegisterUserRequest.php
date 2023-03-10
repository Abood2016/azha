<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|min:6',
            'fcm_token' => 'required',
            'image' => ['required','mimes:jpeg,jpg,png,gif|max:10000'],
        ];
    }

    public function messages()
    {
        return [
            'phone.unique' => 'The email has already been taken.'
        ];
    }
}
