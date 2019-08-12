<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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

    public function rules()
    {
        return [
            'email' => 'email',
            'name' => 'required|max:60',
            'birth_date' => 'required|date_format:d/m/Y',
            'phone' => 'required|max:20',
            'password' => 'required|min:6',
            'cep' => 'required|min:9|max:9',
            'street' => 'required|max:60',
            'number' => 'required|max:10',
            'neighborhood' => 'required|max:60',
            'city' => 'required|max:40',
            'state' => 'required|max:20'
        ];
    }
}
