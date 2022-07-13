<?php

namespace App\Http\Requests\Block;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->role->name == 'admin' || auth()->user()->role->name == 'tutor';
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
            'image' => ['required', 'file', 'mimes:mimes:jpg,jpeg,png', 'max:2048'],
            'body' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле: Название направления обязательно',
            'image.required' => 'Загрузите картинку',
            'image.file' => 'Загрузите файл',
            'image.mimes'=> 'Возможные форматы файлов:jpg,jpeg,png',
            'image.max' => 'Превышен формат файла,максимум 2мб ',
            'body.required'=> 'Поле: текст блока обязательно'
        ];
    }
}
