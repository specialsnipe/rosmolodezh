<?php

namespace App\Http\Controllers\Client;

use App\Models\Block;
use App\Models\Track;
use App\Models\Gender;
use App\Models\Occupation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateUserRequest;

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
    /**
     *
     */
    public function profile()
    {
        $data = [
            'genders' => Gender::all(),
            'occupations' => Occupation::all(),
            'tracks' => Track::all(),
        ];
        $data['blocks'] = Block::where('track_id',$data['tracks'][0]->id)->with('exercises')->get();
        // dd($data['blocks']);
        $role = auth()->user()->role->name;
        if ($role == 'tutor') {
            return view('profile.tutor', $data);
        }
        return view('profile.student', $data);
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

    }
    /**
     *
     */
    public function update(UpdateUserRequest $request)
    {

        return back();
    }
}
