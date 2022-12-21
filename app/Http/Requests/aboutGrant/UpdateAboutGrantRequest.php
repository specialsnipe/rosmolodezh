<?php

namespace App\Http\Requests\aboutGrant;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutGrantRequest extends FormRequest
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
            'description' => ['required',],
        ];
    }
    public function messages()
    {
        return [
            'description.required' => 'Поле обязательно для заполнения.',
            'title.required' => 'Поле обязательно для заполнения.',
        ];
    }
}
