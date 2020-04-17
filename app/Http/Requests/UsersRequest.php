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

        $user = \Request::segments();
        $id = '';
//
        if (count($user)>2)
        {
            $id = $user[2];
        }


        return [
            'name' =>'required',
            'email' => 'required|unique:users,email,'.$id,
            'password' =>count($user)>2 ? '' :'required',
            'role_id' =>'required',
            'photo_id' =>count($user)>2?'':'required|image'


            ];
    }


    public function messages()
    {
        return [
            'name.required' => 'Name Field Is Required',
            'email.required' =>'Email Required',
            'email.email' =>'Please Enter Valid Email Format',
            'role_id.required' => 'Role Required',
            'photo_id.required' =>'Photo Required',
            'photo_id.image' =>'Only Images Allowed',
        ];
    }
}
