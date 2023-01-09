<?php

namespace App\Http\Requests\about;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAboutRequest extends FormRequest
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
            'footer_title' => ['required',],
            'footer_description' => ['required'],
            'company_name' => ['required'],
            'company_desc' => ['required'],
            'company_advantages_title' => ['required'],
            'company_grant_image' => [ 'image'],
            'company_advantages_image' => ['image'],
            'company_image' => ['image'],
        ];
    }
    public function messages()
    {
        return [
            'footer_title.required' => 'Поле "Заголовок" обязательно для заполнения.',
            'footer_description.required' => 'Поле "Заголовок" обязательно для заполнения.',
            'company_name.required' => 'Поле "Заголовок" обязательно для заполнения.',
            'company_desc.required' => 'Поле "Заголовок" обязательно для заполнения.',
            'company_image.required' => 'Поле "Заголовок" обязательно для заполнения.',
            'company_advantages_image.required' => 'Поле "Заголовок" обязательно для заполнения.',
            'company_advantages_title.required' => 'Поле "Заголовок" обязательно для заполнения.',
            'company_grant_image.required' => 'Поле "Заголовок" обязательно для заполнения.'
        ];
    }
}
