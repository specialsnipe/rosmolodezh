<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {

    }

    public function store(LoginRequest $request)
    {
        $data = $request->validated();
        $user = User::where('login', $data['login']);

        if (Hash::check($data['password'], $user->password)) {
            auth()->login($user);
            return redirect()->route('home');
        }

        return back()->withErrors([
            'password' => 'Неверный пароль'
        ])->withInput([
            'login' => $data['login']
        ]);

    }
}
