<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\TrackUser;
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
        $data = $request->validated();
        $data['avatar'] = 'default_image.jpg';
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        TrackUser::create([
            'track_id' => $data['track_id'],
            'user_id' => $user->id,
        ]);

        auth()->login($user);

        return redirect()->route('home');
    }
}
