<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class AuthController extends Controller
{
    public function signUp(Request $request)
    {
        $this->validate(
            $request,
            [
                'login' => 'required|unique:users|min:4|max:30',
                'password' => 'required|min:6|max:60',
            ]
        );
        $user = new User();
        $user->login = $request->get('login');
        $user->password = Hash::make($request->get('password'));
        $user->token = Uuid::uuid4();
        $user->save();

        return ['token' => $user->token];
    }

    public function signIn(Request $request)
    {
        $this->validate(
            $request,
            [
                'login' => 'required|min:4|max:30',
                'password' => 'required|min:6|max:60',
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
