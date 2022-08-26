<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'title' => 'answer_viewAny',
        ]);
        Permission::create([
            'title' => 'answer_view',
        ]);
        Permission::create([
            'title' => 'answer_create',
        ]);
        Permission::create([
            'title' => 'answer_update',
        ]);
        Permission::create([
            'title' => 'answer_delete',
        ]);
        Permission::create([
            'title' => 'answer_restore',
        ]);
        Permission::create([
            'title' => 'answer_forceDelete',
        ]);

        Permission::create([
            'title' => 'user_viewAny',
        ]);
        $user_view = Permission::create([
            'title' => 'user_view',
        ]);
        Permission::create([
            'title' => 'user_create',
        ]);
        Permission::create([
            'title' => 'user_update',
        ]);
        Permission::create([
            'title' => 'user_delete',
        ]);
        Permission::create([
            'title' => 'user_restore',
        ]);
        Permission::create([
            'title' => 'user_forceDelete',
        ]);

        $student = Role::find(Role::STUDENT);


        $teacher = Role::find(Role::TEACHER);
        $teacher->permissions()->toggle($user_view);

        $tutor = Role::find(Role::TUTOR);
        $tutor->permissions()->toggle($user_view);


        $admin = Role::find(Role::ADMIN);
        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            $admin->permissions()->toggle($permission);
        }

    }
}
