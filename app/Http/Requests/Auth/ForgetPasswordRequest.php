<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ForgetPasswordRequest extends FormRequest
{
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
            'email' => ['required', 'email:dns','exists:users'],
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Вы не указали имя почты.',
            'email.exists' => 'Такая почта не зарегестрирована.',
            'email.email' => 'Неверный формат почты, проверьте ещё раз.',
        ];
    }
}
