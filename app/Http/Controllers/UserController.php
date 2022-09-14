<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function login(UserLoginRequest $request, UserService $service)
    {
        $response = $service->login($request);

        return $response;
    }
}
