<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Track;
use App\Models\Gender;
use App\Models\Occupation;
use Illuminate\Http\Request;
use App\Services\ImageService;
use App\Http\Filters\UsersFilter;
use App\Events\UserTelegramUpdate;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\Factory;
use App\Http\Requests\User\FilterRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Contracts\Foundation\Application;
use App\Http\Requests\User\ChangePasswordUserRequest;

class UserController extends Controller
{

    /**
     * Show all users on admin panel
     *
     * @return Factory|View|Application
     */
    public function index(FilterRequest $request)
    {
        $data = $request->validated();

        $filter = app()->make(UsersFilter::class, ['queryParams' => array_filter($data)]);
        $users = User::filter($filter)->withTrashed()->paginate(15);
        $roles = Role::all();
        $tracks = Track::all();
        return view('admin.users.index', compact('users', 'roles', 'tracks'));
    }


    /**
     * Show the form to create custom user
     * @return Application|Factory|View
     */
    public function create()
    {
        $genders = Gender::all();
        $roles = Role::all();
        $occupations = Occupation::all();
        $tracks = Track::all();
        return view('admin.users.create', compact('genders', 'roles', 'occupations', 'tracks'));
    }

    /**
     * Store the user created by admin
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        if (!$request->hasFile('file')) {
            $user= User::firstOrCreate ($data);
            if (isset($data['tg_name'])) {
                event(new UserTelegramUpdate($user, $data['tg_name']));
            }
//                event(new Registered($user));

            TrackUser::create([
                'track_id' => $data['track_id'],
                'user_id' => $user->id,
            ]);
            return redirect()->route('admin.users.show', $user->id);
        }

        $filename = ImageService::make($request->file('file'), 'users/avatars');
        unset($data['file']);

        $data['avatar'] = $filename;
        $user = User::create($data);

        TrackUser::create([
            'track_id' => $data['track_id'],
            'user_id' => $user->id,
        ]);
        if (isset($data['tg_name'])) {
            event(new UserTelegramUpdate($user, $data['tg_name']));
        }
//        event(new Registered($user));
        return redirect()->route('admin.users.index');
    }

    /**
     * Show the user
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function show($user)
    {
        $user = User::withTrashed()->find($user);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the user resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit(User $user)
    {
        $genders = Gender::all();
        $roles = Role::all();
        $tracks = Track::all();
        $occupations = Occupation::all();
        return view('admin.users.edit', compact('user', 'genders', 'roles', 'occupations', 'tracks'));
    }

    /**
     * Update the user resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Exception|RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();

        if (isset($data['tg_name'])) {
            event(new UserTelegramUpdate($user, $data['tg_name']));
        }

        if (!$request->hasFile('file')) {

            $user->updateOrFail($request->validated());
            return redirect()->route('admin.users.show', $user->id);
            // check setter 'track_id' and delete old if it needed
            if (isset($user->tracks[0]) && $data['track_id'] !=  $user->tracks[0]->id) {

                foreach ($user->tracks as $track) {
                    $track->delete();
                }
                $track = TrackUser::create([
                    'track_id' => $data['track_id'],
                    'user_id' => $user->id,
                ]);
            } else {
                $track = TrackUser::create([
                    'track_id' => $data['track_id'],
                    'user_id' => $user->id,
                ]);
            }
        }
        ImageService::deleteOld($user->avatar, 'users/avatars');
        $filename = ImageService::make($request->file('file'), 'users/avatars');
        $data['avatar'] = $filename;
        unset($data['file']);

        $user->updateOrFail($data);
        // check setter  'track_id' and delete old if it needed
        if (isset($user->tracks[0]) && $data['track_id'] !=  $user->tracks[0]->id) {

            foreach ($user->tracks as $track) {
                $track->delete();
            }
            $track = TrackUser::create([
                'track_id' => $data['track_id'],
                'user_id' => $user->id,
            ]);
        } else {
            $track = TrackUser::create([
                'track_id' => $data['track_id'],
                'user_id' => $user->id,
            ]);
        }
        return redirect()->route('admin.users.show', $user->id);
    }

    /**
     * Remove the user resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function destroy(User $user)
    {
        $user->update([
            'active' => false,
        ]);
        $user->deleteOrFail();
        return redirect()->back();
    }
    /**
     * Remove the user resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function change_status($user)
    {
        $user = User::withTrashed()->find($user);

        if (isset($user->deleted_at)) {
            $user->update([
                'active' => true,
            ]);
            $user->restore();
            return redirect()->back();
        }
        $user->update([
            'active' => false,
        ]);
        $user->deleteOrFail();
        return redirect()->back();
    }

    public function change_password(ChangePasswordUserRequest $request, User $user)
    {
        try {
            $user->update([
                'password' => Hash::make($request->input('password'))
            ]);
        } catch (\Exception $exception) {
            return back()->withErrors([
                'password' => 'Что то пошло не так... :('
            ]);
        }
        return back()->withInput([
            'success_change_password' => 'Пароль успешно изменён'
        ]);
    }

}
