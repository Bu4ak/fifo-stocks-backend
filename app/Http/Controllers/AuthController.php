<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\UnauthorizedException;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {
        $this->validate(
            $request,
            [
                'login' => 'required|unique:users|min:4',
                'password' => 'required|min:6',
            ]
        );
        $user = new User();
        $user->login = $request->get('login');
        $user->password = Hash::make($request->get('password'));
        $user->token = Str::random();
        $user->save();

        return ['token' => $user->token];
    }

    public function signIn(Request $request)
    {
        $this->validate(
            $request,
            [
                'login' => 'required',
                'password' => 'required',
            ]
        );
        /** @var User $user */
        $user = User::where('login', $request->get('login'))->first();

        if (!Hash::check($request->get('password'), optional($user)->password)) {
            abort(401, 'Invalid login or password.');
        }

        return ['token' => $user->token];
    }
}
