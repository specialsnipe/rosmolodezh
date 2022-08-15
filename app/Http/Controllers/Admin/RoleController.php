<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Role;

class RoleController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.settings.roles.index', compact('roles'));
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('admin.settings.roles.create');
    }


    /**
     * @param StoreRoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRoleRequest $request)
    {
        $data = $request->validated();
        Role::firstOrCreate($data);
        return redirect()->route('admin.settings.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }


    /**
     * @param Role $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Role $role)
    {
        return view('admin.settings.roles.edit', compact('role'));
    }


    /**
     * @param UpdateRoleRequest $request
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $data = $request->validated();
        $role->update($data);
        return redirect()->route('admin.settings.roles.index');
    }


    /**
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse|void
     * @throws \Throwable
     */
    public function destroy(Role $role)
    {
        try {
            $role->deleteOrFail();
            return redirect()->route('admin.settings.roles.index');
        } catch (\Exception $exception) {
            abort(501);
        }
    }
}
