<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Gender;
use App\Models\Occupation;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        auth()->login($user);

        return redirect()->route('home');
    }
}
