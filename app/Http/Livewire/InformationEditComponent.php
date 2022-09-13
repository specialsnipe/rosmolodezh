<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Information;
use App\Models\InformationEmail;
use App\Models\InformationPhone;
use App\Models\InformationTelegram;

class InformationEditComponent extends Component
{
    public $setting;
    public $tg_url;
    public $vk_url;
    public $ok_url;
    public $email;
    public $email_description;
    public $tg_username;
    public $tg_description;
    public $changedEmail;


    public function mount(Information $setting)
    {
        $this->setting = $setting;
        $this->vk_url = $setting->vk_url;
        $this->tg_url = $setting->tg_url;
        $this->zen_url = $setting->zen_url;
    }
    public function render()
    {

        return view('livewire.admin.settings.information.information-edit-component');
    }

    public function DeleteEmail($email)
    {
        InformationEmail::find($email)->delete();
        $this->setting = Information::first();
    }
    public function DeleteTelegram($tg)
    {
        InformationTelegram::find($tg)->delete();
        $this->setting = Information::first();
    }


    public function AddEmail()
    {
        $this->validate([
            'email' => ['required', 'email:dns'],
            'email_description' => ['required'],
        ], [
            'email.required' => 'Поле обязательно для заполнения',
            'email.email' => "Неверный формат почты",
            'email_description.required' => "Обязательно добавтье описание",
        ]);
        InformationEmail::create([
            'email' => $this->email,
            'description' => $this->email_description,
            'setting_id' => $this->setting->id
        ]);
        $this->email = '';
        $this->email_description = '';
        $this->setting = Information::first();
    }

    public function AddTelegram()
    {
        $this->validate([
            'tg_username' => ['required'],
            'tg_description' => ['required'],
        ], [
            'tg_username.required' => 'Поле обязательно для заполнения',
            'tg_description.required' => "Обязательно добавтье описание",
        ]);
        InformationTelegram::create([
            'username' => $this->tg_username,
            'description' => $this->tg_description,
            'information_id' => $this->setting->id
        ]);
        $this->tg_username = '';
        $this->tg_description = '';
        $this->setting = Information::first();
    }
}
