<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecruiterRequest extends FormRequest
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
//            'user_id' => ['required'],
//            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
//            'email' => ['required', 'email', 'unique:users,email'],
//            'phone' => ['required'],
//            'password'=> ['required','confirmed'],
//            'password_confirmation' => ['required'],
        ];
    }
}
