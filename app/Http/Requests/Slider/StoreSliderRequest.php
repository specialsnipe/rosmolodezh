<?php

namespace App\Http\Requests\Slider;

use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
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
            'image'=>['required', 'image', 'mimes:jpg,jpeg,png']
        ];
    }
}
