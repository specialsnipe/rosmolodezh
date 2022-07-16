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

    public function UpdateEmail(SettingEmail $email)
    {
        $this->validate([
            'email' => ['required', 'email', "unique:setting_emails,email," . $email->id]
        ]);
        $email->email = $this->email->email;
        $email->save();
    }

    public function DeleteEmail($email)
    {
        SettingEmail::find($email)->delete();
        $this->setting = Setting::first();
    }

    public function render()
    {
        return view('livewire.admin.settings.email-edit-component');
    }





}
