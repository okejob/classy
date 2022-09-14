<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(UserLoginRequest $request, UserService $service)
    {
        $response = $service->login($request);

        //Return ke view
    }
}
