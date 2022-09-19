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
        return auth()->check() && auth()->user()->role->name == 'teacher' || auth()->user()->role->name == 'tutor' || auth()->user()->role->name == 'admin';
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
            'image' => ['required', 'file', 'mimes:mimes:jpg,jpeg,png,webp', 'max:2048'],
            'body' => ['required'],
            'date_start' => ['required', 'date'],
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Заполните поле: Название блока',
            'image.required' => 'Загрузите картинку',
            'image.file' => 'Загрузите файл',
            'image.mimes'=> 'Возможные форматы файлов:jpg,jpeg,png',
            'image.max' => 'Превышен формат файла,максимум 2мб ',
            'body.required'=> 'Заполните поле:Текст блока',
            'date_start.required' => 'Заполните поле: Дата начала блока',
            'date_start.date' => 'Данные должны соответствовать формату дд.мм.гггг ',
        ];
    }
}
