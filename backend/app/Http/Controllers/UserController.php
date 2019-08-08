<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserStoreRequest as StoreRequest;

class UserController extends Controller
{
    public function register(StoreRequest $request)
    {
        $data = $request->only(User::getFillable());
        
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        }

        User::create($data);
    }
}
