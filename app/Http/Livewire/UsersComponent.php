<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Role;
use App\Models\Track;
use App\Http\Filters\UsersFilter;

class UsersComponent extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

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
        $this->users = collect(User::filter($filter)->paginate(10)->items());
        dd($this->users);

    }

    public function mount()
    {
        $this->roles = Role::all();
        $this->tracks = Track::all();
        // dd($this->users);
        // dd($this->users->paginate(12));
    }

    public function render()
    {
        $this->users = User::paginate(10);
        $links =  $this->users;
        $this->users =  collect($this->users);
        // dd($this->users, $links);

        // $this->users = $this->users->latest()->paginate('10');
        // dd($this->users->links());
        // foreach ($this->users as $user) {
        //     dd($user->id);
        // }
        return view('livewire.admin.users.users-component', [
            'users' => $this->users,
            'links' => $links,
        ]);

    }
}
