<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SettingsEditComponent extends Component
{
    public $setting;

    public function render()
    {
        return view('livewire.admin.settings.settings-edit-component');
    }
}
