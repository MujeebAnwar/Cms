<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'name' =>'required',
            'email' => 'required|email|unique:users',
            'password' =>'required',
            'role' =>'required',
            'file' =>'required|image'


            ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Name Field Is Required',
            'email.required' =>'Email Required',
            'email.email' =>'Please Enter Valid Email Format'
        ];
    }
}
