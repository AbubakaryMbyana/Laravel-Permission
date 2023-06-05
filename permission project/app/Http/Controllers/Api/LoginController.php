<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use App\Http\Resources\PostResource;
use App\Http\Controllers\Api\PostController;


class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        //validate

        //login 
        if (!Auth::attempt($request->only('email', 'password'))) {
            Helper::sendError('Email or Password is wrong!!');
        }


        //response

        return new UserResource(auth()->user());
    }
}
