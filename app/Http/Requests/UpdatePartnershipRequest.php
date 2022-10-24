<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartnershipRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role->name === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required',],
            'body' => ['required']
        ];
    }
    public function messages()
    {
        return [
            'title.required'=> 'Поле "Заголовок" обязательно для заполнения.',
            'body.required'=> 'Поле "Описание" обязательно для заполнения.',
        ];
    }
}
