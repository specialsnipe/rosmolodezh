<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Complexity;
use App\Models\ComplexityTime;

class ComplexityAndTimeManageComponent extends Component
{
    public $complexities;
    public $complexity_times;


    public function mount()
    {
        $this->complexities = Complexity::all();
        $this->complexity_times = ComplexityTime::all();
        // dd($this->complexities);
    }

    public function render()
    {
        return view('livewire.admin.settings.complexity.complexity-and-time-manage-component');
    }
}
