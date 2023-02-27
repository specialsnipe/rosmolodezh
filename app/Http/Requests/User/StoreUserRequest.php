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
            'email' => ['required', 'unique:users', 'email:dns'],
            'login' => ['required', 'unique:users'],
            'password' => ['required', 'min:6'],
            'occupation_id' => ['required', 'min:1'],
            'role_id' => ['required', 'min:1'],
            'track_id' => ['required', 'min:1'],
            'age' => ['numeric', 'min:0'],
            'file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'tg_name' => 'nullable',
            'vk_url' => ['nullable', 'url'],
            'phone' => ['required', 'min:17'],
        ];
    }

    public function messages()
    {
        return [
            'age.min'=>'Возраст не может быть отрицательным',
            'first_name.required' => 'Поле имя обязательно.',
            'last_name.required' => 'Поле фамилия обязательно.',
            'gender_id.required' => 'Выберите пол.',
            'track_id.required' => 'Выберите направление.',
            'gender_id.min' => 'Выбранный пол неверный.',
            'email.required' => 'Введите почту.',
            'email.unique' => 'Такая почта уже зарегистрирована.',
            'email.email' => 'Неверный формат почты, проверьте ещё раз.',
            'login.required' => 'Поле "логин" обязательно для заполнения',
            'login.unique' => 'Такой логин уже занят.',
            'login.regex' => 'Логин должен состоять только из латиницы.',
            'password.required' => 'Поле "пароль" обязательно для заполнения.',
            'password.min' => 'Поле пароль должно состоять миниум из 6 символов',
            'password_confirmation.required' => 'Поле "подтвержение пароля" обязательно для заполнения',
            'occupation_id.required' => 'Поле "занятость" обязательно для заполнения',
            'occupation_id.min' => 'Выберанная занятость не верная.',
            'role_id.required' => 'Поле "роль" обязательно для заполнения',
            'role_id.min' => 'Выберанная роль не верная.',
            'phone.required' => 'Поле "номер телефона" обязательно',
            'phone.min:17' => 'Не правильно ввели номер телефона',
            'file.required' => 'Загрузите картинку',
            'file.image' => 'Файл должен быть картинкой',
            'file.mimes:jpg,jpeg,png' => 'Неверный формат картинки, возможные: jpg,jpeg,png',
            'file.max:2048' => 'Слишком большой файл, максимум 2мб',
            //'track_id.required' => 'Поле направление обязательно.',
            //'track_id.min' => 'Выберанное направление не верное.',
        ];
    }
}
