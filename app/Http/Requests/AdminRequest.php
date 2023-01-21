<?php

namespace App\Http\Requests;

use App\Actions\App\CreateValidPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
        $arr = [
            'name'                        => ['required', 'string'],
            'photo'                       => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'role_id'                 => ['required'],

        ];
        if(request()->route('admin')){
            $arr += [ 'email'  => ['required', 'email', 'unique:users,email,'.request()->route('admin')]];
        }else{
            $arr +=[ 'email' => ['required', 'email', 'unique:users,email']];
        }
        return $arr;
    }
}
