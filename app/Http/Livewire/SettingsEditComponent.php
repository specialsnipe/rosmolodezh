<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use App\Models\SettingEmail;
use Livewire\Component;

class SettingsEditComponent extends Component
{
    public $setting;
    public $tg_url;
    public $vk_url;
    public $ok_url;
    public $phone_title;
    public $email_title;
    public $email;
    public $phone;
    public $changedEmail;


    public function mount(Setting $setting)
    {
        $this->setting = $setting;
        $this->vk_url = $setting->vk_url;
        $this->tg_url = $setting->tg_url;
        $this->ok_url = $setting->ok_url;
    }
    public function render()
    {

        return view('livewire.admin.settings.settings-edit-component');
    }

    public function update()
    {

    }


    public function AddEmail()
    {
        $this->validate([
            'email' => ['required', 'email:dns']
        ], [
            'email.required' => 'Поле обязательно для заполнения',
            'email.email' => "Неверный формат почты"
        ]);
        SettingEmail::create([
            'email' => $this->email,
            'setting_id' => $this->setting->id
        ]);
        $this->email = '';
        $this->setting = Setting::first();
    }
    public function UpdateEmail(SettingEmail $email)
    {
        $email->update([
            'email'=>$this->email->email,
            'setting_id' => $this->setting->id
        ]);
    }
    public function DeleteEmail($email)
    {
        SettingEmail::find($email)->delete();
        $this->setting = Setting::first();
    }

    public function AddPhone()
    {

    }
}
