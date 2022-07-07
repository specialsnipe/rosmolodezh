<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Показать шаблон входа
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('auth.login.index');
    }

    /**
     * Залогинить пользователя
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function submit(LoginRequest $request): RedirectResponse
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
