<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use App\Models\SettingEmail;
use Livewire\Component;

class EmailEditComponent extends Component
{
    public $email;
    public $setting;

    public function mount(SettingEmail $email, Setting $setting)
    {
        $this->setting = $setting;
        $this->email = $email;
    }

    public function render()
    {
        return view('livewire.admin.settings.email-edit-component');
    }





}
