<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Gender;
use App\Models\Occupation;
use App\Models\Track;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {

        return view('auth.register.index', [
            'genders' => Gender::latest()->get(),
            'occupations' => Occupation::latest()->get(),
            'tracks' => Track::latest()->get()
        ]);
    }

    public function store(RegisterRequest $request)
    {
        // TODO: Доделать создание записи в общей таблице users_tracks
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        auth()->login($user);

        return redirect()->route('home');
    }
}
