<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * @method Builder|static whereUserIsTeacherOrTeacher()
 */
trait UserScopes
{
    /**
     * @param Builder $query
     * @return Builder
     * @noinspection PhpUnused
     */
    public function scopeWhereUserIsTeacherOrTeacher(Builder $query): Builder
    {
        return $query
            ->joinSub(function ($query) {
                /** @var Builder $query */
                return $query
                    ->select(['id as role_id' , 'name as role_name'])
                    ->from('roles');

            },'roles','users.role_id', '=', 'roles.role_id')
            ->whereIn('role_name', ['tutor', 'teacher']);
    }
}
