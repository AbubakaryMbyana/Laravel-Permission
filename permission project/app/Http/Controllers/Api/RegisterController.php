<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        //validate

        //register user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        //assign role

        $user_role = Role::where(['name' => 'user'])->first();

        if ($user_role) {
            $user->assignRole($user_role);
        }

        // if (!Auth::attempt($request->only('email', 'password'))) {
        //     Helper::sendError('Email or Password is wrong!!');
        // }


        //response

        return new UserResource($user);
    }
}
