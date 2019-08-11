<?php

namespace App\Http\Requests\User;

trait RulesTrait
{
    public function rules()
    {
        return [
            'email' => 'email|required|unique:users,email',
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
