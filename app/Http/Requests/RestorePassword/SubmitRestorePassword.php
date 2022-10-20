<?php

namespace App\Http\Requests\RestorePassword;

use Illuminate\Foundation\Http\FormRequest;

class SubmitRestorePassword extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
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
            'password_confirmation.required' => 'Поле повтор пароля.',
        ];
    }
}
