<?php

namespace App\Http\Requests\Block;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlockRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->role->name == 'teacher' || auth()->user()->role->name == 'admin';
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
            'image' => ['nullable', 'file', 'mimes:mimes:jpg,jpeg,png', 'max:2048'],
            'body' => ['required'],
            'date_start' => ['required', 'date'],
            'date_end' => ['required', 'date', 'after_or_equal:date_start'],
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
            'body.required'=> 'Поле: текст блока обязательно',
            'date_start.required' => 'Заполните поле: Дата начала блока',
            'date_start.date' => 'Данные должны соответствовать формату дд.мм.гггг ',
            'date_end.required' => 'Заполните поле: Дата окончания блока',
            'date_end.date' => 'Данные должны соответствовать формату дд.мм.гггг ',
            'date_end.after_or_equal' => 'Дата завершения блока не может быть раньше даты начала',
        ];
    }
}
