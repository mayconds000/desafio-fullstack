<?php

namespace App\Http\Requests\User;

trait RulesTrait
{
    public function rules()
    {
        return [
            'email' => 'email|required|unique:users,email',
            'name' => 'required|max:60',
            'phone' => 'required|max:20',
            'password' => 'required|min:6',
            'address.cep' => 'required|min:9|max:9',
            'address.street' => 'required|max:60',
            'address.number' => 'required|max:10',
            'address.neighborhood' => 'required|max:60',
            'address.city' => 'required|max:40',
            'address.state' => 'required|max:20'
        ];
    }
}