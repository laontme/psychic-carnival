<?php

namespace App\Http\Controllers;

use App\Http\Requests\TokenIssueRequest;
use App\Http\Requests\TokenRevokeRequest;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function issue(TokenIssueRequest $request)
    {
        $validated = $request->safe();
        $token = auth()->user()->createToken($validated->name);
        return redirect(route('user.profile', ['new_token' => $token->plainTextToken]));
    }

    public function revoke(TokenRevokeRequest $request)
    {
        $validated = $request->safe();
        auth()->user()->tokens()->where('token', $validated->token)->delete();
        return redirect(route('user.profile'));
    }
}
