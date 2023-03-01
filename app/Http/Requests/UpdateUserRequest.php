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
            'first_name.required' => 'Поле "имя" обязательно для заполнения',
            'last_name.required' => 'Поле "фамилия" обязательно для заполнения',
            'email.required' => 'Поле "почта" обязательно для заполнения',
            'email.unique' => 'Такая почта уже зарегестрирована',
            'email.email' => 'Неверный формат почты, проверьте ещё раз',
            'login.required' => 'Поле "логин" обязательно для заполнения',
            'login.unique' => 'Такой логин уже занят',
            'login.regex' => 'Логин должен состоять только из латиницы',
            'password.required' => 'Поле "пароль" обязательно для заполнения',
            'password.min' => 'Поле пароль должно состоять миниум из 6 символов',
            'password_confirmation.required' => 'Поле "подтвержение пароля" обязательно для заполнения',
            'occupation_id.required' => 'Поле "занятость" обязательно для заполнения',
            'occupation_id.min' => 'Выберанная занятость не верная.',
            'vk_url.url' => 'Это должно быть ссылкой типа "https://vk.com/id111111111"',
            'tg_name.unique' => 'Такой username уже занят',
        ];
    }
}
