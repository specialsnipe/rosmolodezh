<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Gender;
use App\Models\Occupation;
use App\Models\Role;

class HandBookController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $occupations = Occupation::all();
        $genders = Gender::all();
        $roles = Role::all();

        return view('admin.hand_book.index', compact('roles','genders','occupations'));
    }
}
