<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserService
{
    /**
     * Login Function
     *
     * @param Request $request
     * @return array $response
     */
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
            $roles = $user->getRoleNames();
            Session::put('username', $user->username);
            Session::put('role', $roles[0]);
            Session::put('auth', $auth);

            $response['status'] = 200;
            $response['user'] = $user;
            $response['roles'] = $roles[0];
            return $response;
        }
        $response['status'] = 422;
        $response['message'] = 'User tidak ditemukan.';
        return $response;
    }
}
