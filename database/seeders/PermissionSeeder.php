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
        $track_viewAny = Permission::create([
            'title' => 'track_viewAny',
        ]);
        $track_view = Permission::create([
            'title' => 'track_view',
        ]);
        $track_create = Permission::create([
            'title' => 'track_create',
        ]);
        $track_update = Permission::create([
            'title' => 'track_update',
        ]);
        $track_delete = Permission::create([
            'title' => 'track_delete',
        ]);
        $track_restore = Permission::create([
            'title' => 'track_restore',
        ]);
        $track_forceDelete = Permission::create([
            'title' => 'track_forceDelete',
        ]);
        $exercise_viewAny = Permission::create([
            'title' => 'exercise_viewAny',
        ]);
        $exercise_view = Permission::create([
            'title' => 'exercise_view',
        ]);
        $exercise_create = Permission::create([
            'title' => 'exercise_create',
        ]);
        $exercise_update = Permission::create([
            'title' => 'exercise_update',
        ]);
        $exercise_delete = Permission::create([
            'title' => 'exercise_delete',
        ]);
        $exercise_restore = Permission::create([
            'title' => 'exercise_restore',
        ]);
        $exercise_forceDelete = Permission::create([
            'title' => 'exercise_forceDelete',
        ]);

        $student = Role::find(Role::STUDENT);
        $student->permissions()->toggle($exercise_view);

        $teacher = Role::find(Role::TEACHER);
        $teacher->permissions()->toggle($user_view);
        $teacher->permissions()->toggle($track_viewAny);
        $teacher->permissions()->toggle($track_view);
        $teacher->permissions()->toggle($track_create);
        $teacher->permissions()->toggle($track_update);
        $teacher->permissions()->toggle($track_delete);
        $teacher->permissions()->toggle($track_restore);
        $teacher->permissions()->toggle($track_forceDelete);
        $teacher->permissions()->toggle($exercise_viewAny);
        $teacher->permissions()->toggle($exercise_view);
        $teacher->permissions()->toggle($exercise_create);
        $teacher->permissions()->toggle($exercise_update);
        $teacher->permissions()->toggle($exercise_delete);
        $teacher->permissions()->toggle($exercise_restore);
        $teacher->permissions()->toggle($exercise_forceDelete);

        $tutor = Role::find(Role::TUTOR);
        $tutor->permissions()->toggle($user_view);
        $tutor->permissions()->toggle($track_viewAny);
        $tutor->permissions()->toggle($track_view);
        $tutor->permissions()->toggle($track_create);
        $tutor->permissions()->toggle($track_update);
        $tutor->permissions()->toggle($track_delete);
        $tutor->permissions()->toggle($track_restore);
        $tutor->permissions()->toggle($track_forceDelete);
        $tutor->permissions()->toggle($exercise_viewAny);
        $tutor->permissions()->toggle($exercise_view);
        $tutor->permissions()->toggle($exercise_create);
        $tutor->permissions()->toggle($exercise_update);
        $tutor->permissions()->toggle($exercise_delete);
        $tutor->permissions()->toggle($exercise_restore);
        $tutor->permissions()->toggle($exercise_forceDelete);


        $admin = Role::find(Role::ADMIN);
        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            $admin->permissions()->toggle($permission);
        }

    }
}
