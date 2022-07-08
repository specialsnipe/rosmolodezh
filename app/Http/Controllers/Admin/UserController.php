<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ResizeImage;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Gender;
use App\Models\Occupation;
use App\Models\Role;
use App\Models\User;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Show all users on admin panel
     *
     * @return Factory|View|Application
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
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

        $data['password'] = Hash::make($data['password']);
//        dd($request->file('file'));
        $filename = ResizeImage::make($request->file('file'), 'users/avatars', 150, 150);

        $data['avatar'] = $filename;

        $user = User::firstOrCreate($data);
        return redirect()->route('admin.users.index')->withInput(['user' => $user]);
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
     * @return RedirectResponse
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        try {

            if (!$request->hasFile('file')) {

                $user->updateOrFail($request->validated());

            }
            $filename = ResizeImage::make($request->file('file'), 'users/avatars', 150, 150);
            $data['avatar'] = $filename;
            $user->updateOrFail($data);
        } catch (\Exception $exception) {
            return dd($exception);
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

}
