<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Admin\User;
use App\Models\Admin\Track;
use App\Models\Gender;
use App\Models\TrackUser;
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
        $users = User::filter($filter)->with('tracks','role','occupation')->paginate(15);
        $roles = Role::all();
        $tracks = Track::all();
        return view('admin.users.index', compact('users', 'roles', 'tracks'));
    }

    public function indexDeleted(FilterRequest $request)
    {
        $data = $request->validated();

        $filter = app()->make(UsersFilter::class, ['queryParams' => array_filter($data)]);
        $users = User::filter($filter)->onlyTrashed('tracks','role','occupation')->paginate(15);
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
        $trackId = $data['track_id'];
        unset($data['track_id']);

        if (!$request->hasFile('file')) {
            $user = User::firstOrCreate($data);
            $user->tracks()->attach($trackId);
            if (isset($data['tg_name'])) {
                event(new UserTelegramUpdate($user, $data['tg_name']));
            }
                event(new Registered($user));

            return redirect()->route('admin.users.show', $user->id);
        }

        $filename = ImageService::make($request->file('file'), 'users/avatars');
        unset($data['file']);

        $data['avatar'] = $filename;
        $user = User::firstOrCreate($data);
        $user->tracks()->attach($trackId);
        if (isset($data['tg_name'])) {
            event(new UserTelegramUpdate($user, $data['tg_name']));
        }
//        event(new Registered($user));
        return redirect()->route('admin.users.index');
    }

    /**
     * Show the user
     *
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $user = User::withTrashed()->find($id);
        $isCurator = Track::where('curator_id', $user->id)->first();
        return view('admin.users.show', compact('user', 'isCurator'));
    }

    /**
     * Show the form for editing the user resource.
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $user = User::withTrashed()->find($id);
        $genders = Gender::all();
        $roles = Role::all();
        $tracks = Track::all();
        $occupations = Occupation::all();
        $isCurator = Track::where('curator_id', $user->id)->first();
        return view('admin.users.edit', compact('user', 'genders', 'roles', 'occupations', 'tracks', 'isCurator'));
    }

    /**
     * Update the user resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Exception|RedirectResponse
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::withTrashed()->find($id);
        $data = $request->validated();
        if (isset($data['tg_name'])) {
            event(new UserTelegramUpdate($user, $data['tg_name']));
        }

        if (!$request->hasFile('file')) {
            $user->updateOrFail($request->validated());
            return redirect()->route('admin.users.show', $user->id);
        }

        ImageService::deleteOld($user->avatar, 'users/avatars');
        $filename = ImageService::make($request->file('file'), 'users/avatars');
        $data['avatar'] = $filename;
        unset($data['file']);

        $user->updateOrFail($data);
        return redirect()->route('admin.users.show', $user->id);
    }

    /**
     * Remove the user resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function destroy($id)
    {
        $user = User::find($id);
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
    public function change_status($id)
    {
        $user = User::withTrashed()->find($id);

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

    public function change_password(ChangePasswordUserRequest $request, $id)
    {
        $user = User::find($id);
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
