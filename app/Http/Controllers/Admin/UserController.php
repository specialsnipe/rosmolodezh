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
        $users = User::filter($filter)->paginate(15);
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
        return view('admin.users.create', compact('genders', 'roles', 'occupations'));
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
        $filename = ImageService::make($request->file('file'), 'users/avatars');
        $data['avatar'] = $filename;
        $data['password'] = Hash::make($data['password']);
        unset($data['file']);

        $user = User::firstOrCreate($data);
        event(new Registered($user));
        return redirect()->route('admin.users.index');
    }

    /**
     * Show the user
     *
     * @param User $user
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
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
        $occupations = Occupation::all();
        return view('admin.users.edit', compact('user', 'genders', 'roles', 'occupations'));
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

        if (!$request->hasFile('file')) {
            try {
                $user->updateOrFail($request->validated());
                return redirect()->route('admin.users.show', $user->id);
            } catch (\Exception $exception) {
                return abort(501);
            }
        }

        ImageService::deleteOld($user->avatar, 'users/avatars');
        $filename = ImageService::make($request->file('file'), 'users/avatars');
        $data['avatar'] = $filename;
        unset($data['file']);

        $user->updateOrFail($data);
        dd($data['tg_name']);

        if (isset($data['tg_name'])) {
            if (iseet($user->tg_id)) {
                if($data['tg_name'] != $user->tg_name) {
                    $user->tg_id = null;
                    $user->save();
                }
            }
            event(new UserTelegramUpdate($user));
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
        try {
            $user->deleteOrFail();
            return redirect()->route('admin.users.index');
        } catch (\Exception $exception) {
            return dd($exception);
        }
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
