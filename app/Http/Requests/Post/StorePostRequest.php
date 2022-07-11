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
            'file.*.mimes' => 'Возможные форматы файлов:jpg,jpeg,png',
            'file.*.max' => 'Файл слишком много весит! (не более 2мб)',
            'body.required' => 'Поле текст статьи обязательно'
        ];
    }
}
