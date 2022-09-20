<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Block;
use App\Models\Track;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlockPolicy
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
        return in_array('block_viewAny', $user->role->permissions->flatten()->pluck('title')->toArray());

    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Block $block)
    {
        return in_array('block_view', $user->role->permissions->flatten()->pluck('title')->toArray())
        && $user->tracks->where('id', $block->track->id)->first()
            ? $user->tracks->where('id', $block->track->id)->first()->id
            : null
        === $block->track->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Track  $track
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user, Track $track)
    {
        return in_array('block_create', $user->role->permissions->flatten()->pluck('title')->toArray())
            && (($user->tracks->where('id', $block->track->id)->first()
                    ? $user->tracks->where('id', $block->track->id)->first()->id
                    : null)
                === $block->track->id
                || ($user->tracksWhereTeacher->where('id', $block->track->id)->first()
                    ? $user->tracksWhereTeacher->where('id', $block->track->id)->first()->id
                    : null)
                === $block->track->id);;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Block  $ser
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Block $block)
    {
        return in_array('block_update', $user->role->permissions->flatten()->pluck('title')->toArray())
            && (($user->tracks->where('id', $block->track->id)->first()
                ? $user->tracks->where('id', $block->track->id)->first()->id
                : null)
            === $block->track->id
            || ($user->tracksWhereTeacher->where('id', $block->track->id)->first()
                ? $user->tracksWhereTeacher->where('id', $block->track->id)->first()->id
                : null)
            === $block->track->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Block $block
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Block $block)
    {
        return in_array('block_delete', $user->role->permissions->flatten()->pluck('title')->toArray())
            && (($user->tracks->where('id', $block->track->id)->first()
                    ? $user->tracks->where('id', $block->track->id)->first()->id
                    : null)
                === $block->track->id
                || ($user->tracksWhereTeacher->where('id', $block->track->id)->first()
                    ? $user->tracksWhereTeacher->where('id', $block->track->id)->first()->id
                    : null)
                === $block->track->id);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Block $block)
    {
        return in_array('block_restore', $user->role->permissions->flatten()->pluck('title')->toArray())
            && $user->tracks->where('id', $block->track->id)->first()
                ? $user->tracks->where('id', $block->track->id)->first()->id
                : null
            === $block->track->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Block $block)
    {
        return in_array('block_forceDelete', $user->role->permissions->flatten()->pluck('title')->toArray())
            && $user->tracks->where('id', $block->track->id)->first()
                ? $user->tracks->where('id', $block->track->id)->first()->id
                : null
            === $block->track->id;
    }
    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function start(User $user, Block $block)
    {
        return in_array('block_start', $user->role->permissions->flatten()->pluck('title')->toArray())
            && $user->tracks->where('id', $block->track->id)->first()
                ? $user->tracks->where('id', $block->track->id)->first()->id
                : null
            === $block->track->id;
    }
}
