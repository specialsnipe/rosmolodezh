<?php

namespace App\Http\Requests\aboutAdvantage;

use Illuminate\Foundation\Http\FormRequest;

class StoreAboutAdvantageRequest extends FormRequest
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
            'description' => ['required',],
        ];
    }
    public function messages()
    {
        return [
            'description.required' => 'Поле "Заголовок" обязательно для заполнения.',
        ];
    }
}
