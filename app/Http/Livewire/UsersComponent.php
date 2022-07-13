<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use App\Models\Track;
use App\Http\Filters\UsersFilter;

class UsersComponent extends Component
{
    public $first_name = '';
    public $last_name = '';
    public $father_name = '';
    public $role_id = [];
    public $track_id = [];
    public $tracks;
    public $roles;
    public $users;

    public function updated() {

        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'father_name' => $this->father_name,
            'role_id' => $this->role_id,
            'track_id' => $this->track_id,
        ];

        $filter = app()->make(UsersFilter::class, ['queryParams' => array_filter($data)]);
        $this->users = User::filter($filter)->get();

    }
    public function render()
    {
        $this->roles = Role::all();
        $this->tracks = Track::all();

        return view('livewire.admin.users.users-component');
    }
}
