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
                return back()->withErrors([
                    'password' => 'Password tidak cocok.'
                ]);
            }

            Auth::attempt(['email' => $user->email, 'password' => $request['password']]);
            Session::put('user_id', $user->id);
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'username' => 'Username tidak ditemukan.'
        ]);
    }
}
