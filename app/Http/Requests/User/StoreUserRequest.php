<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'father_name' => '',
            'gender_id' => ['required', 'min:1'],
            'email' => ['required', 'unique:users', 'email:dns'],
            'login' => ['required', 'unique:users'],
            'password' => ['required', 'confirmed'],
            'password_confirmation' => '',
            'occupation_id' => ['required', 'min:1'],
            'track_id' => ['required', 'min:1'],
            'allowed' => ['required', 'in:true,1,on']
        ];
    }
    public function messages()
    {
        return [

        ];
    }
}
