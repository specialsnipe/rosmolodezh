<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Track;
use App\Models\Gender;
use App\Models\TrackUser;
use App\Models\Occupation;
use App\Mail\RegistrationMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Auth\RegisterRequest;

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
        $emailData = [
            'title' => 'Успешная регистрация!',
            'track' => $user->track->title,
            'login' => $user->login,
        ];

        Mail::to($data['email'])->send(new RegistrationMail($emailData));
        return redirect()->route('home');
    }
}
