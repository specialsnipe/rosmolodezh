<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => 'required',
            'file' => ['required', 'array'],
            'file.*'=>['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'body' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'title.required'=> 'Поле название обязательно',
            'file.required'=>'Загрузите картинки',
            'file.*.required'=> 'Загрузите картинки',
            'file.*.image' => 'Файл должен быть картинкой',
            'file.*.memes:jpg,jpeg,png' => 'Возможные форматы файлов:jpg,jpeg,png',
            'body.required' => 'Поле текст статьи обязательно'
        ];
    }
}
