<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\SliderItem;

class MainSliderManageComponent extends Component
{
    public $slides;

    public function render()
    {
        $this->slides = SliderItem::all()->sortByDesc('created_at');
        return view('livewire.admin.settings.slider.slider-component');
    }
}
