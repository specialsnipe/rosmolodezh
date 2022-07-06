<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Gender;
use App\Models\Occupation;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        $tracks = [
            [
                'id' => '1',
                'name' => 'Дизайн',
            ],
            [
                'id' => '2',
                'name' => 'Программирование',
            ],
            [
                'id' => '3',
                'name' => 'Верстка',
            ],
        ];

        return view('auth.register.index', [
            'genders' => Gender::latest()->get(),
            'occupations' => Occupation::latest()->get(),
            'tracks' => $tracks
        ]);
    }

    public function store(RegisterRequest $request)
    {
        // TODO: Доделать создание записи в общей таблице users_tracks
        $user = User::create($request->validated());

        auth()->login($user);
    }
}
