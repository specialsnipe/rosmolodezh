<?php

namespace App\Http\Requests\Answer;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'title' => ['required'],
            'body' => ['required'],
            'file' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле обязательно для заполнениея',
            'body.required' => 'Поле обязательно для заполнениея',
            'file.required' => 'Поле обязательно для заполнениея',
        ];
    }
}
