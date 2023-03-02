<?php

namespace App\Http\Requests\Information;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInformationRequest extends FormRequest
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
            'tg_url'=>['required', 'url'],
            'tg_description'=>['required', 'max:129'],
            'tg_bot_url'=>['required', 'url'],
            'tg_bot_description'=>['required', 'max:129'],
            'vk_url'=>['required', 'url'],
            'vk_description'=>['required', 'max:129'],
            'zen_url'=> '',
            'zen_description'=>['nullable', 'max:129'],
            'location' => ['required'],
            'location_description'=>['required', 'max:129'],
            'location_url'=>['required', 'url']
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'tg_url.required'=>'Ссылка в телеграм обязательна',
            'tg_url.url'=>'Это должна быть ссылка (начинается с http:// или https://)',
            'tg_description.required'=>'Заполните описание к телеграму',
            'tg_bot_url.required'=>'Ссылка на телеграм бота обязательна',
            'tg_bot_url.url'=>'Это должна быть ссылка (начинается с http:// или https://)',
            'tg_bot_description.required'=>'Заполните описание к телеграм боту',
            'vk_url.required'=>'Ссылка в вконтакте обязательна',
            'vk_url.url'=>'Это должна быть ссылка (начинается с http:// или https://)',
            'vk_description.required'=>'Заполните описание к вконтаке',
        ];
    }
}
