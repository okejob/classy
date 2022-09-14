<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    /**
     * Route To login page
     *
     * @return View login
     */
    public function login()
    {
        return view('pages.session.login');
    }

    /**
     * Authenticate Login
     *
     * @param UserLoginRequest $request
     * @return View dashboard
     * @return View login with password error
     */
    public function authenticate(UserLoginRequest $request)
    {
        $user = User::where('username', $request['username'])->first();
        $auth = Auth::attempt(['email' => $user->email, 'password' => $request['password']]);

        if ($auth) {
            $request->session()->regenerate();
            Session::put('user_id', $user->id);
            //need dashboard page
            return redirect()->intended('reset-password');
        }
        return back()->withErrors([
            'password' => 'Password tidak cocok.'
        ]);
    }

    /**
     * Store New User
     *
     * @param UserCreateRequest $request
     * @return View dashboard 
     */
    public function store(UserCreateRequest $request)
    {
        $validated = $request->safe()->merge(['status' => 'A']);
        User::create($validated);
        //need dashboard page
        return redirect()->intended('reset-password');
    }

    /**
     * Reset Password Page
     *
     * @return View reset password
     */
    public function resetPassword()
    {
        return view('pages.session.ubahPassword');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
