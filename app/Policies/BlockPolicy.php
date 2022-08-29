<?php

namespace App\Policies;

use App\Models\Block;
use App\Models\User;
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
        return in_array('block_viewAny', $user->permissions->flatten())
            && $user->track->where('id', $block->track_id)
                    ? $user->track->where('id', $block->track_id)->id
                    : null
                === $block->track_id;

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
        return in_array('block_view', $user->permissions->flatten())
            && $user->track->where('id', $block->track_id) ? $user->track->where('id', $block->track_id)->id : null
                === $block->track_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return in_array('block_create', $user->permissions->flatten())
            && $user->track->where('id', $block->track_id) ? $user->track->where('id', $block->track_id)->id : null
                === $block->track_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Block $block)
    {
        return in_array('block_update', $user->permissions->flatten())
            && $user->track->where('id', $block->track_id) ? $user->track->where('id', $block->track_id)->id : null
                === $block->track_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Block  $block
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Block $block)
    {
        return in_array('block_delete', $user->permissions->flatten())
            && $user->track->where('id', $block->track_id) ? $user->track->where('id', $block->track_id)->id : null
                === $block->track_id;
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
        return in_array('block_restore', $user->permissions->flatten())
            && $user->track->where('id', $block->track_id) ? $user->track->where('id', $block->track_id)->id : null
                === $block->track_id;
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
        return in_array('block_forceDelete', $user->permissions->flatten())
            && $user->track->where('id', $block->track_id) ? $user->track->where('id', $block->track_id)->id : null
                === $block->track_id;
    }
}
