<?php

namespace App\Policies;

use App\Models\Track;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrackPolicy
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
        return in_array('track_viewAny', $user->role->permissions->flatten()->pluck('title')->toArray());
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Track  $track
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Track $track)
    {
        return in_array('track_view', $user->role->permissions->flatten()->pluck('title')->toArray())
            && (in_array($track->id, $user->tracksWhereTeacher->flatten()->pluck('id')->toArray())
                || in_array($track->id, $user->tracks->flatten()->pluck('id')->toArray()))
            || $user->role->name === 'admin';
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return in_array('track_create', $user->role->permissions->flatten()->pluck('title')->toArray())
            || $user->role->name === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Track  $track
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Track $track)
    {
        return in_array('track_update', $user->role->permissions->flatten()->pluck('title')->toArray())
            && $user->id === $track->creator_id
            || $user->role->name === 'admin';

    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Track  $track
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Track $track)
    {
        return in_array('track_delete', $user->role->permissions->flatten()->pluck('title')->toArray())
            && $user->id === $track->creator_id
            || $user->role->name === 'admin';

    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Track  $track
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Track $track)
    {
        return in_array('track_restore', $user->role->permissions->flatten()->pluck('title')->toArray())
            && $user->id === $track->creator_id
            || $user->role->name === 'admin';

    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Track  $track
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Track $track)
    {
        return in_array('track_forceDelete', $user->role->permissions->flatten()->pluck('title')->toArray())
            && $user->id === $track->creator_id
            || $user->role->name === 'admin';
    }
}
