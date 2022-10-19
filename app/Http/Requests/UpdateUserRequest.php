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
            'login' => ['required',  'unique:users,login,'. auth()->user()->id],
            'last_name' => 'required',
            'father_name' => '',
            'gender_id' => ['required', 'min:1'],
            'email' => ['required',  'unique:users,email,'. auth()->user()->id, 'email:dns'],
            'phone'=> ['required', 'min:17'],
            'occupation_id' => ['required', 'min:1'],
            'age' => ['nullable','numeric'],
            'tg_name' => ['nullable', 'unique:users,tg_name,' . auth()->user()->id],
            'vk_url' => ['nullable', 'url'],
            'curator_job'=> 'nullable',
            'curator_about'=> 'nullable'
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'Поле имя обязательно.',
            'father_name.required' => 'Поле отчество обязательно.',
            'last_name.required' => 'Поле фамилия обязательно.',
            'gender_id.required' => 'Выберите пол.',
            'gender_id.min' => 'Выберанный пол не верный.',
            'email.required' => 'Почта обязательна.',
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
            'track_id.required' => 'Обязательно выберите траекторию.',
            'track_id.min' => 'Обязательно выберите траекторию.',
            'vk_url.url' => 'Это должно быть ссылкой',
            'tg_name.unique' => 'Такой username уже занят',
        ];
    }
}
