<?php

namespace App\Http\Controllers\Client;

use App\Models\User;
use App\Models\Block;
use App\Models\Track;
use App\Models\Gender;
use App\Models\Occupation;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserUpdateAvatarRequest;
use App\Http\Requests\UserChangePasswordRequest;

class UserController extends Controller
{
    /**
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('home');
    }

    public function profile()
    {
        $data = [
            'genders' => Gender::all(),
            'occupations' => Occupation::all(),
            'tracks' => Track::all(),
        ];
        $data['blocks'] = Block::where('track_id',$data['tracks'][0]->id)->with('exercises')->get();
        $role = auth()->user()->role->name;
        if ($role == 'tutor'||$role == 'teacher') {
            $isCurator = Track::where('curator_id', auth()->user()->id)->first();
            $data['isCurator'] = $isCurator;
            return view('profile.teacher', $data);
        }
        return view('profile.student', $data);
    }
    public function show(User $user)
    {
        return view('profile.users.show', compact('user'));
    }

    public function data()
    {
        $data = [
            'genders' => Gender::all(),
            'occupations' => Occupation::all(),
            'tracks' => Track::all(),
            'user' => auth()->user(),
        ];
        return view('profile.personal-data', $data);

        Track::all()->merge(Track::all()->lessons)->merge()->orderBy('namber');


    }
    /**
     *
     */
    public function update(UpdateUserRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        $user->updateOrFail($data);
        session()->flash('message', 'Ваши личные данные успешно обновлены');
        return redirect()->route('profile.data');

    }

    public function changePassword(UserChangePasswordRequest $request)
    {
        $user = auth()->user();
        $data = $request->validated();
        if (Hash::check($data['old_password'], $user->password)) {
            $user->update([
                'password' => Hash::make($request->input('password'))
            ]);
            session()->flash('message', 'Пароль успешно изменён');
        } else {
            return back()->withInput($data)->withErrors(['old_password' => 'Старый пароль неверный']);
        }
        return back();
    }

    public function updateAvatar(UserUpdateAvatarRequest $request)
    {

        $data = $request->validated();
        ImageService::deleteOld(auth()->user()->avatar, 'users/avatars');
        $filename = ImageService::make($request->file('file'), 'users/avatars');
        auth()->user()->update([
            'avatar' => $filename
        ]);
        session()->flash('message', 'Ваша аватарка была обновлена');
        return back();
    }

}
