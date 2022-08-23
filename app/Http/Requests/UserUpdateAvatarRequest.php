<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateAvatarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'file'=>['nullable','image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
    public function messages()
    {
        return [
            'file.image'=> 'Это должно быть изображением',
            'file.mimes'=> 'Допустимые типы изображений для загрузки: :values',
            'file.max'=> 'Максимально возможный размер для фотографии: :max',
        ];
    }
}
