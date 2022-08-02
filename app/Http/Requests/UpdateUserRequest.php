<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'father_name' => 'required',
            'gender_id' => ['required', 'min:1'],
            'email' => ['required',  'unique:users,email,'.$this->user->id, 'email:dns'],
            'occupation_id' => ['required', 'min:1'],
            'age' => ['nullable','numeric'],
            'file'=>['nullable','image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'tg_name' => '',
            'vk_url' => ['nullable', 'url'],
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'Поле имя обязательно.',
            'last_name.required' => 'Поле фамилия обязательно.',
            'father_name.required' => 'Поле отчество обязательно.',
            'gender_id.required' => 'Выберите пол.',
            'gender_id.min' => 'Выберанный пол не верный.',
            'email.required' => 'Выберите ваш пол.',
            'email.unique' => 'Такая почта уже зарегестрирована.',
            'email.email' => 'Неверный формат почты, проверьте ещё раз.',
            'login.required' => 'Выберите ваш логин.',
            'login.unique' => 'Такой логин уже занят.',
            'login.regex' => 'Логин должен состоять только из латиницы.',
            'password.required' => 'Поле пароль обязательно.',
            'password.min' => 'Поле пароль должно состоять миниум из 6 символов.',
            'password_confirmation.required' => 'Поле подтвержение пароля обязательно.',
            'occupation_id.required' => 'Выберите занятость.',
            'occupation_id.min' => 'Выберанная занятость не верная.',
            'vk_url.url' => 'Это должно быть ссылкой',
        ];
    }
}