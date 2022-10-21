<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePartnershipItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->role->name === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=> ['required','max:60'],
            'body'=> ['required','max:250'],
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
            'title.required'=> 'Поле "Заголовок" обязательно для заполнения.',
            'title.max'=> 'Слишком много символов, максимально  60.',
            'body.required'=> 'Поле "Описание" обязательно для заполнения.',
            'body.max'=> 'Слишком много символов, максимально 250.',
        ];
    }
}
