<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Track;
use App\Models\Gender;
use App\Models\TrackUser;
use App\Models\Occupation;
use App\Jobs\RegisterUserJob;
use App\Mail\RegistrationMail;
use App\Events\UserRegistration;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
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
        $data['avatar'] = 'default_avatar.jpg';
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        TrackUser::create([
            'track_id' => $data['track_id'],
            'user_id' => $user->id,
        ]);

        try {
            event(new Registered($user));
        } catch (Exception $e) { }

        auth()->login($user);

        // event(new UserRegistration($this->user));

        return redirect()->route('profile.progress');
    }
}
