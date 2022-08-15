<?php

namespace App\Http\Livewire;

use App\Models\Information;
use App\Models\InformationEmail;
use App\Models\InformationPhone;
use Livewire\Component;

class InformationEditComponent extends Component
{
    public $setting;
    public $tg_url;
    public $vk_url;
    public $ok_url;
    public $phone_title;
    public $email_title;
    public $email;
    public $email_description;
    public $phone;
    public $phone_description;
    public $changedEmail;


    public function mount(Information $setting)
    {
        $this->setting = $setting;
        $this->vk_url = $setting->vk_url;
        $this->tg_url = $setting->tg_url;
        $this->ok_url = $setting->ok_url;
    }
    public function render()
    {

        return view('livewire.admin.settings.information.information-edit-component');
    }

    public function update()
    {

    }



    public function DeleteEmail($email)
    {
        InformationEmail::find($email)->delete();
        $this->setting = Information::first();
    }
    public function DeletePhone($phone)
    {
        InformationPhone::find($phone)->delete();
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

    public function AddPhone()
    {
        $this->validate([
            'phone' => ['required','min:17'],
            'phone_description' => ['required'],
        ], [
            'phone.required' => 'Поле обязательно для заполнения',
            'phone.min:17' => 'В номере телефона не хватает цифр',
            'phone_description.required' => "Обязательно добавтье описание",
        ]);
        InformationPhone::create([
            'phone' => $this->phone,
            'description' => $this->phone_description,
            'setting_id' => $this->setting->id
        ]);
        $this->phone = '';
        $this->phone_description = '';
        $this->setting = Information::first();
    }
}
