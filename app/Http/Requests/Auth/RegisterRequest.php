<?php

namespace App\Http\Requests\Auth;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    protected $redirectRoute = "auth.register";
    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'father_name' => '',
            'email' => ['required', 'unique:users', 'email:dns', 'max:191'],
            'login' => ['required', 'unique:users', 'regex:/^[a-z0-9]+$/i'],
            'password' => ['required', 'confirmed', 'min:6'],
            'password_confirmation' => 'required',
            'occupation_id' => ['required', 'min:1'],
            'track_id' => ['required', 'min:1'],
            'allowed' => ['required',  'in:true,1,on'],
            'phone' => ['required', 'min:17']
        ];
    }
    public function messages()
    {
        return [
            'first_name.required' => 'Поле "имя" обязательно для заполнения',
            'last_name.required' => 'Поле "фамилия" обязательно для заполнения',
            'email.required' => 'Поле "почта" обязательно для заполнения',
            'email.unique' => 'Такая почта уже зарегистрирована',
            'email.email' => 'Неверный формат почты, проверьте ещё раз',
            'email.max' => 'Почта не должна быть длиннее 191 символа',
            'login.required' => 'Поле "логин" обязательно для заполнения',
            'login.unique' => 'Выбранный вами логин уже занят',
            'login.regex' => 'Логин должен состоять только из латиницы',
            'password.required' => 'Поле "пароль" обязательно для заполнения',
            'password.confirmed' => 'Пароль и подтвержение пароля не совпадают',
            'password.min' => 'Поле пароль должно состоять миниум из 6 символов',
            'password_confirmation.required' => 'Поле "подтвержение пароля" обязательно для заполнения',
            'occupation_id.required' => 'Поле "занятость" обязательно для заполнения',
            'occupation_id.min' => 'Выберанная занятость неверная',
            'track_id.required' => 'Поле "направление" обязательно для заполнения',
            'track_id.min' => 'Выберанное направление неверное',
            'allowed.required' => 'Вы должны согласиться с условиями',
            'allowed.in' => 'Вы должны согласиться с условиями',
            'phone.required' => 'Поле "номер телефона" обязателен для заполнения',
            'phone.min' => 'Вы недописали номер.',
        ];
    }

//    public function failedValidation(Validator $validator) {
//        session()
//            ->flash('error', 'Вы допустили ошибки при регистрации.');
//        return redirect()
//            ->route('auth.register')
//            ->withErrors($this->validator)
//            ->withInput(Request::except('_token'));
//    }
}
