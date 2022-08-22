<?php

namespace App\Http\Requests\Phrase;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhraseRequest extends FormRequest
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
            'body' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'body.required' => 'Поле обязательно для заполнения'
        ];
    }
}
