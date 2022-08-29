<?php

namespace App\Policies;

use App\Models\Exercise;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExercisePolicy
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
        return in_array('exercise_viewAny', $user->role->permissions->flatten()->pluck('title')->toArray());
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Exercise $exercise)
    {
        return in_array('exercise_view', $user->role->permissions->flatten()->pluck('title')->toArray());
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return in_array('exercise_create', $user->role->permissions->flatten()->pluck('title')->toArray())
            || $user->role->name === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Exercise $exercise)
    {
        return in_array('exercise_create', $user->role->permissions->flatten()->pluck('title')->toArray())
            || $user->id === $exercise->user_id
            || $user->role->name === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Exercise $exercise)
    {
        return in_array('exercise_delete', $user->role->permissions->flatten()->pluck('title')->toArray())
            || $user->id === $exercise->user_id
            || $user->role->name === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Exercise $exercise)
    {
        return in_array('exercise_restore', $user->role->permissions->flatten()->pluck('title')->toArray())
            || $user->role->name === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Exercise $exercise)
    {
        return in_array('exercise_forceDelete', $user->role->permissions->flatten()->pluck('title')->toArray())
            || $user->role->name === 'admin';
    }
}
