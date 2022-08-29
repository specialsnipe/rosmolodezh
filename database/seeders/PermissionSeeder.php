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
            'readable_title'=>'Просмотр ответов'
        ]);
        Permission::create([
            'title' => 'answer_view',
            'readable_title'=>'Просмотр ответа'
        ]);
        Permission::create([
            'title' => 'answer_create',
            'readable_title'=>'Создание ответа'
        ]);
        Permission::create([
            'title' => 'answer_update',
            'readable_title'=>'Изменение ответа'
        ]);
        Permission::create([
            'title' => 'answer_delete',
            'readable_title'=>'Удаление ответа'
        ]);
        Permission::create([
            'title' => 'answer_restore',
            'readable_title'=>'Восстановление ответа'
        ]);
        Permission::create([
            'title' => 'answer_forceDelete',
            'readable_title'=>'Удаление ответа безвозвратно'
        ]);

        Permission::create([
            'title' => 'user_viewAny',
            'readable_title'=>'Просмтр пользователей'
        ]);
        $user_view = Permission::create([
            'title' => 'user_view',
            'readable_title'=>'Просмотр пользователя'
        ]);
        Permission::create([
            'title' => 'user_create',
            'readable_title'=>'Создание пользователя'
        ]);
        Permission::create([
            'title' => 'user_update',
            'readable_title'=>'Изменение пользвателя'
        ]);
        Permission::create([
            'title' => 'user_delete',
            'readable_title'=>'Удаление пользователя'
        ]);
        Permission::create([
            'title' => 'user_restore',
            'readable_title'=>'Восстановление пользователя'
        ]);
        Permission::create([
            'title' => 'user_forceDelete',
            'readable_title'=>'Удаление пользователя безвовзратно'
        ]);
        $track_viewAny = Permission::create([
            'title' => 'track_viewAny',
            'readable_title'=>'Просмотр направлений'
        ]);
        $track_view = Permission::create([
            'title' => 'track_view',
            'readable_title'=>'Просмотр направления'
        ]);
        $track_create = Permission::create([
            'title' => 'track_create',
            'readable_title'=>'Создание направления'
        ]);
        $track_update = Permission::create([
            'title' => 'track_update',
            'readable_title'=>'Изменение направления'
        ]);
        $track_delete = Permission::create([
            'title' => 'track_delete',
            'readable_title'=>'Удаление направлени'
        ]);
        $track_restore = Permission::create([
            'title' => 'track_restore',
            'readable_title'=>'Восстановлене направления'
        ]);
        $track_forceDelete = Permission::create([
            'title' => 'track_forceDelete',
            'readable_title'=>'Удаление направления безвовратно'
        ]);
        $exercise_viewAny = Permission::create([
            'title' => 'exercise_viewAny',
            'readable_title'=>'Просмтр упражнений'
        ]);
        $exercise_view = Permission::create([
            'title' => 'exercise_view',
            'readable_title'=>'Просмотр упражнения'
        ]);
        $exercise_create = Permission::create([
            'title' => 'exercise_create',
            'readable_title'=>'Создание упражнения'
        ]);
        $exercise_update = Permission::create([
            'title' => 'exercise_update',
            'readable_title'=>'Изменения упражнения'
        ]);
        $exercise_delete = Permission::create([
            'title' => 'exercise_delete',
            'readable_title'=>'Удаление упражнения'
        ]);
        $exercise_restore = Permission::create([
            'title' => 'exercise_restore',
            'readable_title'=>'Восстановление упражнения'
        ]);
        $exercise_forceDelete = Permission::create([
            'title' => 'exercise_forceDelete',
            'readable_title'=>'Удаление упражнения безвозвратно'
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
