<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class TableUserComponent extends Component
{
    public $user;
    public $active;
    public $opened = false;

    public function changeStatus()
    {
        if (auth()->user()->id != $this->user->id) {

            if (isset($this->user->deleted_at)) {
                $this->user->active = 1;
                $this->user->save();
                $this->user->restore();
                $this->active = true;
            } else {

                $this->user->active = 0;
                $this->user->save();
                $this->user->deleteOrFail();
                $this->active = false;
            }
        } else {
            session()->flash('info', 'Ты пытаешься удалить самого себя');
        }
    }

    public function openMore()
    {
        redirect()->route('admin.users.show', $this->user->id);
    }


    public function render()
    {
        if (isset($this->user->deleted_at)) {
            $this->active = false;
        }
        return view('livewire.admin.users.table-user-component');
    }
}
