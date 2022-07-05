<?php

namespace App\Policies;

use App\Models\SettingPhone;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPhonePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SettingPhone  $settingPhone
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, SettingPhone $settingPhone)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SettingPhone  $settingPhone
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, SettingPhone $settingPhone)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SettingPhone  $settingPhone
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, SettingPhone $settingPhone)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SettingPhone  $settingPhone
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, SettingPhone $settingPhone)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SettingPhone  $settingPhone
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, SettingPhone $settingPhone)
    {
        //
    }
}
