<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'login' => ['required','exists:users', /*, 'regex:/^[a-z0-9]+$/i' */],
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'login.required' => 'Укажите ваш логин для входа в аккаунт.',
            'login.exists' => 'Пользователя с таким логином не существует.',
            'login.regex' => 'Логин должен состоять только из латиницы.',
            'password.required' => 'Укажите пароль для входа в аккаунт.',
        ];
    }
}
