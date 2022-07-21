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
                $this->user->update([
                    'active' => true,
                ]);
                $this->user->restore();
                $this->active = true;
            } else {

                $this->user->update([
                    'active' => false,
                ]);
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
