<?php

namespace App\Http\Requests\User;

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
        return auth()->check() && auth()->user()->role->name == 'admin';
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
            'father_name' => 'nullable',
            'gender_id' => ['required', 'min:1'],
            'email' => ['required',  'unique:users,email,'.$this->user, 'email:dns'],
            'occupation_id' => ['required', 'min:1'],
            'role_id' => ['required', 'min:1'],
            'age' => ['nullable','numeric'],
            'file'=>['nullable','image', 'mimes:jpg,jpeg,png,webp,webp', 'max:2048'],
            'tg_name' => '',
            'vk_url' => ['nullable', 'url'],
            'curator_job' => ['nullable'],
            'curator_about' => ['nullable'],
            'phone' => ['required', 'min:17'],
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'Поле "имя" обязательно для заполнения',
            'last_name.required' => 'Поле "фамилия" обязательно для заполнения',
            'email.required' => 'Поле "почта" обязательнв для заполнения',
            'email.unique' => 'Такая почта уже зарегестрирована',
            'email.email' => 'Неверный формат почты, проверьте ещё раз',
            'login.required' => 'Поле "логин" обязательно для заполнения',
            'login.unique' => 'Такой логин уже занят',
            'login.regex' => 'Логин должен состоять только из латиницы',
            'password.required' => 'Поле "пароль" обязательно для заполнения',
            'password.min' => 'Поле пароль должно состоять миниум из 6 символов.',
            'password_confirmation.required' => 'Поле подтвержение пароля обязательно.',
            'occupation_id.required' => 'Выберите занятость.',
            'occupation_id.min' => 'Выберанная занятость не верная.',
            'role_id.required' => 'Поле "роль" обязательно для заполнения',
            'role_id.min' => 'Выберанная роль неверная.',
            'vk_url.url' => 'Это должно быть ссылкой',
            'phone.required' => 'Поле "номер телефона" обязательно для заполнения',
            'phone.min:17' => 'Не правильно ввели номер телефона',
        ];
    }
}
