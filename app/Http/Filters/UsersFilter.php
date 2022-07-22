<?php


namespace App\Http\Filters;


use Illuminate\Database\Eloquent\Builder;

class UsersFilter extends AbstractFilter
{
    public const FIRST_NAME = 'first_name';
    public const LAST_NAME = 'last_name';
    public const FATHER_NAME = 'father_name';
    public const AGE = 'age';
    public const OCCUPATION_ID = 'occupation_id';
    public const TRACK_ID = 'track_id';
    public const ROLE_ID = 'role_id';
    public const ACTIVE = 'active';
    public const DELETED_AT = 'deleted_at';


    protected function getCallbacks(): array
    {
        return [
            self::FIRST_NAME => [$this, 'firstName'],
            self::LAST_NAME => [$this, 'lastName'],
            self::FATHER_NAME => [$this, 'fatherName'],
            self::AGE => [$this, 'age'],
            self::OCCUPATION_ID => [$this, 'occupationId'],
            self::TRACK_ID => [$this, 'trackId'],
            self::ROLE_ID => [$this, 'roleId'],
            self::ACTIVE => [$this, 'active'],
            self::DELETED_AT => [$this, 'deletedAt'],
        ];

    }


    public function firstName(Builder $builder, $value)
    {
        $builder->where('first_name', 'like', "%{$value}%");
    }

    public function lastName(Builder $builder, $value)
    {
        $builder->where('last_name', 'like', "%{$value}%");
    }

    public function fatherName(Builder $builder, $value)
    {
        $builder->where('father_name', 'like', "%{$value}%");
    }

    public function age(Builder $builder, $value)
    {
        $builder->where('age', '=', $value);
    }

    public function occupationId(Builder $builder, $value)
    {
        $builder->whereIn('occupation_id', $value);
    }

    public function roleId(Builder $builder, $value)
    {
        $builder->whereIn('role_id', $value);
    }

    public function trackId(Builder $builder, $value)
    {

        $builder->join('track_user', 'users.id', '=', 'track_user.user_id')
            ->whereIn('track_id', $value)->get();
    }
}
