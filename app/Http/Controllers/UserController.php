<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $validated = $request->validated();

        $user = new User($validated);
        $user->save();
        $user->fresh();

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
