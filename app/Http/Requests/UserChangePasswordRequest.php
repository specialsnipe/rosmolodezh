<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'old_password' => '',
            'password' => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Поле пароль обязательно.',
            'password.min' => 'Поле пароль должно состоять миниум из 6 символов.',
            'password.confirmed' => 'Пароли не совпадают.',
            'password_confirmation.required' => 'Поле повтор пароля обязательно.',
        ];
    }

}
