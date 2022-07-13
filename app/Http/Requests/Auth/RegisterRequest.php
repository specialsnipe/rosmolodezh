<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
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
            'login' => ['required', 'unique:users', 'regex:/^[a-z0-9]+$/i'],
            'password' => ['required', 'confirmed', 'min:6'],
            'password_confirmation' => 'required',
            'occupation_id' => ['required', 'min:1'],
            'track_id' => ['required', 'min:1'],
            'allowed' => ['required', 'in:true,1,on']
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'Поле имя обязательно.',
            'last_name.required' => 'Поле фамилия обязательно.',
            'gender_id.required' => 'Выберите ваш пол.',
            'gender_id.min' => 'Выберанный пол не верный.',
            'email.required' => 'Выберите ваш пол.',
            'email.unique' => 'Такая почта уже зарегестрирована.',
            'email.email' => 'Неверный формат почты, проверьте ещё раз.',
            'login.required' => 'Выберите ваш логин.',
            'login.unique' => 'Такой логин уже занят.',
            'login.regex' => 'Логин должен состоять только из латиницы.',
            'password.required' => 'Поле пароль обязательно.',
            'password.confirmed' => 'Пароль и подтвержение пароля не совпадают.',
            'password.min' => 'Поле пароль должно состоять миниум из 6 символов.',
            'password_confirmation.required' => 'Поле подтвержение пароля обязательно.',
            'occupation_id.required' => 'Поле занятость обязательно.',
            'occupation_id.min' => 'Выберанная занятость не верная.',
            'track_id.required' => 'Поле направление обязательно.',
            'track_id.min' => 'Выберанное направление не верное.',
            'allowed.required' => 'Вы должны согласиться с условиями.',
            'allowed.in' => 'Вы должны согласиться с условиями.',
        ];
    }
}
