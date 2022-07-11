<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['string', 'nullable'],
            'last_name' => ['string', 'nullable'],
            'father_name' => ['string', 'nullable'],
            'age' => ['numeric', 'nullable'],
            'occupation_id' => ['array', 'nullable'],
            'track_id' => ['array', 'nullable'],
            'roles_id'=> ['array', 'nullable']
        ];
    }
}
