<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        $validated = $request->validated();

        if (Auth::attempt($validated, $request->boolean('remember'))) {
            return redirect()->intended(route('user.profile'));
        }

        return redirect(route('user.login'));
    }

    public function register(UserRegisterRequest $request)
    {
        $validated = $request->safe();
        $validated->password = Hash::make($validated->password);

        $user = new User($validated->all());
        $user->save();

        Auth::login($user, $request->boolean('remember'));

        return redirect()->intended(route('user.profile'));
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect(route('home'));
    }
}
