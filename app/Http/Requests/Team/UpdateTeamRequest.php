<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeamRequest extends FormRequest
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
            'name' => 'required',
            'tg_link' => 'nullable',
            'vk_link' => ['nullable', 'url'],
            'email' => ['nullable', 'email:dns'],
            'file' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'description' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Обязательно заполните имя',
            'vk_link.url' => 'Это должна быть ссылка',
            'email.email' => 'Это должна быть действительная почта',
            'file.required' => 'Обязательно загрузите аватарку',
            'file.image' => 'Это должно быть изображение',
            'file.mimes' => 'Тип файла не подходит. Разрешенные:.jpg, .jpeg, .png',
            'file.max' => 'Максимальный размер файла 2мб',
            'description.required' => 'Обязательно заполните описание'
        ];
    }
}
