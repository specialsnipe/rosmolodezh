<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
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
            'title' =>['required'],
            'body'=>['required'],
            'button_name'=>['required'],
            'button_link'=>['required', 'url'],
            'image'=>['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
        ];
    }
    public function messages()
    {
        return [
            'title.required'=> 'Поле название обязательно',
            'body.required' => 'Поле текст слайда обязательно',
            'button_name.required' => 'Поле Текст кнопки обязательно',
            'button_link.required' => 'Поле url кнопки обязательно',
            'button_link.url' => 'Это должна быть ссылка',
            'image.image' => 'Файл должен быть картинкой',
            'image.mimes' => 'Возможные форматы файлов: jpg,jpeg,png',
            'image.max' => 'Файл слишком много весит! (не более 2мб)',
        ];
    }
}
