<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Services\UserService;
use App\Models\Update;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

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
            Session::put('user', $user);
            $roles = $user->getRoleNames();
            $role = $roles[0];
            Session::put('role', $role);
            //need dashboard page
            return redirect()->intended(route('dashboard'));
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
    public function insert(UserCreateRequest $request)
    {
        User::create($request);
        //need dashboard page
        return redirect()->intended(route('menu-karyawan'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return [
            'status' => 200,
            $user,
        ];
    }

    public function update(Request $request, $id)
    {
        User::find($id)->update($request->except('role'));
        $user = User::find($id);
        $user->status = $request->status;
        $user->changeRole($request->role);
        $user->save();
        return redirect()->intended(route('menu-karyawan'));
    }

    public function changePassword(Request $request, User $user)
    {
        if ($request->new_password != $request->new_password_confirmation) {
            return [
                'status' => 400,
                'message' => 'Konfirmasi password salah'
            ];
        }
        if (!Hash::check($request->current_password, $user->password)) {
            return [
                'status' => 400,
                'message' => 'Password Salah',
            ];
        } else {
            $new = Hash::make($request->new_password);
            $user->update(['password' => $new]);
            return [
                'status' => 200,
                'message' => 'Success'
            ];
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
