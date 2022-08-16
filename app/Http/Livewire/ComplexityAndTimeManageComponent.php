<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Complexity;
use App\Models\ComplexityTime;

class ComplexityAndTimeManageComponent extends Component
{
    public $complexities;
    public $complexity_times;

    public function openTimeChangeModal(ComplexityTime $complexity_time)
    {
        # open modal for change the complexity time
    }

    public function updateTime(ComplexityTime $complexity_time)
    {
        # update the time interval or this color
    }

    public function createTime()
    {
        # create a new time interval
    }

    public function openComplexityChangeModal(Complexity $complexity)
    {
        # open modal for change the complexity
    }

    public function updateComplexity(Complexity $complexity)
    {
        # update the complexity or this color
    }

    public function createComplexity()
    {
        # create a new complexity
    }

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
