<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function Login(Request $request)
    {
        $user = User::where('username', $request['username'])->first();

        if ($user) {
            if (!password_verify($request['password'], $user->password)) {
                $response['status'] = 422;
                $response['message'] = 'Gagal melakukan Login, Password salah.';
                return $response;
            }
            $auth = Auth::attempt(['email' => $user->email, 'password' => $request['password']]);
            $response['status'] = 200;
            $response['user'] = $user;
            return $response;
        }
        $response['status'] = 422;
        $response['message'] = 'User tidak ditemukan.';
        return $response;
    }
}
